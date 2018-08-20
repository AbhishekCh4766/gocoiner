<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\CryptoCoinsIco;
use App\Library\CoinRepository;

class CryptoIcoController extends Controller
{
	public function index($type)
	{  
        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);
		
		$ico_params = $this->getStatusByType($type);
		$icos = CryptoCoinsIco::where('status', $ico_params['status'])->orderBy('id', 'asc')->paginate(10);
		foreach ($icos as $ico) {
			$ico['time_left'] = $this->startEndDateDifference($ico['start_time'], $ico['end_time']);
		}
		$data = ['totalCap'=> $totalCap,'totalVolume'=> $totalVolume,'btcData'=> $btcData,'ethData'=> $ethData,'liteData' => $liteData, 'icos' => $icos, 'type' => $type, 'ico_title' => $ico_params['title'], 'ico_desc' => $ico_params['desc']];
		return view('frontend.ico', $data);
	}

	public function startEndDateDifference($date_1 , $date_2 , $differenceFormat = '%a days %h hours %i minutes' )
	{
	    $datetime1 = date_create($date_1);
	    $datetime2 = date_create($date_2);
	    $interval = date_diff($datetime1, $datetime2);
	    return $interval->format($differenceFormat);
	}

	public function getStatusByType($type)
	{
		if($type == 'active') {
			return ['status' => 0, 'title' => __('seo.ACTIVE_ICO_TITLE'), 'desc' => __('seo.ACTIVE_ICO_DESCRIPTION')];
		} else if($type == 'upcoming') {
			return ['status' => 1, 'title' => __('seo.UPCOMING_ICO_TITLE'), 'desc' => __('seo.UPCOMING_ICO_DESCRIPTION')];
		}
		return ['status' => 2, 'title' => __('seo.FINISHED_ICO_TITLE'), 'desc' => __('seo.FINISHED_ICO_DESCRIPTION')];
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
