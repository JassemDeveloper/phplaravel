@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
{!! Form::open(['action' => ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        <select class="form-control" name='category' required>
        @if(count($categories)>0)
            <option value="{{$post->category->id}}">{{$post->category->title}}</option>
            {{$check=$post->category->id}}
        @foreach($categories as $category)
             {{$categoryId=$category->id}}
            @if($check==$categoryId)
            @else
            <option value="{{$category->id}}"> {{$category->title}}</option>
            @endif
        @endforeach
        @else
        <option value="">Please Add Category</option>   
        @endif
    </select>
 
        </div>
    <div class="form-group">
            {{Form::textarea('body',$post->body,['id'=>'post-ckeditor','class'=>'form-control','placeholder'=>'Body'])}}
    </div>
    
    <div class="form-group">
            {{Form::file('img',['class'=>'btn btn-primary'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection