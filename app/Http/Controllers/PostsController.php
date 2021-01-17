<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['index', 'show']]);
        $this->user = $this->guard()->user();
    }
    public function index()
    {
        $arr['post'] = Post::with('category')->orderBy('created_at', 'DESC')->paginate(2);
        
       // return view('admin/posts/admin_posts')->with($arr);
      // $posts =  Post::all();
       return $arr['post'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->middleware('auth');
        $arr['category'] = Category::all();
       // return view('admin/posts/create_posts')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* if($request->image->getClientOriginalName()){
        $ext = $request->image->getClientOriginalExtension();
        $file = date('YmdHis').rand(1,999999).'.'.$ext;
        $request->image->storeAs('public/posts',$file);
        }
        else
        {
            $file='';
        } 
        $post->image = $file;
        $post->title = $request->title;
        $post->catagory_id = $request->category_id;
        $post->post = $request->post;
        $post->author = $request->author;
        $post->save();
        return redirect()->route('admin.posts.index');*/

        //return Post::create($request->all());
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;

        if($post->save()){
           
            return Post::with('category')->find($post->id);
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
        //return new PostResource($post);
        $po = Post::find($id);

        return $po;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->middleware('auth');
        $arr['category'] = Category::all();
        $arr['post'] = $post;
        return view('admin/posts/edit_posts')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,post $post)
    {
       /* $this->middleware('auth');
        
        if(isset($request->image) && $request->image->getClientOriginalName()){
            $ext = $request->image->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,999999).'.'.$ext;
            $request->image->storeAs('public/posts',$file);
            }
            else
            {
                if(!$post->image){
                    $file='';
                }else
                    $file = $post->image;
            } 
            $post->image = $file;
            $post->title = $request->title;
            $post->post = $request->post;
            $post->author = $request->author;
            $post->catagory_id = $request->category_id;
            $post->save();
            return redirect()->route('admin.posts.index');*/

            //$post = Post::find($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->category_id = $request->category_id;
            $post->user_id = $request->user_id;
            $post->save();
         
            if($post->save())
            {
                return $post;
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
       /* $this->middleware('auth');
        post::destroy($id);
        return redirect()->route('admin.posts.index');*/
        return Post::destroy($id);
    }
    public function guard()
    {
        return Auth::guard();
    }
}
