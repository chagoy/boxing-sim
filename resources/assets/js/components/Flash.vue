<template>
    <el-alert
            class="flash-msg"
            v-show="this.show"
            :title=this.title
            :type=this.type
            :description=this.description>
    </el-alert>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                title: 'Alert',
                description: this.message,
                type: 'info',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on(
                'flash', message => this.flash(message)
            );
        },

        methods: {
            flash(message) {
                if (message) {
                    this.title = message.title;
                    this.description = message.description;
                    this.type = message.type;
                }
            
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 5000);
            }
        }
    }
</script>

<style>
    .flash-msg {
        position: fixed;
        right: 0px;
        bottom: 0px;
    }
</style>