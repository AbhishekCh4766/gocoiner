<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\EventRepository;
use App\Library\CoinRepository;
use Illuminate\Http\Request;
use App\News;
use App\Coin;
use App\CoinCalender;
use App\NewsCryptoo;
use App\Recommendation;
use App\Portfolio;
use Log;
use Auth;
use DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check())
          {


        $pageSize = (int)session(Consts::SESSION_MAX_COINS, 24);

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $coins = Coin::sortable(['market_cap_usd' => 'desc'])->get();
        // ini_set('memory_limit', '671006720');


        $user = Auth::user()->id;
         
        $portfolioCount = DB::table('portfolio')
                ->select(DB::raw('SUM(buying_value) as total'))
                ->where('portfolio.user_id',$user)
                ->get();
        $portfolioCountUSD =  $portfolioCount[0]->total;


         $port = DB::table('portfolio')
            ->select('portfolio.*','coins.name','coins.price_usd')
            ->join('coins', 'coins.id', '=', 'portfolio.coin_id')
            ->where('portfolio.user_id',$user)
            ->get();

        $total_current_value = $total_gain = $total_loss = 0;

        foreach($port as $data)
        {
          $count_total= $data->no_of_coins * $data->price_usd; 

          $total_current_value= $total_current_value + $count_total;
 
          $diff= $count_total - ($data->buying_value);   

          if($diff >= 0){
            $total_gain = $total_gain+$diff;
          } 
          else{
            $total_loss = $total_loss - $diff;
          }       
        }

        $total_gain_loss = $total_gain - $total_loss; 

          if($total_gain_loss >= 0){
            $total_gain_loss = "Gain: $".$total_gain_loss;
          } 
          else{
            $total_gain_loss = "Loss: $".$total_gain_loss;
          } 

        $total_current_value = number_format($total_current_value,2);

    	return view('frontend.myportfolio', compact('totalCap','totalVolume','btcData','ethData','liteData','coins','port','portfolioCountUSD','total_current_value','total_gain_loss'));
    }
    else
    {
      $request->session()->put('key', '/myportfolio');
      return redirect('login?from=myportfolio');
    }
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
       
       public function recommend(Request $request)
    {
           if(Auth::check())
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

          $recommendation = Recommendation::select('*')->paginate($pageSize);

        // echo "<pre>";
        // print_r($coins); die;
         
        return view('frontend.recommend', compact('allNewsData','totalCap','totalVolume','btcData','ethData','liteData','coins','recommendation'));
        }
    else
    {
      $request->session()->put('key', '/recommendations');
      return redirect('login?from=recommendations');
    }
    
    }


            public function store(Request $request)
                { 
        
                  //dd($request);
                        
                   $coin_details = Coin::where('id',$request->coin_id)->first();

                   $user_id = Auth::user()->id;
               
                  
                       
                       if($request->booked_value_usd == null)
                       {
                          $value_usd =  $coin_details->price_usd;
                       }
                       else
                       {
                         $value_usd =$request->booked_value_usd;
                       }

                       $buying_value = ($value_usd * $request->no_of_coins);

                        $this->validate($request, [
                          'coin_id' => 'required',
                          'no_of_coins' => 'required', 
                         'purchased_date' => 'required',
                          ]);

                              $reg = new Portfolio;
                              $reg->user_id = $user_id;
                              $reg->coin_id = $request->coin_id;
                              $reg->no_of_coins = $request->no_of_coins;
                              $reg->buying_value =  $buying_value;
                              $reg->purchased_date =$request->purchased_date;
                              $reg->notes = $request->notes;
                              

                    if($reg->save())
                    {
                      return redirect('myportfolio')->with('success', 'Your Portfolio added Successfully');
                    }

                    else
                    {
                      return 'Registration Error';
                    }

             }

    public function notification(){
        $notification = array(
            'message' => 'Thanks! We shall get back to you soon.', 
            'alert-type' => 'success'
        );
        session()->set('notification',$notification);
        return view('notification');
    }

    public function details($abc)
    {
           if(Auth::check())
          {
        //$pageSize = (int)session(Consts::SESSION_MAX_COINS, 24);

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $recommendation = Recommendation::where('id', $abc)->get();

        //dd($recommendation);
      return view('frontend.recommend_details', compact('pageSize','btcData','ethData','totalCap','totalVolume','liteData','recommendation'));
    }
      else
      {
        return redirect('login?from=recommendations'); 
      }
    }

    public function getcoindetails(Request $request){
      $coin_id = $request->coin_id;
      $data = Coin::where('id',$coin_id)->first();

      //return response()->json('message',$data);
      return response()->json(array('msg'=> $data));
    }

   public function deleteportfolio(Request $request)
{

    $id = Auth::user()->id;
    $ch = DB::table('portfolio')->where('user_id', $id)->exists();
    if($id && $ch)
    {
        DB::table('portfolio')->where('user_id', $id)->delete();
        return redirect('/myportfolio')->with('success','You have Successfully Deleted your portfolio.');
    }
    
    else
    {
        return redirect('/myportfolio')->with('error', 'Portfolio couldnot be deleted, Please add Portfolio First.');
    }
}
}    