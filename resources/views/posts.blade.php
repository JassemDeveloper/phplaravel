
 @if(count($posts) > 0)
 @if (\Request::is('posts'))  
 <form action="/search"  method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search " pattern="^[a-zA-Z]*" title="only letters" required> <span class="input-group-btn" >
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> <span class="fas fa-search"></span>
        </span>
    </div>
</form>
 <div id="categories"></div>
@endif
 <div id="posts"></div>
 {{$posts->links("pagination::bootstrap-4")}} 
 @else
 <h3>No Posts were added </h3>
 @endif
 
 <script>
     $(function() {
         console.log(posts);
     var len=posts.data.length;
     var data="<br/> <h3 class='text-center'> </h3>";
         data +="<div class='row'>";
     for(var i=0;i<len;i++){
             var createdDate=posts.data[i].created_at;
             var days=moment(createdDate).fromNow();
             var body=posts.data[i].body;
             var shortedBody= body.substring(0, 30);
             data +="<div class='col-md-6 col-sm-6'>";
             data +="<div class='card'>";
             data +="<div class='card-body'>";
             data +="<div class='row'>";
             data +="<div class='col-md-5 col-sm-5'>";
             data +="<img style='width:100%;height:200px;' src='../storage/images/"+posts.data[i].img+"'>";
             data +="</div>";
             data +="<div class='col-md-5 col-sm-5'>";
             data +="<h3><a href='/posts/"+posts.data[i].id+"'>"+posts.data[i].title+"</a></h3>";
             data +="<p>"+shortedBody+"</p>";
             data +="</div>";
             data +="</div>";
             data +="</div>";
             data +='<div class="card-footer">';
             data +="<small><b>Added:</b> "+days+" <b>By</b> "+posts.data[i].user.name+" <b> Category </b> <a  href='/categories/"+ posts.data[i].category_id+"'>"+ posts.data[i].category.title +"</a></small>";
             data +="</div>";
             data +="</div>";
             data +="</div>";
     }
     data +="</div>";
     document.getElementById('posts').innerHTML=data;
 });
 
 @if (\Request::is('posts'))  

     $(function() {
     var len=categories.length;
     var data="<br/> <h3 class='text-center'>Categories </h3>";
    data +=" <div class='d-flex justify-content-center'>";
     for(var i=0;i<len;i++){
             data +="<div class='category-item btn btn-primary'>";
             data +="<a class='category_link' href='/categories/"+ categories[i].id +"'>";
                data +=categories[i].title;
                data +=  " <span class='badge badge-light'>"+categories[i].post.length+"</span>";
            data +="</a>";
             data +="</div>";
     }
     data +="</div>";
     document.getElementById('categories').innerHTML=data;
 });

 @endif
     
 </script>
 