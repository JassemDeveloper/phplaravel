<?php
use App\Post;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');


Route::resource('posts','PostsController');
Route::resource('categories','CategoriesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::any('/search',function(){
    $q = Input::get ('q');
    $posts = Post::where('title','LIKE','%'.$q.'%')->with('user','category')->paginate(5);

    JavaScript::put([
        'posts' =>Post::where('title','LIKE','%'.$q.'%')->with('user','category')->paginate(5)
     ]);

    if(count($posts) > 0){
        return view('posts.search')->with('posts',$posts)->withQuery ($q);
    }else{
        return view('posts.search')->with('posts',$posts)->withQuery ($q);
    }
});



