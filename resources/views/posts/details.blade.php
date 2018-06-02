@extends('layouts.app')
@section('content')
        <div class='card '>
        <div class="card-header text-center">
        <h3>{{$post->title}}</h3>
        </div>
        <img style='width:100%' src="../storage/images/{{$post->img}}">
        <p>{!!$post->body!!}</p>
        <small><b>Created On :</b> {{$post->created_at}} <b>by</b> {{$post->user->name}} <b> Category :</b> {{$post->category->title}}  </small>
@if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
    <div class="card-footer">
        {!! Form::model($post, array('route' => array('posts.destroy', $post->id), 'method' => 'DELETE')) !!} 
        <a class="btn btn-primary float-left" href="{{route('posts.edit', $post->id)}}">Edit</a>
        {{Form::submit('Delete',['class'=>'btn btn-danger float-right'])}}
        {!! Form::close() !!} 
        </div>
    @endif
@endif 
</div>
<br/>
@endsection