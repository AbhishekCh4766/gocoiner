<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Library\Consts;
use App\Library\Languages;
use Cache;
use DB;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class LanguageController extends Controller
{
    public function index()
    {
        $groups = DB::table('language_lines')
            ->select('group')
            ->distinct()
            ->orderBy('group')
            ->get()
            ->toArray();
        return view('backend.translations.index', compact('groups'));
    }

    /**
     * @param string $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($group)
    {
        $group = strtolower($group);
        $entries = LanguageLine::whereGroup($group)->get();
        return view('backend.translations.edit', compact('entries', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request)
    {
        $group = strtolower($request->input('_group'));
        foreach ($request->except(['_token', '_group']) as $key => $value) {
            $key = strtolower($key);
            if (!blank($value)) {
                $text = json_encode([setting(Consts::APP_LOCALE, 'en') => trim($value)]);
                DB::table('language_lines')
                    ->whereGroup($group)
                    ->whereKey($key)
                    ->update([
                        'text' => $text
                    ]);
            }
        }

        Cache::flush();
        Cache::clear();
        flash()->success('Language entries updated')->important();
        return redirect()->route('admin.lang.index');
    }

    public function reset($group)
    {
        switch (strtolower($group)) {
            case 'home':
                Languages::seedHome();
                break;
            case 'system':
                Languages::seedSystem();
                break;
            case 'pagination':
                Languages::seedPagination();
                break;
            case 'coin':
                Languages::seedCoin();
                break;
            case 'news':
                Languages::seedNews();
                break;
            case 'market':
                Languages::seedMarket();
                break;
        }

        flash()->success('Language entries for "' . $group . '"" reset successfully')->important();
        return redirect()->route('admin.lang.index');
    }

    public function reseed()
    {
        DB::table('language_lines')->truncate();

        Languages::seedHome();
        Languages::seedSystem();
        Languages::seedPagination();
        Languages::seedCoin();
        Languages::seedNews();
        Languages::seedMarket();

        flash()->success('Language entries reset successfully')->important();
        return redirect()->route('admin.lang.index');
    }
}