<template>

    <div class="login">

        <video autoplay muted loop src="../img/login.mp4"></video>


        
    </div>

</template>

<script>
    export default {
        data(){
            return{
                mode: 'math'
            }
        },
        methods: {

        }
    }
</script>

<style lang="stylus">

    video{
        position: fixed;
        width 100%
        height: 100%
        top: 0
        left: 0
        opacity .9;
        z-index: -1;

        object-fit fill;
    }
    
</style>