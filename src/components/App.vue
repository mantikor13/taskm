<template>
    <div class="app">
        <Menu></Menu>
        <Board></Board>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                message: 'test'
            }
        }
    }
</script>

<style lang="stylus">
    html{
        height 100%;
    }
    body{
        margin: 0;
        height 100%;
    }
    *{
        box-sizing border-box;
    }
    .app{
        width: 100%;
        height: 100%;
        position: relative;

        font-family Roboto;

        /*display inline-block;*/
        /*padding 50px 0 0 150px;*/

        display flex
        justify-content flex-end
        align-items flex-end

    }
</style>