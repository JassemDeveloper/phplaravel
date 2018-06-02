<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'body', 'created_at', 'updated_at','user_id','img','category_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function category(){
        return $this->belongsTo('App\Category');
    }


    
    public function scopeSearch($q)
{
    return empty(request()->search) ? $q : $q->where('title', 'like', '%'.request()->search.'%');
}

}
