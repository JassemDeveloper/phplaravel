<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\User;
use JavaScript;
class CategoriesController extends Controller
{

    //authorization 
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
        return redirect('/');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->id == 1){
            $category=new Category();
            $category->title=$request->input('title');
            $category->user_id=auth()->user()->id;
            $category->save();
            return redirect('/home')->with('success','Category Created Successfully');
    
        }else{
            return redirect("/");
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


            $category=Category::find($id);
            $posts = Post::where('category_id', $id)->paginate(5);
            $data=[
                'posts' =>$posts,
                'category'=>$category
            ];

            JavaScript::put([
                'posts' => Post::where('category_id', $id)->with('category','user')->paginate(5)
             ]);

             if(count($posts)>0){
                return view('categories.details')->with($data);
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
        if(auth()->user()->id == 1){

        $category=Category::find($id);
        if(auth()->user()->id != $category->user_id){
            return redirect('/posts')->with('error','You are not authorized');
        }

        if(count($category)>0){
            return view('categories.edit')->with('category',$category);
        }else{
            return redirect('/');
                }
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
        if(auth()->user()->id == 1){

        
        $category = Category::find($id);
        $category->title=$request->input('title');
        $category->save();
        return redirect('/home')->with('success','Category Updated Successfully');
        }else{
            redirect('/');
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
        if(auth()->user()->id == 1){
        $category = Category::find($id);
        $category->delete();
        return redirect('/home')->with('success','Category Deleted  Successfully');
        }else{
            return redirect('/');
        }
    }
}
