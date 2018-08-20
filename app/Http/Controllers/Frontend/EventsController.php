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

        $access_token = $this->get_access_token();

        $url='https://api.coinmarketcal.com/v1/events?access_token='.$access_token.'&page=1&max=16';
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($data);

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

    // dd($data);

        return view('frontend.events', compact('totalCap','totalVolume','btcData','ethData','liteData','data'));

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
    public function get_access_token()
    {
        $url='https://api.coinmarketcal.com/oauth/v2/token?grant_type=client_credentials&client_id=334_1k9wgaeeiw80osksc0cgw4gs008s0cc8ok8w4gs000kkgokk0o&client_secret=4qlxlrzlzh2cww8c0w08oosogos8owoso8w40o80ksc44wwcss';
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch); 
        curl_close($ch);
        $data = json_decode($data);

        return $data->access_token;
    }
 
}