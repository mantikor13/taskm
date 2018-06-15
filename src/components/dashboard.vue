<template>

    <div class="board">
        <Manager v-if="mode1 === 'mngr'"></Manager>
        <Math v-else-if="mode1 === 'math'"></Math>
        <Hist v-else-if="mode1 === 'hist'"></Hist>
        <Global v-else-if="mode1 === 'global'"></Global>
    </div>

</template>

<script>
    export default {
        props: {
            mode: {
                // default: 'math'
            }
        },
        computed: {
            mode1: function () {
                return this.mode
            }
        }
    }
</script>

<style lang="stylus">
    .board{
        width calc(100vw - 150px)
        height calc(100vh - 50px)
        position: relative;

        video{
            position: fixed;
            bottom: 0
            right: 0
            width calc(100vw - 150px)
            height calc(100vh - 50px)
            opacity .9;
            z-index: -1;

            object-fit fill;
        }

        & > div{
           width 100%;
           height 100%;

            padding: 50px

            position: relative;
        }

        @media only screen and (max-width: 1600px) {
            .board > div{
                padding 20px;
            }

            video{
                left: -20px
                top: -20px
                width calc(100% + 20px);
                height: calc(100% + 20px);
            }
        }
    }
</style>