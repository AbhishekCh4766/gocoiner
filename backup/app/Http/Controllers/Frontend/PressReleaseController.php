<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\EventRepository;
use App\Library\CoinRepository;
use App\News;
use App\Coin;
use App\CoinCalender;
use App\NewsCryptoo;
use Log;
use App\Press_release;

class PressReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageSize = (int)session(Consts::SESSION_MAX_COINS, 24);

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $allNewsData = CoinRepository::getallNewsData();

        $coins = Coin::valid()->sortable(['market_cap_usd' => 'desc'])->paginate($pageSize);
        
        $press_release = Press_release::select('*')->paginate($pageSize);

        // echo "<pre>";
        // print_r($press_release); die;

    	return view('frontend.press_release', compact('press_release','allNewsData','totalCap','totalVolume','btcData','ethData','liteData','coins'));
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

}    