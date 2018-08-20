<?php

namespace App\Http\Controllers\Backend;

use App\Coin;
use App\Http\Controllers\Controller;
use App\Library\Helper;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::paginate(50);
        return view('backend.coins', compact('coins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coin = Coin::findOrFail($id);
        return view('backend.coin', compact('coin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coin = Coin::findOrFail($id);
        $coin->description = Helper::toMarkdown($request->get('description'));
        $coin->features = Helper::toMarkdown($request->get('features'));
        $coin->technology = Helper::toMarkdown($request->get('technology'));

        if ($coin->save()) {
            flash($coin->name . ' updated successfully')->important();
            return redirect()->back();
        }

        flash()->error('Unable to update coin. Please try again.');
        return back()->withInput();

    }
}