<?php

namespace App\Http\Controllers\Frontend;

use App\Coin;
use App\CryptoCoinsIco;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Library\AppSettings;
use App\Library\CoinRepository;
use App\Library\Consts;
use App\Library\Helper;
use App\MenuItem;
use Artisan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Slider;


    use Users;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  


class HomeController extends Controller
{
    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    // public function template()

    // {
    //     return view ("template");
    // }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        // $pageSize = (int)session(Consts::SESSION_MAX_COINS,10000);
        // CoinRepository::bootstrap();

        $top_coins = [];
        $limit = 5;
        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . Helper::formatCurrency($coin->price_usd),
                'change' => Helper::formatPercent($coin->percent_change_24h),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'DESC');
        $losers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'ASC');
        $coins = Coin::valid()->sortable(['market_cap_usd' => 'desc'])->paginate(1000);

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $totalVolume =  $this->format_cash($totalVolume);
        
        $PressData =  CoinRepository::getPressData();

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();
         
        $liteData = CoinRepository::getLiteData();

        $EthNewsData = CoinRepository::getEthNewsData();

        $BitNewsData = CoinRepository::getBitNewsData();

        $RipNewsData = CoinRepository::getRipNewsData();

         $IcoNewsData = CoinRepository::getIcoNewsData();

         $BloNewsData = CoinRepository::getBloNewsData();

          $getFeatNewsData = CoinRepository::getFeatNewsData();

          $CalData = CoinRepository::getCalData();

          $Slider = Slider::get();


      
      $icos = CryptoCoinsIco::where('status', 1)->orderBy('id', 'asc')->limit(3)->get();


        return view('template', compact('top_coins', 'gainers', 'losers','coins','totalCap','totalVolume','btcData','ethData','liteData','PressData','EthNewsData','BitNewsData','RipNewsData','IcoNewsData','BloNewsData','CalData','getFeatNewsData','icos','Slider'));

      
    }

    public function getAutoCompleteData(){
        $query = $_GET['term'];
                //$query = $request->get('term','');
        
        $coins=Coin::valid()->where('name','LIKE','%'.$query.'%')->orWhere('symbol','LIKE','%'.$query.'%')->get();
        
        $data=array();
        foreach ($coins as $coin) {
            if($coin->logo != ''){
                $logo = $coin->logo;
                $data[]=array('value'=>$coin->name,'id'=>$coin->id,'logo'=>'http://gocoiner.com/asset/images/coins/img/'.$logo);
            }else{
                $logo = 'https://gocoiner.com/asset/images/coins/tn/coin.png';
                $data[]=array('value'=>$coin->name,'id'=>$coin->id,'logo'=>$logo);
            }
                //$data[]=array('value'=>$coin->name,'id'=>$coin->id,'logo'=>'http://gocoiner.com/asset/images/coins/img/'.$coin->logo);
                
        }
        if(count($data)){
             return $data;
		}
        else{
			$data[]=array('value'=>'No Result Found','id'=>'','logo'=>'');
			return $data;
		}
        
    }

    /**
     * Show the market page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function market()
    {

        $top_coins = [];
        $limit = 5;
        $pageSize = (int)session(Consts::SESSION_MAX_COINS, 10);

        // refresh data if needed
        if (CoinRepository::needsUpdate(Consts::COINDATA_REFRESH_INTERVAL)) {
            try {
                CoinRepository::updateCoinData();
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }


        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . Helper::formatCurrency($coin->price_usd),
                'change' => Helper::formatPercent($coin->percent_change_24h),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'DESC');
        $losers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'ASC');
        $coins = Coin::valid()->sortable(['market_cap_usd' => 'desc'])->paginate($pageSize);

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $totalVolume =  $this->format_cash($totalVolume);
        
        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $liteData = CoinRepository::getLiteData();


        return view('frontend.market', compact('coins', 'losers','gainers','totalVolume','totalCap','btcData','ethData','liteData'));
    }

    /**
     * View cryptocurrency data
     *
     * @param string $symbol
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function coin($symbol, $slug = null)
    {
        
         $top_coins = [];
        $limit = 5;
        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . Helper::formatCurrency($coin->price_usd),
                'change' => Helper::formatPercent($coin->percent_change_24h),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'DESC');
        $losers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'ASC');

        $total_market_cap = cache()->remember('total_market_cap',
            Consts::CACHE_DURATION_SMALL,
            function () {
                return Coin::sum('market_cap_usd');
            });

        $symbol = strtoupper($symbol);
        $coin = Coin::whereSymbol($symbol)->firstOrFail();
        $coin->market_cap = Helper::formatInteger($coin->market_cap_usd);
        $coin->market_share = Helper::formatPercent(100 * $coin->market_cap_usd / $total_market_cap, 2);
        $coin->volume = Helper::formatInteger($coin->volume_usd_24h);
        $coin->available_supply = Helper::formatInteger($coin->available_supply);
        $coin->max_supply = Helper::formatInteger($coin->max_supply);
        $coin->total_supply = Helper::formatInteger($coin->total_supply);

        $currency_symbol = 'USD';
        $display_currency = cache()->remember('currency_' . $currency_symbol,
            Consts::CACHE_DURATION_SMALL,
            function () use ($currency_symbol) {
                return Currency::where('symbol', '=', $currency_symbol)->firstOrFail();
            });

        $table_rows = [
            [__('coin.mkt_cap'), Helper::withSymbol($coin->market_cap, $display_currency->symbol)],
            [__('coin.volume_24h'), Helper::withSymbol($coin->volume, $display_currency->symbol)],
            [__('coin.mkt_share'), $coin->market_share . ' %'],
            [__('coin.available_supply'), $coin->available_supply],
            [__('coin.change_1h'), Helper::formatChangeText($coin->percent_change_1h) . ' %'],
            [__('coin.max_supply'), $coin->max_supply],
            [__('coin.change_24h'), Helper::formatChangeText($coin->percent_change_24h) . ' %'],
            [__('coin.total_supply'), $coin->total_supply],
            [__('coin.change_7d'), Helper::formatChangeText($coin->percent_change_7d) . ' %'],
            [__('coin.proof'), $coin->proof_type],
            [__('coin.algorithm'), $coin->algorithm],
            ['', '<small class="coin-small">' . __('system.updated') . ': ' . Carbon::instance($coin->last_updated)->diffForHumans() . '</small>']
        ];


        $totalCap = CoinRepository::getTotalMarketCap();

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $totalVolume =  $this->format_cash($totalVolume);

        $liteData = CoinRepository::getLiteData();

        //$crumbs = ['Market' => route('home.market'), $coin->name => ''];
        return view('frontend.coin', compact('coin', 'display_currency', 'table_rows','gainers','losers','totalVolume','totalCap','btcData','ethData','liteData'));
    }

    /**
     * @param int $size
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setPageSize($size)
    {
        if ($size < 10) {
            $size = 10;
        } elseif ($size > 100) {
            $size = 100;
        }
        session()->put(Consts::SESSION_MAX_COINS, (int)$size);
        return redirect()->back();
    }

    public function terms()
    {
        return view('static.terms');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

    public function disclaimer()
    {
        return view('static.disclaimer');
    }

    public function search()
    {

        $totalCap = CoinRepository::getTotalMarketCap();

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

         $liteData = CoinRepository::getLiteData();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $totalVolume =  $this->format_cash($totalVolume);

        $q = Input::get('search_term');
        $coins = CoinRepository::searchCoins($q, 50);

       // $coins = Coin::valid()->sortable(['market_cap_usd' => 'desc'])->simplePaginate($pageSize);

        return view('frontend.search_results', compact('coins','totalCap','btcData','ethData','totalVolume','totalCap','totalVolume','liteData'));
    }

    /**
     * Runs cron job via controller
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cron()
    {
        $exitCode = Artisan::call('schedule:run');
        return response('Success');
    }

    /**
     * Resets cache
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function reset()
    {
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('route:cache');

        return response('Cache has been successfully reset');
    }

    /**
     * Resolves menu items
     *
     * @param int $id
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu($id, $slug)
    {


        $menu = MenuItem::findOrFail($id);
        throw_unless($menu->active, NotFoundHttpException::class);

        $page = $menu->page;
        if ($page == null) {
            return redirect()->back();
        }
        throw_unless($page->active, NotFoundHttpException::class);

        return PageController::renderPage($page);
    }


    public function format_cash($cash) {
        // strip any commas 
        $cash = (0 + STR_REPLACE(',', '', $cash));
     
        // make sure it's a number...
        IF(!IS_NUMERIC($cash)){ RETURN FALSE;}
     
        // filter and format it 
        IF($cash>1000000000000){ 
            RETURN ROUND(($cash/1000000000000),2).' T';
        }ELSEIF($cash>1000000000){ 
            RETURN ROUND(($cash/1000000000),2).' B';
        }ELSEIF($cash>1000000){ 
            RETURN ROUND(($cash/1000000),2).' M';
        }ELSEIF($cash>1000){ 
            RETURN ROUND(($cash/1000),2).' K';
        }
     
        RETURN NUMBER_FORMAT($cash);
    }

public function login()
{


        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $totalVolume =  $this->format_cash($totalVolume);
        
        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();
         
        $liteData = CoinRepository::getLiteData();

    return view('frontend.login', compact('totalVolume','totalCap','btcData','ethData','liteData'));
}


}
