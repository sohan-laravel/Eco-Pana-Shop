<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Image;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imageUrl = asset('backend/images/SubCategoryImage/');
            $data = Subcategory::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) use ($imageUrl) {
                    return '<img src="' . $imageUrl . '/' . $row->image . '" height="30" width="30"/>';
                })
                ->editColumn('category_name', function ($row) {
                    return $row->category->category_name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" data-id="' . $row->id . '" 
                    class="btn btn-outline-primary btn-sm edit" data-toggle="modal" data-target="#editModal">
                    <i class="fas fa-edit"></i></a>
                    <a href="' . route('admin.subcategory.destroy', [$row->id]) . '" class="btn btn-outline-danger btn-sm" id="delete_subcategory"><i class="fas fa-trash"></i></a>
                    
                    ';
                    return $actionBtn;
                })

                ->rawColumns(['action', 'image', 'category_name'])
                ->make(true);
        }

        $categories = Category::all();

        return view('backend.subcategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'subcategory_name'  => 'required|max:255',

        ]);

        $slug = Str::slug($request->subcategory_name, '-');

        //insert that image
        $catimage = $request->image;
        $img = $slug . '.' . uniqid() . date('.d-m-y.') . '.' . $catimage->getClientOriginalExtension();
        $location = public_path('backend/images/SubCategoryImage/' . $img);
        Image::make($catimage)->resize(1000, 400)->save($location);

        $data = array(
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name, '-'),
            'image' => $img,
        );

        DB::table('subcategories')->insert($data);

        return response()->json('Successfully Inserted!');
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
        // $data = DB::table('categories')->where('id', $id)->first();

        // return view('backend.category.edit', compact('data'));
    }

    public function editcat($id)
    {
        $data = DB::table('subcategories')->where('id', $id)->first();
        $categories = Category::all();

        return view('backend.subcategory.edit', compact('data', 'categories'));
    }
    public function updateSubcategory(Request $request)
    {
        $this->validate($request, [

            'subcategory_name'  => 'required|max:255',

        ]);

        $slug = Str::slug($request->subcategory_name, '-');

        $data = array();

        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcategory_slug'] = $slug;

        if ($request->image) {
            //insert that image
            //$catimage = $request->image;
            $catimage = $request->file('image');
            $img = $slug . '.' . uniqid() . date('.d-m-y.') . '.' . $catimage->getClientOriginalExtension();
            $location = public_path('backend/images/SubCategoryImage/' . $img);
            Image::make($catimage)->resize(1000, 400)->save($location);
            $data['image'] = $img;
        } else {
            $data['image'] = $request->old_image;
        }

        DB::table('subcategories')->where('id', $request->id)->update($data);

        return response()->json('Successfully SubCategory Updated!');
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
        // $data = Category::find($id);

        // return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Subcategory::find($id);
        if (!is_null($category)) {

            if (file_exists(public_path('backend/images/SubCategoryImage/' . $category->image))) {
                unlink(public_path('backend/images/SubCategoryImage/' . $category->image));
            }

            $category->delete();
        }

        return response()->json('Successfully Deleted!');

        return back();
    }
}
