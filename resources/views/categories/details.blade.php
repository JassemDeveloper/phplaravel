@extends('layouts.app')
@section('content')
<h1 class="text-center"> {{$category->title}} Posts </h1>
@include('posts')
@endsection
