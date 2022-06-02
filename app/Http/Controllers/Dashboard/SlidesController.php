<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SlidesController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_slider'])->only('index');
        $this->middleware(['permission:create_slider'])->only('create');
        $this->middleware(['permission:update_slider'])->only('edit');
        $this->middleware(['permission:delete_slider'])->only('destroy');
    } //end of constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('dashboard.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required']];
        } //end of for each

        $rules += [
            'image' => 'required|image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {

            Image::make($request->image)->save('uploads/slides_images/' . $request->image->hashName(), 60);

            $newImage = $request->image->hashName();

            $request_data['image'] = $newImage;
        }

        Slide::create($request_data);

        notify()->success(__('site.added_successfully'), __('site.success'));

        return redirect()->route('dashboard.slides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        return view('dashboard.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('dashboard.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required']];
        } //end of for each

        $rules += [
            'image' => 'required|image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {

            File::delete('uploads/slides_images/' . $slide->image);


            Image::make($request->image)->save('uploads/slides_images/' . $request->image->hashName(), 60);

            $newImage = $request->image->hashName();


            $request_data['image'] = $newImage;
        } else {
            $request_data['image'] = $slide->image;
        }

        $slide->update($request_data);

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.slides.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        File::delete('uploads/slides_images/' . $slide->image);

        $slide->delete();

        notify()->success(__('site.deleted_successfully'), __('site.success'));

        return redirect()->route('dashboard.slides.index');
    }
}
