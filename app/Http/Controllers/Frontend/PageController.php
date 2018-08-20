<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Page;
use App\Library\CoinRepository;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function index()
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
        $pages = Page::active()->post()->simplePaginate(setting(Consts::ARTICLE_LIST_COUNT));
        return view('frontend.pages.index', compact('pages','gainers','losers'));
    }

    /**
     * Renders page content
     *
     * @param Page $page
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
       public static function renderPage(Page $page)
    {

         $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  self::format_cash($totalCap);

        $totalVolume =  self::format_cash($totalVolume);
        
        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();
         
        $liteData = CoinRepository::getLiteData();       

        // if ($page->isCustomPage()) {
        //     return response($page->content);
        //     //return response()->view('frontend.pages.show', ['page', '=>', 'content']);
        // }
       return view('frontend.pages.show', compact('totalVolume','totalCap','btcData','ethData','liteData','page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        //echo $slug; die();
        $page = Page::where('slug',$slug)->firstOrFail();
        return self::renderPage($page);
    }


    public static function format_cash($cash) {
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

}
