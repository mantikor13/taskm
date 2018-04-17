<template>

    <div class="mngr">

        <div class="mngr__new">
            <div class="mngr__new_wrap" @dblclick="newMode = !newMode">

            </div>
            <transition name="fade">
                <div class="mngr__new-task-form" v-if="newMode">
                    <input class="mngr__new-title" v-model="newTaskData.title" type="text">
                    <input class="mngr__new-author" v-model="newTaskData.author" type="text">
                    <button @click="addTask"></button>
                </div>
            </transition>
        </div>
        <div class="mngr__tasks">
            <div class="mngr__regular">
                <div class="mngr__item">
                    <div class="mngr__item_wrap">
                        <div class="item__top">
                            <div class="item__title">Test</div>
                            <div class="item__count">5</div>
                        </div>
                        <div class="item__content">
                            Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsum
                        </div>
                    </div>
                </div>
                <div class="mngr__item">
                    <div class="mngr__item_wrap">
                        <div class="item__top">
                            <div class="item__title">Test</div>
                            <div class="item__count">5</div>
                        </div>
                        <div class="item__content">
                            Lorem ipsum Lorem ipsumLorem ipsum Lorem ipsum Lorem ipsum
                        </div>
                    </div>
                </div>
            </div>
            <div class="mngr__stream"></div>
        </div>

    </div>

</template>

<script>
    import $ from 'jquery';
    import axios from 'axios';

    export default {
        data(){
            return{
                newMode: false,
                newTaskData: {
                    title: '',
                    author: ''
                }
            }
        },
        methods: {
            addTask(){
                axios.post(`req.php`, {
                    title: this.newTaskData.title,
                    author: this.newTaskData.author,
                    target: 'addTask'
                }).then(response => {
                    this.newTaskData.title = '';
                    this.newTaskData.author = '';
                    console.log(response.data)
                })
            }
        }
    }
</script>

<style lang="stylus">

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }

    .mngr{
        padding 50px;

        display: flex;

        &__new{
            width 300px
            border-right 3px solid #491D37;
            position: relative

            &_wrap{
                width 100%
                height: 100%
            }

            &-task-form{
                position absolute;
                top 0;
                bottom: 0

            }
        }

        &__tasks{
            flex-grow 1

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

            padding 0 5px;

            border-top: 5px solid red;

            color: white

            &_wrap{
                height 100%;
               background-color: rgba(0, 0, 0, 0.5);
               padding 15px;
               border-radius 10px;
               border-top-right-radius: 0;
               border-top-left-radius: 0;
            }

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

    @media only screen and (max-width: 1600px) {
        .mngr {
            padding 20px;
        }
    }


</style>