<template>
    <div class="app">
        <h1 class="title">{{message}}</h1>
        <div class="content">lorem*2</div>
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
    .app{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;

        .content{
            font-size: 30px;
        }
    }
</style>