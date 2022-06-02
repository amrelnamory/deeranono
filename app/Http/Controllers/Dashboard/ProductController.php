<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_products'])->only('index');
        $this->middleware(['permission:create_products'])->only('create');
        $this->middleware(['permission:update_products'])->only('edit');
        $this->middleware(['permission:delete_products'])->only('destroy');
    } //end of constructor


    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
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
            $rules += [$locale . '.color' => ['required']];
        } //end of for each

        $rules += [
            'category_id' => 'required',
            'quantity' => 'required|integer',
            'code' => ['required', Rule::unique('products', 'code')],
            'selling_price' => 'required|numeric',
            'images' => 'required',
            'images.*' => 'image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['images']);

        if ($request->images) {

            foreach ($request->images as $image) {

                Image::make($image)->save('uploads/products_images/' . $image->hashName(), 60);

                $Imgdata[] = $image->hashName();
            }

            $request_data['images'] = json_encode($Imgdata);
        }

 
        Product::create($request_data);

        notify()->success(__('site.added_successfully'), __('site.success'));

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.color' => ['required']];
        } //end of for each

        $rules += [
            'category_id' => 'required',
            'quantity' => 'required|integer',
            'code' => ['required', Rule::unique('products', 'code')->ignore($product->id)],
            'selling_price' => 'required|numeric',
            'images' => 'nullable',
            'images.*' => 'image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['images']);

        if ($request->images) {

            foreach (json_decode($product->images, true) as $key => $image) {
                File::delete('uploads/products_images/' . $image);
            }

            foreach ($request->images as $image) {

                Image::make($image)->save('uploads/products_images/' . $image->hashName(), 60);

                $Imgdata[] = $image->hashName();
            }

            $request_data['images'] = json_encode($Imgdata);
        } else {
            $request_data['images'] = $product->images;
        }
 
        $product->update($request_data);

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach (json_decode($product->images, true) as $key => $image) {
            File::delete('uploads/products_images/' . $image);
        }

        $product->delete();

        notify()->success(__('site.deleted_successfully'), __('site.success'));

        return redirect()->route('dashboard.products.index');
    }

    public function updateStatus($id)
    {

        $product = Product::findOrFail($id);

        if ($product->status == 1) {
            $product->update([
                'status' => 0
            ]);
        } else {
            $product->update([
                'status' => 1
            ]);
        }

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.products.index');
    }
}
