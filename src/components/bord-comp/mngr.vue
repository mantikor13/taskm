<template>

    <div class="mngr">

        <div class="mngr__new">
            <div class="mngr__new_wrap" @dblclick="viewAddTask">

            </div>
            <transition name="fade">
                <div class="mngr__new-task" v-if="newMode" v-bind:style="formPosition">
                    <div class="mngr__new-task_inner">
                        <input class="mngr__new-title mngr__new-text" v-model="newTaskData.title" type="text" placeholder="Title">
                        <input class="mngr__new-author mngr__new-text" v-model="newTaskData.author" type="text" placeholder="Author">
                        <div class="mngr__new-btns">
                            <input type="checkbox">
                            <span @click="addTask" v-bind:style="valid">+</span>
                        </div>
                    </div>
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
                formPosition: {
                    top: '',
                    left: ''
                },
                newTaskData: {
                    title: '',
                    author: ''
                },
                valid: {
                    color: '#000'
                }
            }
        },
        methods: {
            viewAddTask(e){
                this.newMode = !this.newMode;
                this.formPosition.top = `${e.y}px`;
                this.formPosition.left = `${e.x}px`;
            },
            addTask(){
                axios.post(`req.php`, {
                    title: this.newTaskData.title,
                    author: this.newTaskData.author,
                    target: 'addTask'
                }).then(response => {
                    this.newTaskData.title = '';
                    this.newTaskData.author = '';
                    this.newMode = !this.newMode;
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

            &-task{
                position fixed;
                width 250px;
                padding 0 5px;

                border-top: 5px solid #009700;

                &_inner{
                    width: 100%
                    height: 100%

                    display: flex
                    flex-direction: column
                    align-items center;

                    padding 25px 15px;

                    background-color: rgba(0, 0, 0, 0.5);
                    border-radius 10px;
                    border-top-right-radius: 0;
                    border-top-left-radius: 0;
                }

                .mngr__new-text{
                    width: 100%;
                    padding: 2px 5px;
                    margin-bottom 20px;

                    border: none;
                    border-bottom: 1px solid #5B1554
                    background-color: transparent;
                    color: #fff;
                    font-size: 16px

                    &:focus{
                        outline none;
                    }
                }

                .mngr__new-btns{
                    width: 100%
                    display: flex;
                    justify-content: space-between
                    align-items:center

                    span{
                        font-size: 40px;
                    }
                }
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

            border-top: 5px solid #5B1554;

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