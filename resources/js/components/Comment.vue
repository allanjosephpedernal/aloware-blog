<template>
    <div>
        <div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button class="btn btn-primary btn-lg mb-4 reply_btn" @click.prevent="addComment()">Add Comment</button>
                </div>
            </div>
        </div>
        <comment-reply></comment-reply>
        <div v-if="post.comment.result.length>0">
            <div class="card mb-4">
                <div class="card-body">
                    <comment-item 
                    v-for="reply in post.comment.result" 
                    :key="reply.id"
                    :reply="reply"
                    :depth="post.comment.depth + 1"
                    ></comment-item>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    // import components
    import CommentItem from '../components/CommentItem';
    import CommentReply from '../components/CommentReply';

    export default {
        name: 'Comment',
        components: {
            'comment-item': CommentItem,
            'comment-reply': CommentReply
        },
        data: function() {
            return {
                post:{
                    id: 1,
                    comment: {
                        depth: 0,
                        result: []
                    },
                }
            }
        },
        mounted() {
            var __this = this;
            VUE_EVENT.listen('UPDATE_COMMENTS', function(data){
                __this.post.id = data.post_id;
                __this.getPostComments();
                $('.reply_btn').show();
            });
        },
        beforeMount() {
            this.getPostComments();
        },
        methods: {
            // add comment
            addComment() {
                var __this = this;
                var post_id = __this.post.id;
                var reply_id = 0;
                VUE_EVENT.dispatch('SHOW_REPLY_BOX',{post_id: post_id, reply_id: reply_id});
                $('.reply_btn').hide();
            },
            // get post comments
            getPostComments(){
                var __this = this;
                var post_id = __this.post.id;
                axios.get('/post/comment/'+post_id)
                .then(function(res){
                    __this.post.comment.result = res.data.result;
                })
                .catch(function(err){
                    console.log('Error: '+err);
                });
            }
        }
    }
</script>