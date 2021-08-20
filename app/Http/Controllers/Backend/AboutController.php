<?php

namespace App\Http\Controllers\Backend;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::orderBy('id', 'desc')->get();
        return view('backend.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
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

        $about = new About();

        $about->name = $request->name;
        $about->description = $request->description;
        $about->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $aboutImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $aboutImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AboutImage/' . $imgName);
            Image::make($aboutImage)->resize(1000, 400)->save($location);


            $about->image = $imgName;
        }

        $about->save();

        Toastr::success('About Successfully Created', 'Success');

        return redirect()->route('admin.about.index');
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
        $about = About::find($id);

        return view('backend.about.edit', compact('about'));
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
            'description'  => 'required',
        ]);

        $about = About::find($id);

        $about->name = $request->name;
        $about->description = $request->description;
        $about->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/AboutImage/' . $about->image))) {
                unlink(public_path('frontend/images/AboutImage/' . $about->image));
            }

            //insert that image
            $aboutImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $aboutImage->getClientOriginalExtension();
            $location = public_path('frontend/images/AboutImage/' . $imgName);
            Image::make($aboutImage)->resize(1000, 400)->save($location);


            $about->image = $imgName;
        }

        $about->save();

        Toastr::success('About Successfully Updated', 'Success');

        return redirect()->route('admin.about.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);

        if (!is_null($about)) {

            if (file_exists(public_path('frontend/images/AboutImage/' . $about->image))) {
                unlink(public_path('frontend/images/AboutImage/' . $about->image));
            }

            $about->delete();
        }

        Toastr::success('About Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $about = About::findOrFail($request->id);
        $about->status = $request->status;

        // if ($slider->status === 0) {
        //     return 0;
        // }

        $about->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
