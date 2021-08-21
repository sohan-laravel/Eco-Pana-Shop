<?php

namespace App\Http\Controllers\Backend;

use App\Accessmiddle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class AccessmiddleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessmiddle = Accessmiddle::orderBy('id', 'desc')->get();
        return view('backend.accessmiddle.index', compact('accessmiddle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accessmiddle.create');
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

        $accessmiddle = new Accessmiddle();

        $accessmiddle->name = $request->name;
        $accessmiddle->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $accessmiddleImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessmiddleImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesMiddleImage/' . $imgName);
            Image::make($accessmiddleImage)->save($location);


            $accessmiddle->image = $imgName;
        }

        $accessmiddle->save();

        Toastr::success('Accessories Middle Side Successfully Created', 'Success');

        return redirect()->route('admin.accessmiddle.index');
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
        $accessmiddle = Accessmiddle::find($id);

        return view('backend.accessmiddle.edit', compact('accessmiddle'));
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

        $accessmiddle = Accessmiddle::find($id);

        $accessmiddle->name = $request->name;
        $accessmiddle->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/AccessoriesMiddleImage/' . $accessmiddle->image))) {
                unlink(public_path('frontend/images/AccessoriesMiddleImage/' . $accessmiddle->image));
            }

            //insert that image
            $accessmiddleImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessmiddleImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesMiddleImage/' . $imgName);
            Image::make($accessmiddleImage)->save($location);


            $accessmiddle->image = $imgName;
        }

        $accessmiddle->save();

        Toastr::success('Accessories Middle Side Successfully Updated', 'Success');

        return redirect()->route('admin.accessmiddle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessmiddle = Accessmiddle::find($id);

        if (!is_null($accessmiddle)) {

            if (file_exists(public_path('frontend/images/AccessoriesMiddleImage/' . $accessmiddle->image))) {
                unlink(public_path('frontend/images/AccessoriesMiddleImage/' . $accessmiddle->image));
            }

            $accessmiddle->delete();
        }

        Toastr::success('Accessories Middle Side Successfully Deleted', 'Success');

        return back();
    }
}
