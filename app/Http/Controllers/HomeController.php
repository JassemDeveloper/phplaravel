<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $postsTotal=Post::where('user_id',$user_id);
        $posts=Post::where('user_id',$user_id)->paginate(5);
        $categories=Category::where('user_id',$user_id)->paginate(5);
        $categoriesTotal=Category::where('user_id',$user_id);
        $data=[
            'categories' =>$categories,
            'posts'=>$posts,
            'catotal'=> $categoriesTotal,
            'postTotal'=>$postsTotal
        ];
        return view('home')->with($data);
    }
}
