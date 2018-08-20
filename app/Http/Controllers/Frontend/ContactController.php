<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Library\Consts;
use App\Library\CoinRepository;
use Mail;

class ContactController extends Controller
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

        return view('frontend.contact', compact('totalCap','totalVolume','btcData','ethData','liteData'));
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

    public function store(ContactFormRequest $request)
    {

                        $this->validate($request, [
                          'name' => 'required',
                          'email' => 'required', 
                         'message' => 'required',
                          ]);
        $app_name = env(Consts::APP_NAME, Consts::DEFAULT_APP_NAME);
        $admin_email = env(Consts::ADMIN_EMAIL);

        if (null !== $admin_email) {
            try {
                Mail::send('emails.contact',
                    [
                        'app_name' => $app_name,
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'ip' => \request()->ip(),
                        'user_message' => $request->get('message')
                    ],
                    function ($msg) use ($app_name, $admin_email) {
                        $msg->from($admin_email);
                        $msg->to($admin_email)->subject("{$app_name} Feedback");
                    });
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        
        return redirect('contact')->with('success', 'Thank you for Contacting us');

    }
}
