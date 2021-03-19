<template>
    <div class="card mb-4" v-if="showReply">
        <div class="card-body">
            <h3 class="mb-5"> Please add your reply below: </h3>
            <form @submit.prevent="storeComment">
                <div class="form-group">
                    <label for="username">Please enter username: </label>
                    <input type="username" class="form-control" v-model="reply.username" placeholder="Please enter username">
                    <small id="username" class="form-text text-muted">Username will be used as display name</small>
                </div>
                <div class="form-group">
                    <label for="content">Please enter reply: </label>
                    <textarea class="form-control" v-model="reply.content" placeholder="Please enter reply"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                <button type="button" class="btn btn-danger btn-sm" @click="cancel()">Cancel</button>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'CommentReply',
        data() {
            return {
                reply: {
                    post_id: 0,
                    reply_id: 0,
                    username: '',
                    content: ''
                },
                showReply: false
            }
        },
        mounted() {
            var __this = this;
            VUE_EVENT.listen('SHOW_REPLY_BOX',function(data){
                __this.showReplyBox(data);
            });
            VUE_EVENT.listen('CLOSE_REPLY_BOX', function(){
                __this.hideReplyBox();
            });
        },
        methods: {
            cancel() {
                this.hideReplyBox();
                VUE_EVENT.dispatch('SHOW_REPLY_BUTTON');
                $('.reply_btn').show();
            },
            storeComment(){
                var __this = this;
                
                // construct data
                var data = {
                    post_id : __this.reply.post_id,
                    reply_id : __this.reply.reply_id,
                    username : __this.reply.username,
                    content : __this.reply.content
                }
                
                // lets have basic validation
                if(__this.reply.post_id==0){ alert('Please enter post id!'); return false; }
                else if(__this.reply.username==''){ alert('Please enter username!'); return false; }
                else if(__this.reply.content==''){ alert('Please enter reply!'); return false; }

                // save comment
                axios.post('/comment',data)
                .then(function(res){
                    if(res.data.success){
                        __this.hideReplyBox();
                        var post_id = res.data.result.post_id;
                        VUE_EVENT.dispatch('UPDATE_COMMENTS',{post_id:post_id});
                    }
                })
                .catch(function(err){
                    console.log('Error: '+err);
                });
            },
            showReplyBox(data) {
                var __this = this;
                __this.showReply = true;
                __this.reply.post_id = data.post_id;
                __this.reply.reply_id = data.reply_id;
                __this.reply.username = '';
                __this.reply.content = '';
                window.scrollTo(0,100);
            },
            hideReplyBox() {
                var __this = this;
                __this.showReply = false;
                __this.reply.post_id = 0;
                __this.reply.reply_id = 0;
                __this.reply.username = '';
                __this.reply.content = '';
            }
        }
    }
</script>