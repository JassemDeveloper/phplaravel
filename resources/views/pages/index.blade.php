@extends('layouts.app')
@section('content')

<div class="row removeMargin">
    <div class="col-2 small">
            <span class="news-ticker">Latest News : </span>
    </div>
    <div class="col-10">
            <div id="multilines">
         <div class="row">
            <div class="col-11">
                    <div class="container">
                    <ul class="newsticker" id="newsticker">
                
                    </ul>
                    </div>
                </div>
            <div class="col-1">
                <div class="addMargin">
                <a class='prev-button' href='#'><i class='fas fa-arrow-up'></i></a>
                <a class='next-button' href='#'><i class='fas fa-arrow-down'></i></a>
                </div>
            </div>
            </div>
        </div>
</div>

</div>
<div class="jumbotron">
    <div class="container">
        <h1>PHP Laravel Framework 5.6</h1>
        <p>Still learning it </p>
      </div>
</div>
<hr>
    <h5 class="text-center"> Recently added posts </h5>
<hr>
@if(count($posts) > 0)
<div class="owl-carousel owl-theme">
    @foreach($posts as $post)
    <div class="item">
    <div class="card">    
        <div class="cant">
        <img style='width:100%;height:200px;' src="storage/images/{{$post->img}}">
        <h3><a href="{{route('posts.show', $post->id)}}">
             <p>{!! Str::limit($post->title, $limit=12,$end='..') !!}</p>
        </a></h3>
        </div>
    </div>
        </div>
    @endforeach
</div>

@else
@endif
<script>
        $(function () {
var url = "https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=4b12d2676a2c4b238da1bdd0b003a388";
var url1="https://newsapi.org/v2/top-headlines?sources=techradar&apiKey=4b12d2676a2c4b238da1bdd0b003a388";
var data="";

callAjax(url,data);
callAjax(url1,data);




    $('#multilines .newsticker').newsTicker({
                row_height: 25,
                max_rows: 1,
                speed: 2000,
                direction: 'down',
                prevButton: $('#multilines .prev-button'),
                nextButton: $('#multilines .next-button')
            });



function callAjax(url,data){

    $.ajax({
    url: url, 
    success: function(result){
        var len=result.articles.length;
        for(var i=0;i<len;i++){
            var shortedTitle;
            var url=result.articles[i].url;
            var title=result.articles[i].title;
            var source=result.articles[i].source.name;
            var published=result.articles[i].publishedAt;
            var  days=moment(published).fromNow();
            if(shortedTitle > 100){
                 shortedTitle=title.substr(0,100) + "...";
            }else{
                 shortedTitle=title.substr(0,100);

            }
            data +="<li>";
            data +="<span class='source'>";
            data +=source;
            data +="</span> ";
            data +="<a href='"+url+"' target='_blank'>";
            data +=  shortedTitle;
            data +="</a> ";
            data +="<span class='date'>";
            data +=  days;
            data +="</span>";
            data += "</li>";
        }

      var navigation="";
      navigation +="<a class='prev-button' href='#'>Previous<i class='fas fa-arrow-left'></i></a> ";
      navigation +="<a class='next-button' href='#'>Next<i class='fas fa-arrow-right'></i></a> ";
      document.getElementById('newsticker').innerHTML=data;

    }});



}
                });
    </script>


@endsection