<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Journal;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journal = Journal::orderBy('id', 'desc')->get();
        return view('backend.journal.index', compact('journal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.journal.create');
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
            'link'  => 'required',
        ]);

        $journal = new Journal();

        $journal->name = $request->name;
        $journal->link = $request->link;
        $journal->slug = Str::slug($request->name, '-');


        if ($request->hasFile('image')) {
            //insert that image
            $journalImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $journalImage->getClientOriginalExtension();
            $location = public_path('frontend/images/JournalImage/' . $imgName);
            Image::make($journalImage)->resize(1000, 400)->save($location);


            $journal->image = $imgName;
        }

        $journal->save();

        Toastr::success('Journal Successfully Created', 'Success');

        return redirect()->route('admin.journal.index');
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
        $journal = Journal::find($id);

        return view('backend.journal.edit', compact('journal'));
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
            'link'  => 'required|max:255',
        ]);

        $journal = Journal::find($id);

        $journal->name = $request->name;
        $journal->link = $request->link;
        $journal->slug = Str::slug($request->name, '-');


        if ($request->image > 0) {

            if (file_exists(public_path('frontend/images/JournalImage/' . $journal->image))) {
                unlink(public_path('frontend/images/JournalImage/' . $journal->image));
            }

            //insert that image
            $journalImage = $request->file('image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $journalImage->getClientOriginalExtension();
            $location = public_path('frontend/images/JournalImage/' . $imgName);
            Image::make($journalImage)->resize(1000, 400)->save($location);


            $journal->image = $imgName;
        }

        $journal->save();

        Toastr::success('Journal Successfully Updated', 'Success');

        return redirect()->route('admin.journal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $journal = Journal::find($id);

        if (!is_null($journal)) {

            if (file_exists(public_path('frontend/images/JournalImage/' . $journal->image))) {
                unlink(public_path('frontend/images/JournalImage/' . $journal->image));
            }

            $journal->delete();
        }

        Toastr::success('Journal Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $journal = Journal::findOrFail($request->id);
        $journal->status = $request->status;

        // if ($slider->status === 0) {
        //     return 0;
        // }

        $journal->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
