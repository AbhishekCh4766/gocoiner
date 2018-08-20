<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function index()
    {
           $top_coins = [];
        $limit = 5;
        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . Helper::formatCurrency($coin->price_usd),
                'change' => Helper::formatPercent($coin->percent_change_24h),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'DESC');
        $losers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'ASC');
        $pages = Page::active()->post()->simplePaginate(setting(Consts::ARTICLE_LIST_COUNT));
        return view('frontend.pages.index', compact('pages','gainers','losers'));
    }

    /**
     * Renders page content
     *
     * @param Page $page
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public static function renderPage(Page $page)
    {
   $top_coins = [];
        $limit = 5;
        foreach (CoinRepository::topCoins($limit) as $coin) {
            $top_coins[$coin->symbol] = [
                'name' => $coin->name,
                'logo' => $coin->logo,
                'price' => '$' . Helper::formatCurrency($coin->price_usd),
                'change' => Helper::formatPercent($coin->percent_change_24h),
            ];
        }

        $limit = 8;
        $gainers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'DESC');
        $losers = CoinRepository::topMovers(AppSettings::instance()->topMoversMinVolume, $limit, 'ASC');

        if ($page->isCustomPage()) {
            return response($page->content);
        }
        return view('frontend.pages.show', compact('page','gainers','losers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {

        
        $page = Page::findOrFail($id);
        return self::renderPage($page);
    }
}
