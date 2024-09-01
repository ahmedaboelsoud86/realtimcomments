<template>
    <div class="dropdown" style="float:right; margin-right:700px; margin-top:10px">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            NOT ( <span v-if="unreadCount > 0"> {{ unreadCount }} </span> )
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li v-for="item in allnotfy" :key="item.post_id">
                <a :href="'/post/'+`${item.data.post_id}`"  v-bind:class="[item.read_at ? '' : 'readClass']" @click="readNotification(item)">
                     <span style="font-weight: bold;">{{ item.data.user  }} </span>
                     Commented  On your post  :  {{ item.data.title  }}
                 </a>
            </li>

        </ul>

    </div>
</template>

<script>
export default {
    data() {
        return {
            allnotfy: {},
            unread: {},
            unreadCount: 0,
        };
    },
    created() {
        this.getNotification()
        var userId =  $('meta[name="userId"]').attr('content');

        window.Echo.private('App.Models.User.' + userId)
                .notification((notification)=>{
                    this.allnotfy.unshift(notification);
                    this.unreadCount++;
                });

    },
    methods:{
        readNotification(notification){
             axios.post(`/readNotification`,{id:notification.id})
                  .then(res=>{
                    this.unread.splice(notification,1);
                    this.allnotfy.push(notification);
                    this.unreadCount--;
                 })

        },
        getNotification(){
          axios.get(`/getNotification`)
                .then((res)=>{
                    this.allnotfy   = res.data.allnotfy
                    this.unread =   res.data.unread
                    this.unreadCount = res.data.unread.length
                })
                .catch(function (error){
                    alert(error)
                    console.log(error)
                })
        }

    }
};
</script>

<style>
.readClass{
    color: brown;
    background-color:cadetblue;
}
</style>

