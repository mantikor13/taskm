<template>

    <div class="board">
        <video autoplay muted loop id="myVideo">
            <source src="../img/mngr.mp4" type="video/mp4">
        </video>
        <Manager></Manager>
        <Math class="math"></Math>
        <Hist class="hist"></Hist>
        <Global class="glob"></Global>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                message: 'Hellow, world'
            }
        }
    }
</script>

<style lang="stylus">
    .board{
        width calc(100vw - 150px);
        height calc(100vh - 50px);
        position: relative;

        video{
            position: fixed;
            width 100%;
            height: 100%;
            opacity .9;

            object-fit fill;
        }

        & > div{
           width 100%;
           height 100%;

            position: relative;

            display none;
        }

        .mngr{
            display: flex;
        }
    }
</style>