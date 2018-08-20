<?php
/**
 * CoinRepository.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

namespace App\Library;

use App\Coin;
use App\Currency;
use Cache;
use Carbon\Carbon;
use DB;
use Log;

class CoinRepository
{
    /**
     * Check if the coin data needs to be updated
     *
     * @param int $minutes
     * @return bool
     */
    public static function needsUpdate($minutes = 1)
    {
        $max = Cache::remember('coin.needs_update', Consts::CACHE_DURATION_TINY, function () {
            return DB::table('coins')->max('last_updated');
        });
        if (isset($max)) {
            if (Carbon::parse($max)->diffInMinutes(Carbon::now()) <= $minutes) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws \HttpException
     */
    public static function updateCoinData()
    {
        $api = new CoinMarketCap();
        $data = $api->tickers();

        foreach ($data as $item) {
            try {
                DB::table('coins')->updateOrInsert(
                    [
                        'symbol' => strtoupper($item['symbol']),
                    ],
                    [
                        'symbol' => strtoupper($item['symbol']),
                        'name' => $item['name'],
                        'coin_id' => strtolower($item['id']),
                        'price_usd' => (float)$item['price_usd'],
                        'price_btc' => (float)$item['price_btc'],
                        'volume_usd_24h' => (float)$item['24h_volume_usd'],
                        'market_cap_usd' => (float)$item['market_cap_usd'],
                        'available_supply' => (float)$item['available_supply'],
                        'total_supply' => (float)$item['total_supply'],
                        'max_supply' => (float)$item['max_supply'],
                        'percent_change_1h' => (float)$item['percent_change_1h'],
                        'percent_change_24h' => (float)$item['percent_change_24h'],
                        'percent_change_7d' => (float)$item['percent_change_7d'],
                        'last_updated' => Carbon::now('UTC'),
                    ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    /**
     * @param string $symbol
     * @param int $defaultLimit
     * @return int
     */
    public static function calcUpdateDelta($symbol, $defaultLimit = 100)
    {
        $symbol = strtoupper($symbol);
        $lastDate = Cache::remember('coin.delta_' . $symbol, Consts::CACHE_DURATION_SMALL,
            function () use ($symbol) {
                return DB::table('coin_daily_histories')
                    ->where('symbol', '=', $symbol)
                    ->max('date');
            }
        );

        if (!isset($lastDate)) {
            return $defaultLimit;
        }

        $delta = Carbon::createFromFormat('Y-m-d', $lastDate)->diffInDays(Carbon::today('UTC')) - 1;
        return $delta < 0 ? 0 : $delta + 1;
    }

    /**
     * @param string $symbol
     * @param int $daysToUpdate
     * @return int
     */
    public static function shouldRefresh($symbol, $cutoffMinutes = 15, $daysToUpdate = 7)
    {
        $lastUpdated = DB::table('coin_daily_histories')
            ->where('symbol', strtoupper($symbol))
            ->max('last_updated');

        if ($lastUpdated === null) {
            return $daysToUpdate;
        }

        $delta = Carbon::createFromFormat('Y-m-d H:i:s', $lastUpdated)->diffInMinutes(Carbon::now('UTC'));
        return $delta < $cutoffMinutes ? 0 : $daysToUpdate;
    }

    /**
     * @param int $roundBy
     * @return mixed
     */
    public static function approxCoinCount($roundBy = 100)
    {
        return Cache::remember('coin.approx_count_' . $roundBy,
            Consts::CACHE_DURATION_LONG,
            function () use ($roundBy) {
                $count = DB::table('coins')->count();
                return ceil($count / $roundBy) * $roundBy;
            });
    }

    /**
     * @param string $symbol
     * @param string $currency
     * @param int $limit
     * @throws \Exception
     */
    public static function updateDailyHistory($symbol, $currency, $limit = 100)
    {
        if ($limit < 1) return;
        if ($limit < 3) $limit = 3;
        if ($limit > 2000) $limit = 2000;
        $api = new CryptoCompare();
        $symbol = strtoupper($symbol);
        Cache::forget('coin.delta_' . $symbol);
        $data = $api->histoDay($symbol, strtoupper($currency), 1, $limit);
        if (isset($data)) {
            foreach ($data as $row) {
                try {
                    $timestamp = (int)$row['time'];
                    $date = Carbon::createFromTimestampUTC($timestamp)->toDateString();
                    if ($timestamp > 18446744073709551615 || $timestamp < 0) {
                        $timestamp = 0;
                    }
                    DB::table('coin_daily_histories')->updateOrInsert(
                        [
                            'symbol' => $symbol,
                            'date' => $date,
                        ],
                        [
                            'symbol' => $symbol,
                            'date' => $date,
                            'timestamp' => $timestamp,
                            'value' => (float)$row['close'],
                            'volume' => (float)$row['volumefrom'],
                            'last_updated' => Carbon::now('UTC'),
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), ['row' => $row]);
                }
            }
        }
    }

    public static function topCoins($limit = 5)
    {
        return Cache::remember('coin.top_' . $limit, Consts::CACHE_DURATION_MEDIUM,
            function () use ($limit) {
                return Coin::valid()
                    ->orderByDesc('market_cap_usd')
                    ->take($limit)
                    ->get();
            });
    }

    private static function processSearchResults($results)
    {
        foreach ($results->items() as &$row) {
            if (isset($row->price_usd))
                $row->price_usd = number_format($row->price_usd, 2);
            if (isset($row->price_btc))
                $row->price_btc = number_format($row->price_btc, 4);
            if (isset($row->volume_usd_24h))
                $row->volume_usd_24h = number_format($row->volume_usd_24h, 2);
            if (isset($row->market_cap_usd))
                $row->market_cap_usd = number_format($row->market_cap_usd, 0);
            if (isset($row->percent_change_1h))
                $row->percent_change_1h = number_format($row->percent_change_1h, 2);
            if (isset($row->percent_change_24h))
                $row->percent_change_24h = number_format($row->percent_change_24h, 2);
            if (isset($row->percent_change_7d))
                $row->percent_change_7d = number_format($row->percent_change_7d, 2);
        }
        return $results;
    }

    /**
     * Search for coins whose symbol or name matches the search term
     *
     * @param string $term
     * @param int $pageSize
     * @return mixed
     */
    public static function searchCoins($term, $pageSize = 10)
    {
        $results = DB::table('coins')
            ->whereNotNull('coin_id')
            //->whereNotNull('price_usd')
            ->where(function ($q) use ($term) {
                $q->orWhere('coin_id', 'LIKE', '%' . $term . '%')
                    ->orWhere('symbol', 'LIKE', '%' . $term . '%')
                    ->orWhere('name', 'LIKE', '%' . $term . '%');
            })
            ->simplePaginate($pageSize);

        return self::processSearchResults($results);
    }



    /**
     * Search for coins whose symbol or name matches the search term
     *
     * @param string $term
     * @param int $pageSize
     * @return mixed
     */
    public static function searchCoinsWithCount($term, $pageSize = 10)
    {
        $results = DB::table('coins')
            ->whereNotNull('coin_id')
            //->whereNotNull('price_usd')
            ->where(function ($q) use ($term) {
                $q->orWhere('coin_id', 'LIKE', '%' . $term . '%')
                    ->orWhere('symbol', 'LIKE', '%' . $term . '%')
                    ->orWhere('name', 'LIKE', '%' . $term . '%');
            })
            ->paginate($pageSize);

        return self::processSearchResults($results);
    }

    public static function topMovers($min_volume = 50000, $limit = 10, $sort = 'desc')
    {
        $min_volume = $min_volume !== null ? (int)$min_volume : 50000;
        $rows = Cache::remember('coin.movers_' . $min_volume . '_' . $limit . '_' . $sort,
            Consts::CACHE_DURATION_SMALL,
            function () use ($min_volume, $limit, $sort) {
                return DB::table('coins')
                    ->orderBy('percent_change_24h', $sort)
                    ->orderBy('price_usd', $sort)
                    ->where('price_usd', '>', 0)
                    ->where('market_cap_usd', '>', 0)
                    ->where('volume_usd_24h', '>', $min_volume)
                    ->whereNotNull('coin_id')
                    ->take($limit)
                    ->get();
            });

        foreach ($rows as &$row) {
            $row->price_usd = number_format($row->price_usd, 2);
            $row->percent_change_24h = number_format($row->percent_change_24h, 2);
            $row->market_cap_usd = number_format($row->market_cap_usd);
        }
        return $rows;
    }

    /**
     * Check if coin has historical data
     *
     * @param string $symbol
     * @return bool
     */
    public static function hasHistoricalData($symbol): bool
    {
        $symbol = strtoupper($symbol);
        $count = Cache::remember('has_hx_' . $symbol,
            Consts::CACHE_DURATION_SMALL,
            function () use ($symbol) {
                return DB::table('coin_daily_histories')
                    ->whereSymbol($symbol)
                    ->count();
            }
        );

        return ($count > 0);
    }

    /**
     * Seeds required data in case of a fresh installation.
     */
    public static function bootstrap()
    {
        try {
            $am_i_a_virgin = Cache::remember('bs_currency_count',
                Consts::CACHE_DURATION_LONG,
                function () {
                    return Currency::count() == 0;
                });

            if ($am_i_a_virgin) {
                // Fresh installation. Fetch some required data
                Helper::updateCurrencyRates();
                CoinRepository::updateCoinData();
                Cache::forget('bs_currency_count');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public static function getTotalMarketCap()
    {
        $total = DB::table('coins')->sum('market_cap_usd');

        return $total;
    }

    public static function getTotalMarketVolume()
    {
        $total = DB::table('coins')->sum('volume_usd_24h');

        return $total;
    }

    public static function getBitcoinData()
    {
        
        return DB::table('coins')->select('price_usd','logo')->where('symbol','btc')->get();

    }

    public static function getEthData()
    {
        
        return DB::table('coins')->select('price_usd','logo')->where('symbol','eth')->get();

    }

   
   public static function getLiteData()
    {
        
        return DB::table('coins')->select('price_usd','logo')->where('symbol','LTC')->get();

    }

    public static function getPressData()
    {
        
        return  DB::table('press_release')->select('*')->orderBy('id', 'DESC')->groupBy('title')->take('03')->get();

    }

     public static function getEthNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%ethereum news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }    

  public static function getBitNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%bitcoin news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }  

      public static function getRipNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%ripple news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }

          public static function getIcoNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%ico news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }

           public static function getBloNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%blockchain news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }

           public static function getCalData()
    {
        
        return  DB::table('coincalendar')->select('*')->limit(2)->get();
      }

      public static function getallNewsData()
    {
        
        return  DB::table('news')->select('*')->groupBy('title')->get();
      }    
         public static function getFeatNewsData()
    {
        
        return  DB::table('news')->select('*')->where('category', 'like', '%cryptocurrency news%')->orderBy('last_updated', 'DESC')->groupBy('title')->limit(8)->get();
      }

          public static function getallcoins()
            {
                
                return  DB::table('coins')->limit(12)->select('*')->get();
              }  
                



}