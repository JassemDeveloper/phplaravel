<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
/*
    public function category(){
        return $this->belongsTo('App\Post');
    }
    */

    protected $fillable = ['title','created_at', 'updated_at','user_id'];

    public function user(){
        return $this->belongsTo('App/User');
    }

    public function post(){
        return $this->hasMany('App\Post');
    }


    
}
