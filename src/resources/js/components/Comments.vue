<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h1> {{ post.title }}</h1>
                <p>  {{ post.post }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h2> Leave Comment :</h2>
                <div v-if="user">
                    <textarea class="form-control" v-model="commentBox"></textarea>
                    <br>
                    <button  class="btn btn-info" @click.prevent="postComment">Submit</button>
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <h1>Comments</h1>
            <br>
            <div v-for="comment in comments" key="">
                <p>{{comment.body}} </p>
                <hr>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Echo from 'laravel-echo';

export default {
    props: {
        post: {
            type: Object
        },
        user: {
            type: Object
        }
    },
    data() {
        return {
            comments: {},
            commentBox :'gdfg',
            user: this.user ? this.user : ""
        };
    },
    mounted(){
        this.getComments()
        this.listen()
    },
    methods:{
        listen(){
            window.Echo.private('post.'+this.post.id)
                .listen('NewComment',(comment)=>{
                    this.comments.unshift(comment);
                })
        },
        getComments(){
            axios.get(`/api/posts/${this.post.id}/comments`)
                .then((res)=>{
                    //alert(res.data[0].body)
                    this.comments = res.data
                })
                .catch(function (error){
                    alert(error)
                    console.log(error)
                })

        },
        postComment(){
            var data = {
             body : this.commentBox,
           };
            axios.post( `/posts/${this.post.id}/comment`,data,{
                headers: {
                        //"Authorization": `Bearer 6|yWWgQVlYuh6Orsc9v1cpoEd5xBJ7Gx5pAG9Fyu9z302e6fbb` ,
                        "Content-Type": "application/json",
                        //"x-access-token": "6|yWWgQVlYuh6Orsc9v1cpoEd5xBJ7Gx5pAG9Fyu9z302e6fbb",
                        }
               }).then((res)=>{
                    this.comments.unshift(res.data)
                    this.commentBox = '';
                })
            .catch(function (error){
                alert(error)
                console.log(error)
            })

        },
    },
    created() {
        console.log(this.comments)
    }
};
</script>
