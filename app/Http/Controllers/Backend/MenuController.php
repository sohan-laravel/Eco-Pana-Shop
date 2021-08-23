<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::orderBy('id', 'desc')->get();
        return view('backend.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.menu.create');
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

            'journal_name'  => 'required',
        ]);

        $menu = new Menu();

        $menu->journal_name = $request->journal_name;
        $menu->journal_link = $request->journal_link;

        $menu->save();

        Toastr::success('Menu Successfully Created', 'Success');

        return redirect()->route('admin.menu.index');
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
        $menu = Menu::find($id);

        return view('backend.menu.edit', compact('menu'));
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

            'journal_name'  => 'required',
        ]);

        $menu = Menu::find($id);

        $menu->journal_name = $request->journal_name;
        $menu->journal_link = $request->journal_link;

        $menu->save();

        Toastr::success('Menu Successfully Updated', 'Success');

        return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!is_null($menu)) {

            $menu->delete();
        }

        Toastr::success('Menu Successfully Deleted', 'Success');

        return back();
    }

    public function inactive(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $menu->status = $request->status;

        // if ($menu->status === 0) {
        //     return 0;
        // }

        $menu->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}
