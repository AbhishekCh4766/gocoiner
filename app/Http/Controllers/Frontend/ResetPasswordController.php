<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Library\CoinRepository;
use Illuminate\Http\Request;
use App\User;
use App\Notifications\PasswordReset;
use Mail;
use App\Library\Consts;
use App\Notifications\Frontend\UserNeedsPasswordReset;
use PHPMailer;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function reset(Request $request, $token = null)
    {
        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        return view('frontend.reset_password', compact('totalCap','totalVolume','btcData','ethData','liteData'))->with(['token' => $token, 'email' => $request->email] );
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

     public function sendResetLinkEmail(Request $request){

            $email = $request->email;

            //dd('ffd');

            $user = User::where('email', '=', $email)->first();
           // dd($user->id);
            
            if ($user == null) {
                
                return back()->with('error', 'Please Check, Your Email Does not Exists With Gocoiner.com.');
            }
           else{
              $id = base64_encode($user->id);
              $link = asset('verify/');
             //dd($link);
              //send mail to verify email
              require_once(public_path('phpmailer/class.phpmailer.php'));


              $mail = new PHPMailer();

             //dd('dda');

              $mail->IsSMTP();
              $mail->Host = "gocoiner.com";

              $mail->SMTPAuth = true;
              //$mail->SMTPSecure = "ssl";
              $mail->Port = 587;
              $mail->Username = "xu79rce8hj8b@gocoiner.com";
              $mail->Password = "W&say6Fay&{G";

              $mail->From = "admin@gocoiner.com";
              //$mail->To = "vivek.allalgos@gmail.com";
              $mail->FromName = "Gocoiner";
              $mail->AddAddress($email);
              //$mail->AddReplyTo("vivek.allalgos@gmail.com");

              $mail->IsHTML(true);

              $mail->Subject = "Gocoiner Reset Password Request";
              $message = 'Please click on below link to Reset your Password.<br/>';
              $message .= 'Gocoiner-Link-'.$link.'/'.$id;
             // dd($message);
              $mail->Body = $message;
              //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

              if(!$mail->Send())
              {
                  echo "Message could not be sent. <p>";
                  echo "Mailer Error: " . $mail->ErrorInfo;
                  exit;
              }
              
            return redirect('reset-password')->with('success', 'Please check your mail, We sent you a Link to reset your password, Might take a few minutes to arrive');
      }
    }

    public function reset_form($id)
    {
      // $id = $request->id;
       // print_r($id);
       // die("djh");
        $id = base64_decode($id);
       

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);


        return view('frontend.passwords.reset_password_form', compact('totalCap','totalVolume','btcData','ethData','liteData','id'));
    }


    public function update_password(Request $request, $id)
    {
           
                    $user = User::findOrFail($id);

                    $user->password = bcrypt($request->password);

                      if ($user->save()) {
                       return redirect('reset-password')->with('success', 'Your Password is changed Successfully, Please Login to continue');
                      }

                      else
                      {
                        return back()->with('error', 'Could not save password');
                      }
    } 
}
