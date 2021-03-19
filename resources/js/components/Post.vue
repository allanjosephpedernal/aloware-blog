<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="jumbotron jumbotron-fluid mb-0">
                        <div class="container">
                            <h1 class="display-4">{{ post.title }}</h1>
                            <p class="lead">{{ post.content }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <comment></comment>
        </div>
    </div>
</template>
<script>
    import Comment from '../components/Comment';

    export default {
        name: 'Post',
        components: {
            'comment': Comment
        },
        data: function() {
            return {
                post:{
                    id: 1,
                    title: '',
                    content: ''
                }
            }
        },
        beforeMount() {
            var __this = this;
            __this.getPost();
        },

        methods: {
            // get post
            getPost(){
                var __this = this;
                var post_id = __this.post.id;
                axios.get('/post/'+post_id)
                .then(function(res){
                    __this.post.id = res.data.result.id;
                    __this.post.title = res.data.result.title;
                    __this.post.content = res.data.result.content;
                })
                .catch(function(err){
                    console.log('Error: '+err);
                });
            }
        }
    }
</script>