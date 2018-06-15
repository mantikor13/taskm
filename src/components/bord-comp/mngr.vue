<template>

    <div class="mngr">

        <video autoplay muted loop id="myVideo">
            <source src="../../img/mngr.mp4" type="video/mp4">
        </video>

        <div class="mngr__new">
            <div class="mngr__new_wrap" @dblclick="viewAddTask">

            </div>
            <transition name="fade">
                <div class="mngr__new-task" v-if="newMode" v-bind:style="formPosition">
                    <div class="mngr__new-task_inner">
                        <input class="mngr__new-title mngr__new-text title" v-model="newTaskData.title" type="text" placeholder="Title">
                        <div class="mngr__new-author">
                            <div @click="setAuthor">Рома</div>
                            <div @click="setAuthor">Тоха</div>
                        </div>
                        <div class="mngr__new-btns">
                            <input class="regular" type="checkbox" v-model="newTaskData.regular">
                            <span @click="addTask" v-show="valid">+</span>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <div class="mngr__tasks">
            <div class="mngr__regular">
                <div class="mngr__item mngr__regular-item" v-for="(reg, index) in tasks.reg" v-bind:style="reg.color">
                    <div class="mngr__item_wrap">
                        <div class="item__top">
                            <div class="item__title">{{reg.title}}</div>
                            <div class="item__count">{{reg.count}}</div>
                        </div>
                        <div class="item__content">
                            <div class="item__update" @click="addPoint(reg.id, reg.count)">+</div>
                            <div class="item__end_wrap">
                                <input type="checkbox" v-model="reg.edit">
                                <div class="item__end" v-show="reg.edit">
                                    <div class="item__delete" @click="addPoint(reg.id, reg.count, 'delete', index, 'reg')">Delete</div>
                                    <div class="item__done" @click="addPoint(reg.id, reg.count, 'done', index, 'reg')">Done</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mngr__flow">
                <div class="mngr__item mngr__flow-item" v-for="(flow, index) in tasks.flow" v-bind:style="flow.color">
                    <div class="mngr__item_wrap">
                        <div class="item__top">
                            <div class="item__title">{{flow.title}}</div>
                            <div class="item__count">{{flow.count}}</div>
                        </div>
                        <div class="item__content">
                            <div class="item__update" @click="addPoint(flow.id, flow.count)">+</div>
                            <div class="item__end_wrap">
                                <input type="checkbox" v-model="flow.edit">
                                <div class="item__end" v-show="flow.edit">
                                    <div class="item__delete" @click="addPoint(flow.id, flow.count, 'delete', index, 'flow')">Delete</div>
                                    <div class="item__done" @click="addPoint(flow.id, flow.count, 'done', index, 'flow')">Done</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import $ from 'jquery';
    import axios from 'axios';

    export default {
        data(){
            return{
                tasks: {
                    reg: [],
                    flow: []
                },
                newMode: false,
                formPosition: {
                    top: '',
                    left: ''
                },
                newTaskData: {
                    title: '',
                    author: false,
                    regular: false
                },
                valid: false
            }
        },
        methods: {
            viewAddTask(e){
                this.newMode = !this.newMode;
                this.formPosition.top = `${e.y}px`;
                this.formPosition.left = `${e.x}px`;
                console.log(e);
            },
            setAuthor(event){
                $(".mngr__new-author div").removeClass("checked");
                $(event.target).addClass("checked");
                this.newTaskData.author = $(event.target).text();
            },
            addTask(){
                axios.post(`req.php`, {
                    title: this.newTaskData.title,
                    author: this.newTaskData.author,
                    regular: this.newTaskData.regular,
                    target: 'addTask'
                }).then(response => {
                    this.newTaskData.title = '';
                    this.newTaskData.author = '';
                    this.newTaskData.regular = false;
                    this.newMode = !this.newMode;
                    this.fillBoard();
                });
            },
            fillBoard(){
                axios.post(`req.php`,{
                    all: false,
                    target: 'getTasks'
                }).then(response => {
                    let res = response.data;

                    let data = [];

                    res.forEach(function(item){
                        let task = {};

                        task.id = item[0];
                        task.title = item[1];
                        task.text = item[2];
                        task.author = item[3];
                        task.date = item[4];
                        task.count = item[5];
                        task.regular = item[6];
                        task.done = item[7];

                        if(task.author == 'Рома'){
                            task.color = 'border-top-color: #096C09'
                        }else{
                            task.color = 'border-top-color: #FF9A00'
                        }

                        task.edit = false;

                        data.push(task);

                    });

                    let regular = [];
                    let flow = [];

                    data.forEach(function (item) {
                       if(!item.regular){
                           flow.push(item);
                       }else{
                           regular.push(item);
                       }
                    });

                    this.tasks.reg = regular;
                    this.tasks.flow = flow;
                });
            },
            addPoint(id, count, end, index, type){
                let done;
                if(end == 'done'){
                    done = true;
                    if(type == 'reg'){
                        this.tasks.reg.splice(index, 1)
                    }else{
                        this.tasks.flow.splice(index, 1)
                    }
                }else if(end == 'delete'){
                    done = false;
                    if(type == 'reg'){
                        this.tasks.reg.splice(index, 1)
                    }else{
                        this.tasks.flow.splice(index, 1)
                    }
                }
                axios.post(`req.php`, {
                    id: id,
                    count: count,
                    done: done,
                    target: 'addPoint'
                }).then(response => {
                    console.log(response)
                });
            }
        },
        watch: {
            newTaskData: {
                handler(val){
                    if(this.newTaskData.title != '' && this.newTaskData.author){
                        this.valid = true
                    }else{
                        this.valid = false
                    }
                },
                deep: true
            }
        },
        created(){
            this.fillBoard();
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
        display: flex;

        &__new{
            min-width 300px;
            border-right 3px solid #491D37;
            position: relative;

            &_wrap{
                width 100%
                height: 100%
            }

            &-task{
                position fixed;
                width 250px;
                padding 0 5px;

                border-top: 5px solid #491d37;

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

                .mngr__new-author{
                    display: flex
                    border 1px solid #5b1554
                    width: 100%
                    height 30px

                    div{
                        display: flex;
                        justify-content: center
                        align-items: center
                        width: 50%;
                        border-right: 1px solid #5b1554
                        background-color: #B8B8B8
                        opacity 0.7

                        &:first-child{
                            border-top-left-radius: 5px;
                            border-bottom-left-radius: 5px;
                        }

                        &:last-child{
                            border: none;
                            border-top-right-radius: 5px;
                            border-bottom-right-radius: 5px;
                        }

                        &:hover{
                            cursor: pointer;
                            background-color: #E3E3E3
                            opacity 1
                        }

                        &.checked{
                            background-color: #E3E3E3
                            opacity 1
                        }
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

        &__item{
            /*height 100%;*/
            /*width 45%;*/

            padding 0 5px;
            margin: 0 10px;

            border-top: 5px solid;

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
                justify-content: flex-end
                align-items: flex-start
                font-size 25px
                margin-bottom: 10px;
                padding-bottom: 15px;
                border-bottom: 1px solid #fff;

                position: relative
                
                .item__count{
                    padding: 0 5px;
                    background-color: #fff;
                    color: #000;
                }

                .item__title{
                    width: 80%
                    height 30px
                    position: absolute;
                    top: 0;
                    left: 0;
                    text-overflow: ellipsis;
                    overflow: hidden
                }
            }

            .item__content{
                display: flex;
                justify-content: space-between
                align-items flex-end

                .item__update{
                    font-size: 40px;
                    color: green;

                    &:hover{
                        cursor: pointer
                    }
                }

                .item__end_wrap{
                    display: flex
                    flex-direction: column
                    align-items: flex-end

                    .item__end{
                        display: flex

                        .item__delete{
                            color: red;
                            margin-right: 10px
                        }

                        .item__done{
                            color: green
                        }
                    }
                }
            }

        }

        &__regular{
            display flex;
            justify-content: space-between
            height 30%;
            padding-bottom: 20px;
            border-bottom 3px solid #491D37;

            &-item{
                width 45%;
            }
        }

        &__flow{
            display flex;
            align-items: flex-start
            flex-wrap: wrap;

            height 70%;
            overflow-y: scroll;
            padding-top: 20px;

            &-item{
                width 30%;
                margin-bottom 10px

                .item__title{
                    font-size: 14px
                }
            }
        }
    }


</style>