<template>

    <div class="mngr">

        <div class="mngr__new"></div>
        <div class="mngr__tasks">
            <div class="mngr__regular">
                <div class="mngr__item">
                    <div class="item__top">
                        <div class="item__title">Test</div>
                        <div class="item__count">5</div>
                    </div>
                    <div class="item__content">
                        Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsum
                    </div>
                </div>
                <div class="mngr__item">
                    <div class="item__top">
                        <div class="item__title">Test</div>
                        <div class="item__count">5</div>
                    </div>
                    <div class="item__content">
                        Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsum
                    </div>
                </div>
            </div>
            <div class="mngr__stream"></div>
        </div>

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

    .mngr{
        padding 50px;

        display: flex;

        &__new{
            flex-basis 300px;
            flex-grow: 2;
            border-right 3px solid #491D37;
        }

        &__tasks{
            flex-basis 300px;
            flex-grow: 7;

            display flex;
            flex-direction column;

            & > div{
                margin-left 50px;
            }
        }

        &__regular{
            display flex;
            justify-content: space-between
            height 30%;
            padding-bottom: 20px;
            border-bottom 3px solid #491D37;
        }

        &__stream{
            height 70%;
            padding-top: 20px;
        }

        &__item{
            height 100%;
            width 45%;

            padding 15px;

            border: 1px solid red;
            border-radius 10px;

            background-color: rgba(0, 0, 0, 0.5);
            color: white

            .item__top{
                display flex
                justify-content: space-between
                font-size 25px
                margin-bottom: 10px;
                padding-bottom: 15px;
                border-bottom: 1px solid #fff;
                
                .item__count{
                    padding: 0 5px;
                    background-color: #fff;
                    color: #000;
                }
            }

            .item__content{

            }

        }
    }

</style>