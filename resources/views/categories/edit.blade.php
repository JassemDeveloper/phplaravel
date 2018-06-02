@extends('layouts.app')
@section('content')
<h1>Edit Category</h1>
{!! Form::open(['action' => ['CategoriesController@update',$category->id],'method'=>'POST']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$category->title,['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection