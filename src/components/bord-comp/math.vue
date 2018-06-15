<template>

    <div class="math">

        <video autoplay muted loop id="myVideo">
            <source src="../../img/math.mp4" type="video/mp4">
        </video>

        <div class="math__graph_wrap">
            <div class="graph">
                <div class="graph__count-label">
                    <span v-for="count in dataLength">{{count}}</span>
                </div>
                <div class="graph__coll" v-for="coll in graphData">
                    <div class="graph__point" :style="coll.count"></div>
                    <div class="graph__line" :style="coll.coorForLine"></div>
                    <div class="graph__date-label">{{coll.date}}</div>
                    <div class="graph__row" v-for="row in dataLength"></div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import $ from 'jquery';
    import axios from 'axios';
    // .testLine{
    //     width 300px
    //     border 1px solid #000
    //     transform rotate(10deg)
    //     transform-origin left center
    // }

    export default {
        data(){
            return{
                graphData: [],
                dataLength: [],
                coors: [],
                graphSize: {
                    x: 900,
                    y: 400,
                    cellX: 0,
                    cellY: 0
                }
            }
        },
        methods: {
            getData(){
                axios.post(`req.php`, {
                    target: 'getData'
                }).then(response => {
                    let res = response.data;
                    this.graphData = res;

                    console.log(res);

                    this.fillGraph();
                });
            },
            fillGraph(){
                this.findMax();
                this.addCoor();
                this.createLines()
            },
            findMax(){
                let array = [];
                let max = 0;
                this.graphData.forEach(function (item) {
                    if(max < item.count){
                        max = item.count
                    }
                });
                for(let i = 0; i < max; i++){
                    array.push(i + 1)
                }
                this.dataLength = array;
            },
            addCoor(){
                this.graphSize.cellY = this.graphSize.y/this.dataLength.length;
                let step = this.graphSize.cellY;

                this.graphSize.cellX = this.graphSize.x/this.graphData.length;

                let coors = [];
                this.graphData.forEach(function (item) {
                    let coor = item.count * step;
                    coor--;
                    coors.push(item.count);
                    item.count = `bottom: ${coor}px`;
                });
                this.coors = coors;
            },
            createLines(){
                let coorsForLines = [];
                let graphSize = this.graphSize;
                this.coors.forEach(function (item, i, arr) {
                    if(!isNaN(item)) {
                        if (i !== 0) {
                            let startCoor = arr[i - 1] * graphSize.cellY;
                            let lastCoor = arr[i] * graphSize.cellY;
                            let diff = startCoor - lastCoor;
                            let angle = (Math.atan(diff / graphSize.cellX) * 180) / Math.PI;
                            let hypo = Math.pow(diff,2) + Math.pow(graphSize.cellX,2);
                            let width = Math.sqrt(hypo);
                            let coorForLine = `bottom: ${startCoor}px; transform: rotate(${angle}deg); width: ${width}px;`;
                            coorsForLines.push(coorForLine)
                        } else {
                            let coorForLine = `bottom: 0px; width: 0;`;
                            coorsForLines.push(coorForLine)
                        }
                    }
                });
                this.graphData.forEach(function (item, i, arr) {
                    item.coorForLine = coorsForLines[i]
                });
            }
        },
        created: function(){
            this.getData()
        }
    }
</script>

<style lang="stylus">

    .math{
        display flex

        &__graph_wrap{
            display: flex
            justify-content: center;
            align-items center

            width 100%

            .graph{
                display flex
                height: 400px;
                width: 900px;
                position: relative

                &__coll{
                    position: relative
                    flex-grow 1

                    display: flex
                    flex-direction column

                    &:last-child .graph__row{
                        border-right: none
                    }

                    .graph__row{
                        flex-grow 1
                        border-right .5px solid #fff
                        border-bottom .5px solid #fff

                        &:last-child{
                            border-bottom: none
                        }
                    }
                }

                &__point{
                    position: absolute
                    right: -5px
                    bottom: -5px
                    z-index: 1

                    transform: translateY(4px);

                    width: 10px;
                    height: 10px
                    border-radius 50%
                    background-color: #FFBF00
                }

                &__line{
                    position: absolute
                    left: 0;

                    transform-origin left center

                    border 1px solid #000;
                }

                &__date-label{
                    position: absolute;
                    width: 100%;
                    bottom: -33px;

                    text-align center
                    padding-top: 3px;
                    font-size: 12px;
                    color: #fff
                }

                &__count-label{
                    position: absolute;
                    width: 30px
                    height 100%
                    top: 0
                    left: -30px

                    display: flex
                    flex-direction column-reverse
                    justify-content: space-between

                    span{
                        display: block
                        color: #fff
                        font-size: 10px
                    }
                }
            }
        }
    }

</style>