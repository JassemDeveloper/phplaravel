<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->orderby('created_at','desc')->take(10)->get();
        return view('pages.index')->with('posts',$posts);
    }

    public function about(){
        return view('pages.about');
    }
}
