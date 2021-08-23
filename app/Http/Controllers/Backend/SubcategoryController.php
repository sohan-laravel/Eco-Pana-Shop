<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subcategories = Subcategory::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.subcategory.index', compact('subcategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->all();

        $this->validate($request, [

            'subcat'  => 'required',
        ]);

        $subcategories = new Subcategory();

        $subcategories->category_id = $request->category_id;
        $subcategories->subcat = $request->subcat;
        $subcategories->slug = Str::slug($request->subcat, '-');


        if ($request->hasFile('image')) {

            //insert that image
            $zimage = $request->file('image');
            $img = rand(1111, 9999) . date('.d-m-y.') . '.' . $zimage->getClientOriginalExtension();
            $location = public_path('frontend/images/SubCategoryImage/' . $img);
            Image::make($zimage)->save($location);


            $subcategories->image = $img;
        }

        $subcategories->save();

        Toastr::success('subcategory Successfully Created', 'Success');

        return redirect()->route('admin.subcategory.index');
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
        $subcategory = Subcategory::find($id);
        $categories = Category::orderBy('id', 'desc')->get();

        return view('backend.subcategory.edit', compact('subcategory', 'categories'));
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

        //return $request->all();

        $this->validate($request, [

            'subcat'  => 'required',
        ]);

        $subcategories = Subcategory::find($id);

        $subcategories->category_id = $request->category_id;
        $subcategories->subcat = $request->subcat;
        $subcategories->slug = Str::slug($request->subcat, '-');


        if ($request->hasFile('image')) {

            if (file_exists(public_path('frontend/images/SubCategoryImage/' . $subcategories->image))) {
                unlink(public_path('frontend/images/SubCategoryImage/' . $subcategories->image));
            }

            //insert that image
            $zimage = $request->file('image');
            $img = rand(1111, 9999) . date('.d-m-y.') . '.' . $zimage->getClientOriginalExtension();
            $location = public_path('frontend/images/SubCategoryImage/' . $img);
            Image::make($zimage)->save($location);


            $subcategories->image = $img;
        }

        $subcategories->save();

        Toastr::success('subcategory Successfully Updated', 'Success');

        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories = Subcategory::find($id);

        if (!is_null($subcategories)) {

            if (file_exists(public_path('frontend/images/SubCategoryImage/' . $subcategories->image))) {
                unlink(public_path('frontend/images/SubCategoryImage/' . $subcategories->image));
            }

            $subcategories->delete();
        }

        Toastr::success('subcategory Successfully Deleted', 'Success');

        return back();
    }
}
