@extends('layouts.app')
@section('content')
@if(count($posts) > 0)
<form action="/search"  method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search " pattern="^[a-zA-Z]*" title="only letters" required> <span class="input-group-btn" >
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> <span class="fas fa-search"></span>
        </span>
    </div>
</form>
@if (\Request::is('search'))  
<h1 class="text-center">Found Posts </h1>

@endif
@include('posts')
@else
<form action="/search"  method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search " pattern="^[a-zA-Z]*" title="only letters" required> <span class="input-group-btn" >
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> <span class="fas fa-search"></span>
        </span>
    </div>
</form>
<h1 class="text-center">No Posts were found for  "{{ $query }}"</h1>
@endif


@endsection
