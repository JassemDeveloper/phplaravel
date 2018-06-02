@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="row">
                        <div class="card numMar">
                                <div class="cant num">
                                <p>  Posts </p>
                                <h3>{{$postTotal ->count()}}</h3>
                                </div>
                        </div>
                        @if(Auth::user()->id == 1 )

                        <div class="card numMar">
                                <div class="cant num">
                                <p>  Categories </p>
                                <h3>{{$catotal ->count()}}</h3>
                                </div>
                        </div>
                        @endif
                </div>
                <div class="card-body">
                        <a class='btn btn-primary' href="/posts/create">Create Post</a>
                        @if(Auth::user()->id == 1 )
                        <a class='btn btn-primary' href="/categories/create">Create Category</a>
                        @endif
                    <br/><br/>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <h3> Posts </h3>
                    @if(count($posts)>0)
                    <table class='table table-striped'>
                    <tr>
                        <th>Title</th>
                        <th colspan='2'>Action</th>
                    </tr>
                    @foreach($posts as $post)
                    <tr style="text-align:left;">
                        <td>{{$post->title}}</td>
                        <td style="width:40px;">
                         <a class="btn btn-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
                        </td>
                        <td style="width:40px;">
        {!! Form::model($post, array('route' => array('posts.destroy', $post->id), 'method' => 'DELETE')) !!} 
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!! Form::close() !!} 
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    {{$posts->links("pagination::bootstrap-4")}} 

                    @else
                    <p> You have no posts </p>
                    @endif
                    @if(Auth::user()->id == 1 )
                    <h3>Categories </h3>
                    @if(count($categories)>0)
                    <table class='table table-striped'>
                    <tr>
                        <th>Title</th>
                        <th colspan='2'>Action</th>
                    </tr>
                    @foreach($categories as $category)
                    <tr style="text-align:left;">
                        <td>{{$category->title}}</td>
                        <td style="width:40px;">
                         <a class="btn btn-primary" href="{{route('categories.edit', $category->id)}}">Edit</a>
                        </td>
                        <td style="width:40px;">
        {!! Form::model($category, array('route' => array('categories.destroy', $category->id), 'method' => 'DELETE')) !!} 
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!! Form::close() !!} 
                        </td>
                    </tr>
                    @endforeach
                    </table>
                    {{$categories->links("pagination::bootstrap-4")}} 

                    @else
                    <p> You have no Categories added </p>
                    @endif
                    @else

                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
