<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertPageRequest;
use App\Library\Consts;
use App\Library\PageRepository;
use App\Press_release;
use DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {

        ini_set('display_errors', 'On');
        error_reporting(-1);
        define('MP_DB_DEBUG', true);
        $newses = Press_release::paginate(10);


        return view('backend.newses.index', compact('newses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.newses.create', ['page_type' => Consts::PAGE_TYPE_POST]);
    }

    /**
     * Show the form for creating a new custom Press_release.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom()
    {
        return view('backend.newses.create',['page_type' => Consts::PAGE_TYPE_POST]);
       // return view('backend.newses.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Press_release = Press_release::findOrFail($id);
        if ($Press_release->page_type == Consts::PAGE_TYPE_CUSTOM) {
            return response($Press_release->content);
        }
        return view('backend.newses.show', compact('Press_release'));
    }

    /**
     * Insert or update Press_release
     *
     * @param UpsertPageRequest $request
     * @param Press_release|null $Press_release
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function upsert(UpsertPageRequest $request, Press_release $Press_release = null)
    {

        $action = 'update';
        if ($Press_release == null) {
            $Press_release = new Press_release();
            $action = 'create';
        }
                    // die("upsert");

                    
                    $Press_release->title = $request->input('title');
                    $Press_release->slug = $request->input('slug');
                    if (blank($Press_release->slug)) {
                    $Press_release->generateSlug();
                    }
                    // die("upsert");
                    //$Press_release->page_type = $request->input('page_type');
                    $Press_release->active = $request->input('active') !== false;
                    $Press_release->order = $request->input('order');
                    //  $Press_release = time().'.'.$request->pic->getClientOriginalExtension();
                    // $request->pic->move(public_path('avatars'), $Press_release);
                    $content = $request->input('content');
        
                    $Press_release->content = $content;
                    //  $Press_release->meta_keywords = $request->input('meta_keywords');
                    // $Press_release->meta_description = $request->input('meta_description');

                    /******** upload image *******************/


                    if(!empty($request->file('pic'))){
               
                        $image = $request->file('pic');

                        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/images/press_release');

                        $image->move($destinationPath, $input['imagename']);

                        $Press_release->pic = $input['imagename'];
                    }



                    //$this->postImage->add($input);


        if ($Press_release->save()) {
            //Press_release::flushCache();
            flash()->success('Press release ' . $action . 'd successfully')->important();
             return redirect(route('private.newses.index'));
             
         }

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
        $Press_release = Press_release::findOrFail($id);
        return view('backend.newses.edit', compact('Press_release'));
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

       // die("update");
        $Press_release = Press_release::findOrFail($id);
        return $this->upsert($request, $Press_release);
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
        $Press_release = Press_release::findOrFail($id);

        DB::table('menu_items')
            ->whereNotNull('page_id')
            ->where('page_id', $id)
            ->update(['page_id' => null]);

        if ($Press_release->delete()) {
            flash()->success('Press_release deleted successfully')->important();
        } else {
            flash()->error('Unable to delete Press_release. Please try again.');
        }

        return redirect(route('private.newses.index'));
    }
}
