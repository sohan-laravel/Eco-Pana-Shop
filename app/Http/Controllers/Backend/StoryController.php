<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Story;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::orderBy('id', 'desc')->get();
        return view('backend.story.index', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.story.create');
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
            'description'  => 'required',
        ]);

        $story = new Story();

        $story->description = $request->description;
        $story->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $storyImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $storyImage->getClientOriginalExtension();
            $location = public_path('frontend/images/StoryImage/' . $imgName);
            Image::make($storyImage)->resize(1000, 400)->save($location);


            $story->image = $imgName;
        }

        $story->save();

        Toastr::success('Story Successfully Created', 'Success');

        return redirect()->route('admin.story.index');
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
        $story = Story::find($id);

        return view('backend.story.edit', compact('story'));
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

            'description'  => 'required|max:255',
        ]);

        $story = Story::find($id);

        $story->description = $request->description;
        $story->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/StoryImage/' . $story->image))) {
                unlink(public_path('frontend/images/StoryImage/' . $story->image));
            }

            //insert that image
            $storyImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $storyImage->getClientOriginalExtension();
            $location = public_path('frontend/images/StoryImage/' . $imgName);
            Image::make($storyImage)->resize(1000, 400)->save($location);


            $story->image = $imgName;
        }

        $story->save();

        Toastr::success('Story Successfully Updated', 'Success');

        return redirect()->route('admin.story.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        if (!is_null($story)) {

            if (file_exists(public_path('frontend/images/StoryImage/' . $story->image))) {
                unlink(public_path('frontend/images/StoryImage/' . $story->image));
            }

            $story->delete();
        }

        Toastr::success('Story Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $story = Story::findOrFail($request->id);
        $story->status = $request->status;

        // if ($slider->status === 0) {
        //     return 0;
        // }

        $story->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
