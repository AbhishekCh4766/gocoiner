<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpsertPageRequest;
use App\Library\Consts;
use App\Library\PageRepository;
use App\Slider;
use DB;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(10);
        return view('backend.slider.index', compact('sliders'));
    }
  public function create()
    {
        return view('backend.slider.create', ['page_type' => Consts::PAGE_TYPE_POST]);
    }

    /**
     * Show the form for creating a new custom Press_release.
     *
     * @return \Illuminate\Http\Response
     */
    public function custom()
    {
        return view('backend.slider.create',['page_type' => Consts::PAGE_TYPE_POST]);
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
        $slider = Slider::findOrFail($id);
        if ($slider->page_type == Consts::PAGE_TYPE_CUSTOM) {
            return response($slider->content);
        }
        return view('backend.slider.show', compact('slider'));
    }

    /**
     * Insert or update Press_release
     *
     * @param UpsertPageRequest $request
     * @param Press_release|null $Press_release
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function upsert(UpsertPageRequest $request, slider $slider = null)
    {
    
        $action = 'update';
        if ($slider == null) {
            $slider = new Slider();
            $action = 'create';
        }
                    // die("upsert");

                    
                    $slider->title = $request->input('title');
                    $slider->slug = $request->input('slug');
                    if (blank($slider->slug)) {
                    $slider->generateSlug();
                    }
  
                    $slider->active = $request->input('active') !== false;
       
                    $content = $request->input('content');
        
                    $slider->content = $content;
                  

                    /******** upload image *******************/


                    // if(!empty($request->file('pic'))){
               
                    //     $image = $request->file('pic');

                    //     $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

                    //     $destinationPath = public_path('/images/press_release');

                    //     $image->move($destinationPath, $input['imagename']);

                    //     $slider->pic = $input['imagename'];
                    // }



                    //$this->postImage->add($input);


        if ($slider->save()) {
            //slider::flushCache();
            flash()->success('slider ' . $action . 'd successfully')->important();
             return redirect(route('private.slider.index'));
             
         }

         else
         {
            return redirect(route('private.slider.index'));
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
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpsertPageRequest $request
     * @param  int $id
     * @return PageController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sliderup(Request $request, $id)
    {
     
        
                  $slider = Slider::findOrFail($id);

                    $slider->title = $request->input('title');
                    $slider->slug = $request->input('slug');
                    if (blank($slider->slug)) {
                    $slider->generateSlug();
                    }
  
                    $slider->active = $request->input('active') !== false;
       
                    $content = $request->input('content');
        
                    $slider->content = $content;

                    if ($slider->save()) {
            //slider::flushCache();
            flash()->success('slider Updated successfully')->important();
             return redirect(route('private.slider.index'));
             
         }
        //return $this->upsert($request, $slider);
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
        $slider = Slider::findOrFail($id);

        DB::table('menu_items')
            ->whereNotNull('page_id')
            ->where('page_id', $id)
            ->update(['page_id' => null]);

        if ($slider->delete()) {
            flash()->success('slider deleted successfully')->important();
        } else {
            flash()->error('Unable to delete Slider. Please try again.');
        }

        return redirect(route('private.slider.index'));
    }
}
   