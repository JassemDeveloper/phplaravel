<template>
    <div>
    <h1 class="text-center">Posts</h1>
    <hr>
<div class="d-flex justify-content-center"> 

       <div class="category-item btn btn-primary" v-for="category in categories" :key="category.id"> 
<!--
            <router-link :to="'/categories/'+category.id">{{ category.title }}</router-link>
-->
        
        <a v-bind:href="'/categories/'+ category.id" style="color:white;"> 
        {{ category.title }}<span class="badge badge-light">{{category.post.length}}</span>
        </a>
        
        
        </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6" v-for="post in posts" :key="post.id">    
        <div class='card'>
         <div class="card-body">
        <div class="row">
        <div class='col-md-5 col-sm-5'>
        <img style='width:100%;height:150px;' v-bind:src="'/storage/images/' + post.img" /> 
        </div>
        <div class='col-md-5 col-sm-5'>
          <h3>
          <a v-bind:href="'/posts/'+ post.id"> {{post.title}} </a>
          </h3>
        <p v-html="$options.filters.truncate(post.body)"></p>
        </div>
        </div>
        </div>
        <div class="card-footer">
                <small><b>Created On :</b> {{post.created_at|moment}} <b>by</b> {{post.user.name}} <b> Category :</b> {{post.category.title}}  </small>
            </div>
        </div>
    </div>
</div>
<div v-if="total >5">
 <paginate
        :page-count="pageCount"
        :click-handler="fetch"
        :prev-text="'Prev'"
        :next-text="'Next'"
        :container-class="'pagination'">
        </paginate>
</div>


    </div>
</template>

<script>
    export default {

        data() {
            return {
                posts: [],
                categories:[],
                total:0,
                pageCount: 1,
                postsApi: 'api/posts?page=',
                categoriesApi:'api/categories'
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
               Vue.axios.get(this.postsApi + page)
                    .then(({data}) => {
                        this.posts = data.data;
                        this.pageCount = data.last_page;
                        this.total=data.total;

                    });

                Vue.axios.get(this.categoriesApi)
                    .then(({data}) => {
                        this.categories = data;
                    });
            },
            decodeHtml: function (html) {
      var txt = document.createElement("p");
      txt.innerHTML = html;
      return txt.value;
    }
        },
        filters: {
        moment: function (date) {
                      return moment(date).fromNow(); // 7 years ago;
        }
}
    }
</script>