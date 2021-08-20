<?php

namespace App\Http\Controllers\Frontend;

use App\About;
use App\Accessleft;
use App\Http\Controllers\Controller;
use App\Journal;
use App\Leather;
use App\Model\Category;
use App\Slider;
use App\Story;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $slider = Slider::where('status', 1)->orderBy('id', 'desc')->get();
        $about = About::where('status', 1)->orderBy('id', 'desc')->get();
        $leather = Leather::where('status', 1)->orderBy('id', 'desc')->get();
        $story = Story::where('status', 1)->orderBy('id', 'desc')->get();
        $journal = Journal::where('status', 1)->orderBy('id', 'desc')->get();
        $accessleft = Accessleft::orderBy('id', 'desc')->get();
        return view('frontend.index', compact('categories', 'slider', 'about', 'leather', 'story', 'journal', 'accessleft'));
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
