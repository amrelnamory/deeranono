<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_settings'])->only('index');
        $this->middleware(['permission:create_settings'])->only('create');
        $this->middleware(['permission:update_settings'])->only('edit');
        $this->middleware(['permission:delete_settings'])->only('destroy');
    } //end of constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::firstOrCreate();
        return view('dashboard.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $settings = Setting::findOrFail($id);

            $rules = [];

            $rules += [
                'logo' => 'nullable|image',
                'favicon' => 'nullable|image',
                'collection_image' => 'nullable|image',
                'banner_image' => 'nullable|image',
                'email' => 'nullable|email',
                'facebook' => 'nullable|url',
                'instagram' => 'nullable|url',
                'youtube' => 'nullable|url',
                'pinterest' => 'nullable|url',
            ];

            $request->validate($rules);

            $request_data = $request->except(['logo', 'favicon']);

            if ($request->logo) {

                File::delete('uploads/logos/' . $settings->logo);

                Image::make($request->logo)
                    ->save('uploads/logos/' . $request->logo->hashName());
                $request_data['logo'] = $request->logo->hashName();
            } //end of external if

            if ($request->favicon) {

                File::delete('uploads/logos/' . $settings->favicon);

                Image::make($request->favicon)
                    ->save('uploads/logos/' . $request->favicon->hashName());
                $request_data['favicon'] = $request->favicon->hashName();
            } //end of external if

            if ($request->collection_image) {

                File::delete('uploads/banners/' . $settings->collection_image);

                Image::make($request->collection_image)
                    ->save('uploads/banners/' . $request->collection_image->hashName());
                $request_data['collection_image'] = $request->collection_image->hashName();
            } //end of external if

            if ($request->banner_image) {

                File::delete('uploads/banners/' . $settings->banner_image);

                Image::make($request->banner_image)
                    ->save('uploads/banners/' . $request->banner_image->hashName());
                $request_data['banner_image'] = $request->banner_image->hashName();
            } //end of external if

            $settings->update($request_data);

            DB::commit();

            notify()->success(__('site.updated_successfully'), __('site.success'));

            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollback();
            notify()->error(__('site.error_happened'), __('site.error'));

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
