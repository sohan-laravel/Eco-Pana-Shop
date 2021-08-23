<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'desc')->get();
        return view('backend.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.product.create', compact('categories'));
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

            'product_name'  => 'required|max:255',
            'image_one'  => 'required|image',
            'image_two'  => 'required|image',
            'image_three'  => 'required|image',
            'description'  => 'required',
            'price'  => 'required',
        ]);

        $product = new Product();

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_slug = Str::slug($request->product_name, '-');


        if ($request->hasFile('image_one')) {
            //insert that image
            $productImage = $request->file('image_one');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_one = $imgName;
        }
        if ($request->hasFile('image_two')) {
            //insert that image
            $productImage = $request->file('image_two');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_two = $imgName;
        }
        if ($request->hasFile('image_three')) {
            //insert that image
            $productImage = $request->file('image_three');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_three = $imgName;
        }

        $product->save();

        Toastr::success('product Successfully Created', 'Success');

        return redirect()->route('admin.product.index');
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
        $product = Product::find($id);
        $categories = Category::orderBy('id', 'desc')->get();

        return view('backend.product.edit', compact('product', 'categories'));
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
        $this->validate($request, [

            'product_name'  => 'required|max:255',
            'description'  => 'required',
            'price'  => 'required',
        ]);

        $product = Product::find($id);

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_slug = Str::slug($request->product_name, '-');


        if ($request->image_one > 0) {

            if (file_exists(public_path('frontend/images/productImage/' . $product->image_one))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_one));
            }

            //insert that image
            $productImage = $request->file('image_one');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_one = $imgName;
        }
        if ($request->image_two > 0) {

            if (file_exists(public_path('frontend/images/productImage/' . $product->image_two))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_two));
            }

            //insert that image
            $productImage = $request->file('image_two');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_two = $imgName;
        }
        if ($request->image_three > 0) {

            if (file_exists(public_path('frontend/images/productImage/' . $product->image_three))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_three));
            }

            //insert that image
            $productImage = $request->file('image_three');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $productImage->getClientOriginalExtension();
            $location = public_path('frontend/images/productImage/' . $imgName);
            Image::make($productImage)->save($location);


            $product->image_three = $imgName;
        }

        $product->save();

        Toastr::success('Product Successfully Updated', 'Success');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!is_null($product)) {

            if (file_exists(public_path('frontend/images/productImage/' . $product->image_one))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_one));
            }
            if (file_exists(public_path('frontend/images/productImage/' . $product->image_two))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_two));
            }
            if (file_exists(public_path('frontend/images/productImage/' . $product->image_three))) {
                unlink(public_path('frontend/images/productImage/' . $product->image_three));
            }

            $product->delete();
        }

        Toastr::success('Product Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status;

        // if ($product->status === 0) {
        //     return 0;
        // }

        $product->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
