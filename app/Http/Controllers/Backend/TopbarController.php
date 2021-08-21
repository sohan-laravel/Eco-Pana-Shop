<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Topbar;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class TopbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topbar = Topbar::orderBy('id', 'desc')->get();
        return view('backend.topbar.index', compact('topbar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.topbar.create');
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

            'number'  => 'required|numeric|digits:11',
        ]);

        $topbar = new Topbar();

        $topbar->number = $request->number;
        $topbar->facebook = $request->facebook;
        $topbar->twitter = $request->twitter;
        $topbar->instagram = $request->instagram;
        $topbar->whatsapp = $request->whatsapp;


        $topbar->save();

        Toastr::success('Topbar Successfully Created', 'Success');

        return redirect()->route('admin.topbar.index');
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
        $topbar = Topbar::find($id);

        return view('backend.topbar.edit', compact('topbar'));
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

            'number'  => 'required|numeric|digits:11',
        ]);

        $topbar = Topbar::find($id);

        $topbar->number = $request->number;
        $topbar->facebook = $request->facebook;
        $topbar->twitter = $request->twitter;
        $topbar->instagram = $request->instagram;
        $topbar->whatsapp = $request->whatsapp;


        $topbar->save();

        Toastr::success('Topbar Successfully Updated', 'Success');

        return redirect()->route('admin.topbar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topbar = Topbar::find($id);

        if (!is_null($topbar)) {

            $topbar->delete();
        }

        Toastr::success('Topbar Successfully Deleted', 'Success');

        return back();
    }
}
