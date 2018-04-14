<template>

    <div class="menu">
        <div class="menu__top">

            <div class="menu__logo">
                <a href=""><img src="" alt="logo"></a>
            </div>
            <div class="menu__score">
                <div class="menu__score-total">913</div>
                <div class="menu__score-average">9,87</div>
            </div>
            <div class="menu__logout">
                <img src="../img/logout.svg" alt="">
            </div>

        </div>

        <div class="menu__left">

            <ul class="menu__nav">
                <li>Менеджер</li>
                <li>Математик</li>
                <li>Историк</li>
                <li>Стратег</li>
            </ul>

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

<style lang="stylus" rel="stylesheet/stylus">

    .menu{
        position: fixed;
        top: 0;
        left: 0;

        &__top{
            position: relative;
            z-index: 10;

            height: 50px;
            width: 100vw;

            background: linear-gradient(to bottom, #5B1554, #41153C);
            box-shadow: 0 0 6px 1px #000000;

            display: flex;
            justify-content space-between;
            align-items center;

            padding: 0 10px;
        }

        &__left{
            position: relative;

            height: 100vh;
            width: 150px;

            //background-color: #41153C;
            background: linear-gradient(to right, #5B1554, #41153C);
            box-shadow: 0 5px 6px 1px #000000;

        }

        &__score div{
            display: inline-block;
            height 100%;
            padding 0 10px;
            color white;

            &:first-of-type{
                border-right 1px solid
            }
        }

        &__logout img{
            margin-top 8px;
            width: 40px;
            height: 40px;
        }

        &__nav{
            margin: 0;
            padding: 40px 0 0 10px;

            list-style none;

            li{
                margin: 10px;
                color: white;

                &:hover{
                    cursor: pointer;
                }
            }

        }

    }

</style>