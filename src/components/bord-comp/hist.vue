<template>

    <div class="hist">

        <video autoplay muted loop id="myVideo">
            <source src="../../img/hist.mp4" type="video/mp4">
        </video>

        <div class="hist__filter">
            <ul class="hist__filter-item" v-for="item in filters" v-bind:class="{open: item.open}">
                <li @click="selectListItem(item, item.value[index], $event)" v-for="(data, index) in item.data">{{data}}</li>
                <div class="hist__filter-btn" @click="item.open = !item.open"></div>
            </ul>
            <div class="hist__filter-item date-picker">
                <p>От</p>
                <input v-model="searchData.date.from" class="date-from" placeholder="2018-05-12">
                <p>До</p>
                <input v-model="searchData.date.to" class="date-to" v-bind:placeholder="today">
            </div>
            <div class="hist__filter-find" @click="findTasks">Применить</div>
        </div>

        <div class="hist__list">
            <div class="hist__task" v-if="!noResult" v-for="task in tasks" v-bind:style="task.background">
                <div class="task__top">
                    <div class="task__title">{{task.title}}</div>
                    <div class="task__count">{{task.count}}</div>
                </div>
                <div class="task__date">
                    <p>Дата создания: {{task.date}}</p>
                </div>
            </div>
            <div class="hist__noResult" v-show="noResult">{{noResult}}</div>
        </div>

    </div>

</template>

<script>
    import $ from 'jquery';
    import axios from 'axios';
    import moment from 'moment';

    export default {
        data(){
            return{
                filters: [
                    {
                        data: [
                            'Все',
                            'Не выполненные',
                            'Выполненные'
                        ],
                        value: [
                            '',
                            "null",
                            "true"
                        ],
                        open: false,
                        name: 'done'
                    },
                    {
                        data: [
                            'Все',
                            'Рома',
                            'Тоха'
                        ],
                        value: [
                            '',
                            'Рома',
                            'Тоха'
                        ],
                        open: false,
                        name: 'author'
                    }
                ],
                searchData: {
                    author: '',
                    done: '',
                    date: {
                        from: '',
                        to: ''
                    }
                },
                today: '',
                tasks: [],
                noResult: ''
            }
        },
        methods: {
            selectListItem(item, value, e){
                let list = $(e.target).parent(".hist__filter-item");
                list.children("li").removeClass("active");
                $(e.target).addClass("active");
                item.open = !item.open;

                let name = item.name;
                this.searchData[name] = value;
            },
            findTasks(){
                console.log(this.searchData);
                axios.post(`req.php`, {
                    data: this.searchData,
                    target: 'findTasks'
                }).then(response => {
                    console.log(response);
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
                            task.background = 'background: linear-gradient(rgba(0,66,0,0.7), rgba(0,0,0,0.2))'
                        }else{
                            task.background = 'background: linear-gradient(rgba(127,68,0,0.7), rgba(0,0,0,0.2))'
                        }

                        data.push(task);

                    });

                    this.tasks = data;

                    if(this.tasks.length == 0){
                        this.noResult = "Результатов не найдено"
                    }else{
                        this.noResult = ""
                    }
                })
            }
        },
        created() {
            this.findTasks();
            this.today = moment().format('YYYY-MM-DD');
        }
    }
</script>

<style lang="stylus">

    .hist{
        display flex
        flex-direction column
        align-items center

        &__filter{
            display: flex;

            width: 90%;
            min-height: 60px;
            max-height 60px

            padding: 10px 30px;
            padding-right: 100px;
            margin-bottom: 50px;

            position: relative

            border-radius: 10px;
            border: 2px solid #000;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.3));

            &-item{
                display: flex
                flex-direction column

                height: 38px;
                width 300px

                padding: 0 20px
                margin: 0
                margin-right 20px
                overflow hidden

                position: relative

                color #fff
                border-radius 10px
                border 1px solid #DDDDDD

                li{
                    list-style none
                    font-size: 20px;
                    line-height 38px;
                    height: 38px

                    order 1

                    &.active{
                        order 0
                    }
                }

                &.date-picker{
                    flex-direction row
                    justify-content: space-between
                    align-items center

                    & input{
                        width: 34%;
                        padding-left: 5px;
                        margin-left: -15px;
                    }
                }

                &.open{
                    height: 100%;
                }
            }

            &-btn{
                position: absolute;
                top: 11px;
                right: 10px;

                width: 15px;
                height: 15px;

                background-color: #fff;
                border-radius: 5px;

                &:hover{
                    cursor pointer
                }
            }

            &-find{
                position: absolute;
                top: 15px;
                right: 13px;

                color #fff
                font-size: 18px;

                &:hover{
                    cursor pointer
                }
            }
        }

        &__list{
            display: flex
            flex-direction: column

            width 40%
        }

        &__task {

            height 100%;
            padding 15px;
            border-radius 10px;
            margin-bottom: 30px

            border 1px solid #000
            color: #FFFFC7;

            .task__top {
                display flex
                justify-content: flex-end
                align-items: flex-start
                font-size 25px
                margin-bottom: 10px;
                padding-bottom: 15px;
                border-bottom: 1px solid #fff;

                position: relative

                .task__count {
                    padding: 0 5px;
                }

                .task__title {
                    width: 80%
                    height 30px
                    position: absolute;
                    top: 0;
                    left: 0;
                    text-overflow: ellipsis;
                    overflow: hidden
                }
            }
        }

    }

</style>