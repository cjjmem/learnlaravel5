<template>
    <div>
        <div class="img-code" @click="change"></div>
    </div>
</template>
<script>
    export default {
        methods: {
            change: function () {
                $.ajax({
                    url: "captcha-img", context: {}, success: function (d) {
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

</style>
