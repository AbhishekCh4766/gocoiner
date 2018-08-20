<?php

namespace App\Http\Controllers\Frontend;

use App\Coin;
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
use App\FrontUser;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Library\EventRepository;
use App\News;
use App\CoinCalender;
use App\NewsCryptoo;
use Illuminate\Http\Request;
class RegistrationController extends Controller
{

	 public function index()
    {

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $allNewsData = CoinRepository::getallNewsData();

      return view('frontend.register', compact('allNewsData','totalCap','totalVolume','btcData','ethData','liteData'));
    }

    public function store(Request $request)
    {
                            $this->validate($request, [
                          'username' => 'required|max:255',
                          'email' => 'required|unique:users',
                          'password' => 'required',
                          ]);
                       
                  $reg = new User;
                  $reg->name = $request->username ;
                  $reg->email = $request->email;
                  $reg->password = bcrypt($request->password);
                  $reg->role ='2';

        if($reg->save())
        {
          return redirect('/login')->with('success','Signup Successfull, No Email Confirmation Required, Please login to Continue.');
        }

      /*  else
        {
            //return redirect('')->with('error','Signup Error, Please try again.');
              return redirect()->back()->with('message', 'IT WORKS!');
       //   return redirect('/registration')
        }*/

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