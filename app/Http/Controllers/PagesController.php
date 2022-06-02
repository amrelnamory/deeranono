<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    public function index()
    {
        $slides = Slide::all();
        $products = Product::where('status', 1)->latest()->take(8)->get();
        $articles = Article::latest()->take(3)->get();
        $brands = Brand::latest()->get();

        return view('website.index', compact(
            'slides',
            'products',
            'articles',
            'brands',
        ));
    }

    public function articles()
    {
        $articles = Article::latest()->paginate(15);

        return view('website.articles', compact(
            'articles',
        ));
    }

    public function singleArticle($id)
    {
        $article = Article::findOrFail($id);

        return view('website.singleArticle', compact(
            'article',
        ));
    }

    public function contactUs()
    {
        return view('website.contactUs');
    }

    public function products()
    {
        $products = Product::where('status', 1)->latest()->paginate(15);

        return view('website.products', compact(
            'products',
        ));
    }

    public function subCategory($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('status', 1)->where('category_id', $id)->latest()->paginate(15);

        return view('website.subCategory', compact(
            'products',
            'category'
        ));
    }

    public function singleProduct($id)
    {
        //Session::flush();

        $product = Product::findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

        return view('website.singleProduct', compact(
            'product',
            'related_products'
        ));
    }


    public function viewCart()
    {
        return view('website.viewCart');
    }

    public function completeOrder()
    {
        $cart = Cart::content();
        return view('website.completeOrder', compact('cart'));
    }

    public function orderSuccess()
    {
        return view('website.order_success');
    }
}
