<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertMenuRequest;
use App\MenuItem;
use App\Page;
use DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = MenuItem::topLevelMenus(10);
        return view('backend.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::pluck('title', 'id');
        $parents = MenuItem::pluck('name', 'id');
        return view('backend.menus.create', compact('pages', 'parents'));
    }

    /**
     * Insert or update page
     *
     * @param UpsertMenuRequest $request
     * @param MenuItem $menu
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function upsert(UpsertMenuRequest $request, MenuItem $menu = null)
    {
        $action = 'update';
        if ($menu == null) {
            $menu = new MenuItem();
            $action = 'create';
        }

        $menu->name = $request->input('name');
        $menu->parent_id = (int)($request->input('parent_id') ?? 0);
        $menu->order = (int)($request->input('order') ?? 0);
        $menu->link = $request->input('link');
        $menu->page_id = $request->input('page_id');
        $menu->active = $request->input('active') !== false;
        if ($menu->save()) {
            flash()->success('Menu ' . $action . 'd successfully')->important();
            return redirect(route('private.menus.index'));
        }

        flash()->error('Unable to ' . $action . ' menu. Please try again.');
        return back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpsertMenuRequest $request
     * @return MenuController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UpsertMenuRequest $request)
    {
        return $this->upsert($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menu)
    {
        $pages = Page::pluck('title', 'id');
        $parents = MenuItem::where('id', '<>', $menu->id)->pluck('name', 'id');

        return view('backend.menus.edit', compact('menu', 'pages', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpsertMenuRequest $request
     * @param  \App\MenuItem $menu
     * @return MenuController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpsertMenuRequest $request, MenuItem $menu)
    {
        return $this->upsert($request, $menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem $menu
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(MenuItem $menu)
    {
        DB::table('menu_items')
            ->where('parent_id', $menu->id)
            ->update(['parent_id' => 0]);

        if ($menu->delete()) {
            flash()->success('Menu deleted successfully')->important();
        } else {
            flash()->error('Unable to delete menu. Please try again.');
        }

        return redirect(route('private.menus.index'));
    }
}
