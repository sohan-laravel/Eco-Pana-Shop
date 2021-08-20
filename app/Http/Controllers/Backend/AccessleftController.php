<?php

namespace App\Http\Controllers\Backend;

use App\Accessleft;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class AccessleftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessleft = Accessleft::orderBy('id', 'desc')->get();
        return view('backend.accessleft.index', compact('accessleft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accessleft.create');
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

            'image'  => 'required|image',
            'name'  => 'required',
        ]);

        $accessleft = new Accessleft();

        $accessleft->name = $request->name;
        $accessleft->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $accessleftImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessleftImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesLeftImage/' . $imgName);
            Image::make($accessleftImage)->save($location);


            $accessleft->image = $imgName;
        }

        $accessleft->save();

        Toastr::success('Accessories Left Side Successfully Created', 'Success');

        return redirect()->route('admin.accessleft.index');
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
        $accessleft = Accessleft::find($id);

        return view('backend.accessleft.edit', compact('accessleft'));
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

            'name'  => 'required|max:255',
        ]);

        $accessleft = Accessleft::find($id);

        $accessleft->name = $request->name;
        $accessleft->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/AccessoriesLeftImage/' . $accessleft->image))) {
                unlink(public_path('frontend/images/AccessoriesLeftImage/' . $accessleft->image));
            }

            //insert that image
            $accessleftImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessleftImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesLeftImage/' . $imgName);
            Image::make($accessleftImage)->save($location);


            $accessleft->image = $imgName;
        }

        $accessleft->save();

        Toastr::success('Accessories Left Side Successfully Updated', 'Success');

        return redirect()->route('admin.accessleft.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessleft = Accessleft::find($id);

        if (!is_null($accessleft)) {

            if (file_exists(public_path('frontend/images/AccessoriesLeftImage/' . $accessleft->image))) {
                unlink(public_path('frontend/images/AccessoriesLeftImage/' . $accessleft->image));
            }

            $accessleft->delete();
        }

        Toastr::success('Accessories Left Side Successfully Deleted', 'Success');

        return back();
    }
}
