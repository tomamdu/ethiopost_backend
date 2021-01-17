<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['index', 'show']]);
        $this->user = $this->guard()->user();
    }
    public function index()
    {
        //$arr['category'] = Category::all();
       // return view('admin/categories/categories')->with($arr);
       return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/categories/create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'=>'required|string'
            
        ]);
        
       
        $category = new Category();
        $category->title = $request->title;
        // dd($request->all());
       // $category->save();

        if($category->save())
        {
            return $category;
        }

        else{
            return response()->json([
              'status' => false,
              'message' => 'Oops, the todo could not be saved.'
            ]);
        }
       
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
        $categoryShow = Category :: find($id);
        return $categoryShow;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        $arr['category'] = $category;
        return view('admin/categories/edit_category')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {   
        $validator = $request->validate([
            'title'=>'required|string'
            
        ]);

        $category->title = $request->title;
        $category->save();
         
        if($category->save())
        {
            return $category;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::destroy($id);
       // return redirect()->route('cat.categories.index');
    }

    public function guard()
    {
        return Auth::guard();
    }
}
