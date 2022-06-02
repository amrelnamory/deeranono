<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');
    } //end of constructor

    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
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
            $rules += [$locale . '.name' => ['required']];
        } //end of for each

        $rules += [
            'image' => 'image|required',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);


        if ($request->image) {
            Image::make($request->image)
                ->save('uploads/categories_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of external if

        Category::create($request_data);

        //return redirect()->route('dashboard.shop_departments.index')->with('success', __('admin.added_successfully'));

        notify()->success(__('site.added_successfully'), __('site.success'));

        return redirect()->route('dashboard.categories.index');
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
    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        } //end of for each

        $rules += [
            'image' => 'image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['image']);

        if ($request->image) {
            if ($category->image != 'not-found.jpg') {
                File::delete('uploads/categories_images/' . $category->image);
            } //end of inner if
            Image::make($request->image)
                ->save('uploads/categories_images/' . $request->image->hashName(), 60);
            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $category->update($request_data);

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->image != 'not-found.jpg') {
            File::delete('uploads/categories_images/' . $category->image);
        } //end of if

        $category->delete();

        notify()->success(__('site.deleted_successfully'), __('site.success'));

        return redirect()->route('dashboard.categories.index');
    }

    public function updateStatus($id)
    {

        $category = Category::findOrFail($id);

        if ($category->status == 1) {
            $category->update([
                'status' => 0
            ]);
        } else {
            $category->update([
                'status' => 1
            ]);
        }

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.categories.index');
    }
}
