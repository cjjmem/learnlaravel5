<template>
    <div>
        <div class="img-code cursor" @click="change" title="点击更新验证码"></div>
    </div>
</template>
<script>
    export default {
        methods: {
            change: function () {
                $.ajax({
                    url: "http://localhost:8000/captcha-img", context: {}, success: function (d) {
                        $('.img-code').html(d);
                    }
                });
            }
        },
        ready() {
            this.change()
        }
    }
</script>

<style>
    .img-code{
        cursor: pointer;
    }
    .img-code img {
        width: 110px;
    }
</style>
