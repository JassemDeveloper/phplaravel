<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\User;
use JavaScript;
class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' =>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
         JavaScript::put([
            'posts' => Post::with('category','user')->search()->orderBy('created_at','desc')->paginate(5),
            'categories'=> Category::with('post')->get()
         ]);


        $posts = Post::search()->orderBy('created_at','desc')->paginate(5);

        #return view('posts.index')->with($data);
        return view('posts.index')->with('posts',$posts);
     
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        #$categories = Category::where('user_id', $user_id)->orderBy('created_at')->pluck('title', 'id');
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $categories=Category::all();
        $data=[
            'categories' =>$categories
        ];
        return view('posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'img'=>'image|nullable|max:1999'
        ]);

        if($request->hasFile('img')){
            $fileNameWithExt=$request->file('img')->getClientOriginalName();
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $fileExt=$request->file('img')->getClientOriginalExtension();
            $fileNameToStore=$fileName.'_'. time().'.'.$fileExt;
            $path=$request->file('img')->storeAs('public/images',$fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }

        $post = new Post();
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->category_id=$request->input('category');
        $post->img=$fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



        $post = Post::find($id); 
        if($post){
            return view('posts.details')->with('post',$post);
        }else{
            return redirect('/');
        }    
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $categories=Category::all();
        $data=[
            'categories' =>$categories,
            'post'=>$post
        ];
        
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error','You are not authorized');
        }

        if(count($data)>0){
            return view('posts.edit')->with($data);
        }else{
            return redirect('/');
        }    
        
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

        if($request->hasFile('img')){
            $fileNameWithExt=$request->file('img')->getClientOriginalName();
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $fileExt=$request->file('img')->getClientOriginalExtension();
            $fileNameToStore=$fileName.'_'. time().'.'.$fileExt;
            $path=$request->file('img')->storeAs('public/images',$fileNameToStore);
        }

        $post = Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');

        if($request->hasFile('img')){
            $post->img=$fileNameToStore;
        }
        $post->category_id=$request->input('category');
        $post->save();
        return redirect('/posts')->with('success','Post Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->img !='noimage.jpg'){
            Storage::delete('public/images/'.$post->img);
        }

        $post->delete();
        return redirect('/home')->with('success','Post Deleted Successfully');
    }
}
