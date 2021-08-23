<?php

namespace App\Http\Controllers\Frontend;

use App\About;
use App\Accessleft;
use App\Accessmiddle;
use App\Accessright;
use App\Http\Controllers\Controller;
use App\Journal;
use App\Leather;
use App\Menu;
use App\Model\Category;
use App\Model\Subcategory;
use App\Slider;
use App\Story;
use App\Topbar;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $subcategories = Subcategory::orderBy('id', 'desc')->get();
        $menu = Menu::orderBy('id', 'desc')->get();
        $slider = Slider::where('status', 1)->orderBy('id', 'desc')->get();
        $about = About::where('status', 1)->orderBy('id', 'desc')->get();
        $leather = Leather::where('status', 1)->orderBy('id', 'desc')->get();
        $story = Story::where('status', 1)->orderBy('id', 'desc')->get();
        $journal = Journal::where('status', 1)->orderBy('id', 'desc')->get();
        $accessleft = Accessleft::orderBy('id', 'desc')->get();
        $accessmiddle = Accessmiddle::orderBy('id', 'desc')->get();
        $accessright = Accessright::orderBy('id', 'desc')->get();
        $topbar = Topbar::orderBy('id', 'desc')->get();
        return view('frontend.index', compact('categories', 'slider', 'menu', 'about', 'leather', 'story', 'journal', 'accessleft', 'accessmiddle', 'accessright', 'subcategories', 'topbar'));
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
