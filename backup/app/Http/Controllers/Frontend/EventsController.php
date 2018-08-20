<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\EventRepository;
use App\Library\CoinRepository;
use App\News;
use App\CoinCalender;
use App\NewsCryptoo;
use Log;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $event = EventRepository::needsUpdate();

        return view('frontend.events', compact('event','UpcomingNews','totalCap','totalVolume','btcData','ethData','liteData'));

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
    /**
     * Redirect to external URL
     *
     * @param string $id Hash id of the resource
     * @return \Illuminate\Http\Response
     */
 
}