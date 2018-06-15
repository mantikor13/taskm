<template>
    <div class="app">
        <Login v-if="!isAuth"></Login>
        <Menu v-else @changeMode="changeMode"></Menu>
        <Board v-else v-bind:mode="mode"></Board>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                mode: 'math',
                isAuth: false
            }
        },
        methods: {
            changeMode(mode){
                this.mode = mode;
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

        display flex
        justify-content flex-end
        align-items flex-end

    }
</style>