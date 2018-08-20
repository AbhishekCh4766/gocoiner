<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertPageRequest;
use App\Library\Consts;
use App\Library\PageRepository;
use App\Page;
use DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create', ['page_type' => Consts::PAGE_TYPE_POST]);
    }

    /**
     * Show the form for creating a new custom page.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom()
    {
        return view('backend.pages.create', ['page_type' => Consts::PAGE_TYPE_CUSTOM]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        if ($page->page_type == Consts::PAGE_TYPE_CUSTOM) {
            return response($page->content);
        }
        return view('backend.pages.show', compact('page'));
    }

    /**
     * Insert or update page
     *
     * @param UpsertPageRequest $request
     * @param Page|null $page
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function upsert(UpsertPageRequest $request, Page $page = null)
    {
        $action = 'update';
        if ($page == null) {
            $page = new Page();
            $action = 'create';
        }

        $page->title = $request->input('title');
        $page->slug = $request->input('slug');
        if (blank($page->slug)) {
            $page->generateSlug();
        }

        $page->page_type = $request->input('page_type');
        $page->active = $request->input('active') !== false;
        $page->order = $request->input('order');
        $page->content = $request->input('content');
        $page->meta_keywords = $request->input('meta_keywords');
        $page->meta_description = $request->input('meta_description');

        if ($page->save()) {
            PageRepository::flushCache();
            flash()->success('Page ' . $action . 'd successfully')->important();
            return redirect(route('admin.pages.index'));
        }

        flash()->error('Unable to ' . $action . ' page. Please try again.');
        return back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpsertPageRequest $request
     * @return PageController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UpsertPageRequest $request)
    {
        return $this->upsert($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpsertPageRequest $request
     * @param  int $id
     * @return PageController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpsertPageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        return $this->upsert($request, $page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        DB::table('menu_items')
            ->whereNotNull('page_id')
            ->where('page_id', $id)
            ->update(['page_id' => null]);

        if ($page->delete()) {
            flash()->success('Page deleted successfully')->important();
        } else {
            flash()->error('Unable to delete page. Please try again.');
        }

        return redirect(route('admin.pages.index'));
    }
}
