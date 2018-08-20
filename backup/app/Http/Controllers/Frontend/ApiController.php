<?php

namespace App\Http\Controllers\Frontend;

use App\CoinDailyHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AjaxFormRequest;
use App\Library\CoinRepository;
use App\Library\Consts;
use App\Library\JobQueueRepository;
use Cache;

class ApiController extends Controller
{
    /**
     * @param AjaxFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function history(AjaxFormRequest $request)
    {
        $symbol = $request->get('symbol');
        $limit = $request->get('limit');
        $result = Cache::remember('api.daily_hx_' . $symbol . '.' . $limit,
            Consts::CACHE_DURATION_SMALL,
            function () use ($limit, $symbol) {
                $rows = $this->getDailyHistory($symbol, $limit)->toArray();
                return array_map(function ($r) {
                    return [
                        'date' => $r['date'],
                        'price' => (float)$r['value'],
                        'price_fmt' => number_format($r['value'], 2),
                        'volume' => (float)$r['volume'],
                        'volume_fmt' => number_format($r['volume']),
                    ];
                }, $rows);
            }
        );
        return response()->json($result);
    }

    /**
     * Returns daily price-volume historical data
     *
     * @param string $symbol
     * @param int $limit
     * @return mixed
     * @throws \Exception
     */
    private function getDailyHistory($symbol, $limit = 30)
    {
        $symbol = strtoupper($symbol);
        if (!CoinRepository::hasHistoricalData($symbol)) {
            CoinRepository::updateDailyHistory($symbol, 'USD', 365 * 3);
        } else {
            # queue the job for future update
            JobQueueRepository::queueJob($symbol);
        }

        return CoinDailyHistory::whereSymbol($symbol)
            ->orderByDesc('date')
            ->take($limit)
            ->get();
    }
}