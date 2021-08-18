<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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

            'category_name'  => 'required|unique:categories|max:255',
        ]);

        $category = new Category();

        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $zimage = $request->file('image');
            $img = rand(1111, 9999) . date('.d-m-y.') . '.' . $zimage->getClientOriginalExtension();
            $location = public_path('frontend/images/CategoryImage/' . $img);
            Image::make($zimage)->resize(1000, 400)->save($location);


            $category->image = $img;
        }
        if ($request->hasFile('photo')) {
            //insert that image
            $catimage = $request->file('photo');
            $img_name = rand(1111, 9999) . date('.d-m-y.') . '.' . $catimage->getClientOriginalExtension();
            $location = public_path('frontend/images/CategoryImage/' . $img_name);
            Image::make($catimage)->resize(1000, 400)->save($location);


            $category->photo = $img_name;
        }

        $category->save();

        Toastr::success('Category Successfully Created', 'Success');

        return redirect()->route('admin.category.index');
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
        $category = Category::find($id);

        return view('backend.category.edit', compact('category'));
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

            'category_name'  => 'required|unique:categories,category_name,' . $id,
        ]);

        $category = Category::find($id);

        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name, '-');

        // //insert images also

        //Delete the old image from folder

        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/CategoryImage/' . $category->image))) {
                unlink(public_path('frontend/images/CategoryImage/' . $category->image));
            }

            //insert that image
            $zimage = $request->file('image');
            $img = rand(1111, 9999) . date('.d-m-y.') . '.' . $zimage->getClientOriginalExtension();
            $location = public_path('frontend/images/CategoryImage/' . $img);
            Image::make($zimage)->resize(1000, 400)->save($location);


            $category->image = $img;
        }
        // photo
        if ($request->photo > 0) {

            if (file_exists(public_path('frontend/images/CategoryImage/' . $category->photo))) {
                unlink(public_path('frontend/images/CategoryImage/' . $category->photo));
            }

            //insert that image
            $catimage = $request->file('photo');
            $img_name = rand(1111, 9999) . date('.d-m-y.') . '.' . $catimage->getClientOriginalExtension();
            $location = public_path('frontend/images/CategoryImage/' . $img_name);
            Image::make($catimage)->resize(1000, 400)->save($location);


            $category->photo = $img_name;
        }

        $category->save();

        Toastr::success('Category Successfully Updated', 'Success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!is_null($category)) {

            if (file_exists(public_path('frontend/images/CategoryImage/' . $category->image))) {
                unlink(public_path('frontend/images/CategoryImage/' . $category->image));
            }
            if (file_exists(public_path('frontend/images/CategoryImage/' . $category->photo))) {
                unlink(public_path('frontend/images/CategoryImage/' . $category->photo));
            }

            $category->delete();
        }

        Toastr::success('Category Successfully Deleted', 'Success');

        return back();
    }
}
