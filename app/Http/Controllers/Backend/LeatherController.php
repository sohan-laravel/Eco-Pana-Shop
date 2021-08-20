<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Leather;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class LeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leather = Leather::orderBy('id', 'desc')->get();
        return view('backend.leather.index', compact('leather'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.leather.create');
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

            'name'  => 'required|max:255',
            'image'  => 'required|image',
            'description'  => 'required',
        ]);

        $leather = new Leather();

        $leather->name = $request->name;
        $leather->description = $request->description;
        $leather->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $leatherImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $leatherImage->getClientOriginalExtension();
            $location = public_path('frontend/images/LeatherImage/' . $imgName);
            Image::make($leatherImage)->resize(1000, 400)->save($location);


            $leather->image = $imgName;
        }

        $leather->save();

        Toastr::success('Leather Successfully Created', 'Success');

        return redirect()->route('admin.leather.index');
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
        $leather = Leather::find($id);

        return view('backend.leather.edit', compact('leather'));
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

        $leather = Leather::find($id);

        $leather->name = $request->name;
        $leather->description = $request->description;
        $leather->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/LeatherImage/' . $leather->image))) {
                unlink(public_path('frontend/images/LeatherImage/' . $leather->image));
            }

            //insert that image
            $leatherImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $leatherImage->getClientOriginalExtension();
            $location = public_path('frontend/images/LeatherImage/' . $imgName);
            Image::make($leatherImage)->resize(1000, 400)->save($location);


            $leather->image = $imgName;
        }

        $leather->save();

        Toastr::success('Leather Successfully Updated', 'Success');

        return redirect()->route('admin.leather.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leather = Leather::find($id);

        if (!is_null($leather)) {

            if (file_exists(public_path('frontend/images/LeatherImage/' . $leather->image))) {
                unlink(public_path('frontend/images/LeatherImage/' . $leather->image));
            }

            $leather->delete();
        }

        Toastr::success('Leather Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $leather = Leather::findOrFail($request->id);
        $leather->status = $request->status;

        // if ($slider->status === 0) {
        //     return 0;
        // }

        $leather->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
