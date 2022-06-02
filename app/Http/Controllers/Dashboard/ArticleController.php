<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_articles'])->only('index');
        $this->middleware(['permission:create_articles'])->only('create');
        $this->middleware(['permission:update_articles'])->only('edit');
        $this->middleware(['permission:delete_articles'])->only('destroy');
    } //end of constructor


    public function index()
    {
        $articles = Article::all();
        return view('dashboard.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.articles.create');
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
            $rules += [$locale . '.description' => ['required']];
        } //end of for each

        $rules += [
            'images' => 'required',
            'images.*' => 'image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['images']);

        if ($request->images) {

            foreach ($request->images as $image) {

                Image::make($image)->save('uploads/articles_images/' . $image->hashName(), 60);

                $Imgdata[] = $image->hashName();
            }

            $request_data['images'] = json_encode($Imgdata);
        }


        Article::create($request_data);

        notify()->success(__('site.added_successfully'), __('site.success'));

        return redirect()->route('dashboard.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('dashboard.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('dashboard.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required']];
            $rules += [$locale . '.description' => ['required']];
        } //end of for each

        $rules += [
            'images' => 'nullable',
            'images.*' => 'image',
        ];

        $request->validate($rules);

        $request_data = $request->except(['images']);

        if ($request->images) {

            foreach (json_decode($article->images, true) as $key => $image) {
                File::delete('uploads/articles_images/' . $image);
            }

            foreach ($request->images as $image) {

                Image::make($image)->save('uploads/articles_images/' . $image->hashName(), 60);

                $Imgdata[] = $image->hashName();
            }

            $request_data['images'] = json_encode($Imgdata);
        } else {
            $request_data['images'] = $article->images;
        }

        $article->update($request_data);

        notify()->success(__('site.updated_successfully'), __('site.success'));

        return redirect()->route('dashboard.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        foreach (json_decode($article->images, true) as $key => $image) {
            File::delete('uploads/articles_images/' . $image);
        }

        $article->delete();

        notify()->success(__('site.deleted_successfully'), __('site.success'));

        return redirect()->route('dashboard.articles.index');
    }
}
