<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_brands'])->only('index');
        $this->middleware(['permission:create_brands'])->only('create');
        $this->middleware(['permission:update_brands'])->only('edit');
        $this->middleware(['permission:delete_brands'])->only('destroy');
    } //end of constructor


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
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

        $rules += [
            'name' => 'required',
            'image' => 'image|required',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {
            Image::make($request->image)
                ->save('uploads/brands_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of external if

        Brand::create($request_data);

        notify()->success(__('site.added_successfully'), __('site.success'));

        return redirect()->route('dashboard.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [];

        $rules += [
            'name' => 'required',
            'image' => 'image|nullable',
        ];


        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {

            File::delete('uploads/brands_images/' . $brand->image);

            Image::make($request->image)
                ->save('uploads/brands_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $brand->update($request_data);

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        File::delete('uploads/brands_images/' . $brand->image);

        $brand->delete();

        notify()->success(__('site.deleted_successfully'), __('site.success'));

        return redirect()->route('dashboard.brands.index');
    }
}
