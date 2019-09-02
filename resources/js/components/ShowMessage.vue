<template>
    <div class="row p-0">
        <div class="col-md-1">
            <img class="img-user" :src="'img/iconos/hombre.png'" >
        </div>
        <div class="col-md-11">
            <P class="user-name">{{ message.name }} <span>&#60;{{ message.email }}&#62;</span> - <span>{{ message.phone }}</span></P>
            <p class="mt">{{ message.body }}</p>
            
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            message: []
        }
    },
    mounted() {
        EventBus.$on('show-message', message =>{
            if(this.message.length == 0){
                axios.get(`message/${message}`)
                    .then(res => {
                        this.message = res.data;
                    })
                    .catch(err => {
                        console.log(err.response);
                    });
            }else{
                this.message = [];
            }
            
        });
    }
}
</script>
<style>
    .p-0{
        padding: 0!important;
    }
    .img-user{
        border-radius: 50%;
        border: 1px solid #1b1b1b17;
    }
    
    .user-name{
        font-weight: bold;
    }

    .user-name span{
        font-weight: 500;
    }

    .mt{
        margin-top: 1.6rem!important;
    }
</style>