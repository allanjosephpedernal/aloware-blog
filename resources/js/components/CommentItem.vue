<template>
    <div class="media mt-4">
        <a class="pr-3" href="#">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1784594cc31%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1784594cc31%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
        </a>
        <div class="media-body">
            <h5 class="mt-0">{{ reply.comment.username }}</h5>
            {{ reply.comment.content }}
            <div v-if="depth<3">
                <a href="#" @click.prevent="showReplyBox()" class="btn btn-sm btn-primary mt-3 reply_btn">Reply</a>
            </div>
            <div v-if="reply.comment.replies.length>0 && depth<3">
                <comment-item 
                v-for="rep in reply.comment.replies" 
                :key="rep.id"
                :reply="rep"
                :depth="depth + 1"
                ></comment-item>
            </div>
        </div>
    </div>   
</template>
<script>
    export default {
        name: 'CommentItem',
        props: ['reply','depth'],
        mounted() {
            console.log('DEPTH: '+this.depth);
        },
        methods: {
            // reply box
            showReplyBox() {
                var post_id = this.reply.comment.post_id;
                var reply_id = this.reply.comment.id;
                VUE_EVENT.dispatch('SHOW_REPLY_BOX',{post_id: post_id, reply_id: reply_id});
                $('.reply_btn').hide();
            }
        }
    }
</script>