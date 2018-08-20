<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Library\Consts;
use App\Library\EventRepository;
use App\Library\CoinRepository;
use App\News;
use App\Coin;
use App\CoinCalender;
use App\NewsCryptoo;
use App\Recommendation;
use App\Portfolio;
use App\User;
use Log;
use Auth;
use session;
use Socialite;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function authenticate(Request $request)
    {

 
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if(isset($_POST["from"])){
                return redirect('/'.$_POST["from"])->with('success','You are Successfully Logged in.');
            }
            else{
                return redirect('/myportfolio')->with('success','You are Successfully Logged in.');
            }

       /* $request->session()->flash('message.content', 'Post was successfully added!');
        return redirect('/myportfolio');*/

    }

        else
        {
            return redirect('/login')->with('error','Error! Please Enter valid Credentials');
        }


    }

    public function socialLogin($social){
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(Request $request, $social){
        $userSocial = Socialite::driver($social)->user();

        $email = $userSocial->getEmail();

        $user = DB::table('users')->where('email', $email)->first();
        if($user){
            Auth::loginUsingId($user->id);
           // return redirect('/myportfolio')->with('success','You are Successfully Logged in.');
             $value = $request->session()->get('key');
            
            //dd($value);
            return redirect()->intended($value)->with('success','You are Successfully Logged in.');

        }
        else{
            $name = str_replace(" ","-",$userSocial->getName());
            $password = rand(1000000, 15000000);

            $reg = new User;
            $reg->name = $name ;
            $reg->email = $email;
            $reg->password = bcrypt($password);
            $reg->role ='2';

            if($reg->save())
            {
                $user = DB::table('users')->where('email', $email)->first();
                Auth::loginUsingId($user->id);
                return redirect('/myportfolio')->with('success','You are Successfully Logged in.');
            }
        }
    }
}
