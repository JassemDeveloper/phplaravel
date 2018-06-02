@extends('layouts.app')
@section('content')
<h1>Create Posts</h1>

{!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
            <select class="form-control" name='category' required>
            @if(count($categories)>0)
                <option value="">Please Select Category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}"> {{$category->title}}</option>
            @endforeach
            @else
            <option value="">Please Add Category</option>   
            @endif
        </select>
     
            </div>
    <div class="form-group">
            {{Form::textarea('body','',['id'=>'post-ckeditor','class'=>'form-control','placeholder'=>'Title'])}}
    </div>

    <div class="form-group">
            {{Form::file('img',['class'=>'btn btn-primary'])}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection