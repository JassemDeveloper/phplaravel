@extends('layouts.app')
@section('content')
<h1 class="text-center">Posts</h1>
@if(count($posts) > 0)
<div class="row">
    @foreach($posts as $post)
    <div class="col-md-6 col-sm-6">    
        <div class='card'>
         <div class="card-body">
        <div class="row">
        <div class='col-md-5 col-sm-5'>
        <img style='width:100%;' src="storage/images/{{$post->post->img}}">
        </div>
        <div class='col-md-5 col-sm-5'>
            <h3><a href="{{route('posts.show', $post->post->id)}}">{{$post->post->title}}</a></h3>
            <p>{!! Str::limit($post->post->body, $limit=35,$end='...') !!}</p>
        </div>
        </div>
        </div>
        <div class="card-footer">
                <small><b>Created On :</b> {{$post->post->created_at}} <b>by</b> {{$post->user->name}} <b> Category :</b> {{$post->category->title}}  </small>
            </div>
        </div>
    </div>
    @endforeach

</div>
{{$posts->links("pagination::bootstrap-4")}} 
@else
<h3>No Posts were added </h3>
@endif

@endsection
