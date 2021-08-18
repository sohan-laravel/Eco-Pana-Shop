<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('frontend.index', compact('categories'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function test()
    {
        return view('frontend.pages.test');
    }
}
