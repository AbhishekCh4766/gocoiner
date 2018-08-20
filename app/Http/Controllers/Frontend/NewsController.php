<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\NewsRepository;
use App\Library\CoinRepository;
use App\News;
use App\CoinCalender;
//use App\NewsCryptoo;
use Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // refresh data if needed
        // if (NewsRepository::needsUpdate(Consts::NEWS_REFRESH_INTERVAL)) {
        //     try {
        //         NewsRepository::updateNews();
        //     } catch (\Exception $e) {
        //         Log::error($e->getMessage());
        //     }
        // }

        $limit = 12;
        if ($limit <= 0) {
            $limit = 12;
        }
        if ($limit > 25) {
            $limit = 25;
        }

        $btcData = CoinRepository::getBitcoinData();

        $ethData = CoinRepository::getEthData();

        $totalCap = CoinRepository::getTotalMarketCap();

        $totalVolume = CoinRepository::getTotalMarketVolume();

        $totalCap =  $this->format_cash($totalCap);

        $liteData = CoinRepository::getLiteData();

        $totalVolume =  $this->format_cash($totalVolume);

        $allNewsData = CoinRepository::getallNewsData();


        if(isset($_REQUEST["q"])){
                $news = News::where('category', 'like', '%cryptocurrency news%')->where('title', 'like', '%'.$_REQUEST["q"].'%')->orderByDesc('last_updated')->groupBy('title')->paginate($limit); 
        }
        else{
                $news = News::select('*')->where('category', 'like', '%cryptocurrency news%')->orderBy('last_updated', 'DESC')->groupBy('title')->paginate($limit);
         }
		 
		 
		//$news = News::paginate(5);

        return view('frontend.news', compact('news','allNewsData','totalCap','totalVolume','btcData','ethData','liteData'));

    }



    /**
     * Redirect to external URL
     *
     * @param string $id Hash id of the resource
     * @return \Illuminate\Http\Response
     */
    public function go($id)
    {
        $news = News::where('hashid', $id)->firstOrFail();
        return redirect()->away($news->url);
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


        public function saveBitData()
    {
          
        $feed = 'https://cryptocurrencynews.com/category/basic-materials/daily-news/bitcoin-news/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }


    public function saveEthData()
    {
          
        $feed = 'https://cryptocurrencynews.com/category/basic-materials/daily-news/ethereum-news/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }

    public function saveRipData()
    {
          
        $feed = 'https://cryptocurrencynews.com/category/basic-materials/daily-news/ripple-news/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }
        public function saveicoData()
    {
          
        $feed = 'https://cryptocurrencynews.com/category/icos/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }
        public function saveBloData()
    {
          
         
        $feed = 'https://cryptocurrencynews.com/category/blockchain/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }
        public function saveFeaData()
    {
          
         
        $feed = 'https://cryptocurrencynews.com/feed/';
        $feed_to_array = (array) simplexml_load_file($feed);
        $xml = simplexml_load_file($feed, 'SimpleXMLElement',LIBXML_NOCDATA);

         foreach ($xml->channel->item as $key => $value) { 

            $category = $value->category;
            $category = implode(",", json_decode( json_encode($category) , 1));

            $newsObj = new News;

            $newsObj->title = $value->title;
            $newsObj->url = $value->link;
            $newsObj->published_on = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->last_updated = date('Y-m-d H:m:s',strtotime($value->pubDate));
            $newsObj->category = $category;

            preg_match('/<div class=\"mh\-excerpt\">(.*?)<\/div>/s', $value->description, $matches);

            $body = htmlspecialchars_decode((strip_tags($matches[1])));

            $content = $value->description;
     
            $doc = new \DOMDocument();
     
            @$doc->loadHTML($content);
     
            $xml = simplexml_import_dom($doc); // making xpath more simple
     
            $images = $xml->xpath('//img');

            $newsObj->body = $body;
            $newsObj->image = UTF8_DECODE($images[0]['src']);
            
            $newsObj->save();
        
        }
    }
}