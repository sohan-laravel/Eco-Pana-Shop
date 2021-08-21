<?php

namespace App\Http\Controllers\Backend;

use App\Accessright;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class AccessrightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessright = Accessright::orderBy('id', 'desc')->get();
        return view('backend.accessright.index', compact('accessright'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accessright.create');
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

        $accessright = new Accessright();

        $accessright->name = $request->name;
        $accessright->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $accessrightImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessrightImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesRightImage/' . $imgName);
            Image::make($accessrightImage)->save($location);


            $accessright->image = $imgName;
        }

        $accessright->save();

        Toastr::success('Accessories Right Side Successfully Created', 'Success');

        return redirect()->route('admin.accessright.index');
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
        $accessright = Accessright::find($id);

        return view('backend.accessright.edit', compact('accessright'));
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

        $accessright = Accessright::find($id);

        $accessright->name = $request->name;
        $accessright->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/AccessoriesRightImage/' . $accessright->image))) {
                unlink(public_path('frontend/images/AccessoriesRightImage/' . $accessright->image));
            }

            //insert that image
            $accessrightImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $accessrightImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AccessoriesRightImage/' . $imgName);
            Image::make($accessrightImage)->save($location);


            $accessright->image = $imgName;
        }

        $accessright->save();

        Toastr::success('Accessories Right Side Successfully Updated', 'Success');

        return redirect()->route('admin.accessright.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessright = Accessright::find($id);

        if (!is_null($accessright)) {

            if (file_exists(public_path('frontend/images/AccessoriesRightImage/' . $accessright->image))) {
                unlink(public_path('frontend/images/AccessoriesRightImage/' . $accessright->image));
            }

            $accessright->delete();
        }

        Toastr::success('Accessories Right Side Successfully Deleted', 'Success');

        return back();
    }
}
