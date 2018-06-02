<template>
    <div>
    <h1 class="text-center">{{category}}</h1>
    {{this.$route.params.catId}}
    <hr>

<!--
<div v-if="total >5">
 <paginate
        :page-count="pageCount"
        :click-handler="fetch"
        :prev-text="'Prev'"
        :next-text="'Next'"
        :container-class="'pagination'">
        </paginate>
</div>
-->

    </div>
</template>
<script>
    export default {
        data() {
            return {
                posts: [],
                category:"",
                total:0,
                pageCount: 1,
                postsApi1: 'api/categories/6'
            };
        },

        created() {
            this.fetch();
        },
//this.$route.params.catId
        methods: {
            fetch() {
                Vue.axios.get(this.postsApi1,
                {
            headers : {
                'Content-Type' : 'application/json',
                'Accept' : 'application/json'
            }
        })
                    .then(({data}) => {
                        this.posts = data.data;
                        this.category=data.title;
                        this.pageCount = data.last_page;
                        this.total=data.total;
                    });
            }
        },
        filters: {
        moment: function (date) {
                      return moment(date).fromNow(); // 7 years ago;
        }
}
    }
</script>