<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertPageRequest;
use App\Library\Consts;
use App\Library\PageRepository;
use App\Press_release;
use App\Recommendation;
use DB;

class RecommendationController extends Controller
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
        $recommendation = Recommendation::paginate(10);


        return view('backend.recommendation.index', compact('recommendation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.recommendation.create', ['page_type' => Consts::PAGE_TYPE_POST]);
    }

    /**
     * Show the form for creating a new custom Press_release.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom()
    {
        return view('backend.recommendation.create',['page_type' => Consts::PAGE_TYPE_POST]);
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
        $Recommendation = Recommendation::findOrFail($id);
        if ($Recommendation->page_type == Consts::PAGE_TYPE_CUSTOM) {
            return response($Recommendation->content);
        }
        return view('backend.recommendation.show', compact('Recommendation'));
    }

    /**
     * Insert or update Press_release
     *
     * @param UpsertPageRequest $request
     * @param Press_release|null $Press_release
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function upsert(UpsertPageRequest $request, Recommendation $Recommendation = null)
    {

        $action = 'update';
        if ($Recommendation == null) {
            $Recommendation = new Recommendation();
            $action = 'create';
        }
                    // die("upsert");

                    
                    $Recommendation->title = $request->input('title');
                    $Recommendation->slug = $request->input('slug');
                    if (blank($Recommendation->slug)) {
                    $Recommendation->generateSlug();
                    }
  
                    $Recommendation->active = $request->input('active') !== false;
                    $Recommendation->order = $request->input('order');
       
                    $content = $request->input('content');
        
                    $Recommendation->content = $content;
                  

                    /******** upload image *******************/


                    if(!empty($request->file('pic'))){
               
                        $image = $request->file('pic');

                        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

                        $destinationPath = public_path('/images/press_release');

                        $image->move($destinationPath, $input['imagename']);

                        $Recommendation->pic = $input['imagename'];
                    }



                    //$this->postImage->add($input);


        if ($Recommendation->save()) {
            //Recommendation::flushCache();
            flash()->success('Recommendation ' . $action . 'd successfully')->important();
             return redirect(route('private.recommendation.index'));
             
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
        $Recommendation = Recommendation::findOrFail($id);
        return view('backend.recommendation.edit', compact('Recommendation'));
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
        $Recommendation = Recommendation::findOrFail($id);
        return $this->upsert($request, $Recommendation);
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
        $Recommendation = Recommendation::findOrFail($id);

        DB::table('menu_items')
            ->whereNotNull('page_id')
            ->where('page_id', $id)
            ->update(['page_id' => null]);

        if ($Recommendation->delete()) {
            flash()->success('Recommendation deleted successfully')->important();
        } else {
            flash()->error('Unable to delete Recommendation. Please try again.');
        }

        return redirect(route('private.recommendation.index'));
    }
}
