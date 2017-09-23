<template>
    <div>
        <button v-if="boxer.promoter_id == game" class="button is-black" @click.prevent="cut">Cut</button>
    </div>
</template>

<script>
    import messages from '../mixins/messages';

    export default {
        props: ['boxer', 'game'],

        mixins: [messages],

        methods: {
            cut() {
                var url = '/boxers/' + this.boxer.id + '/cut';
                axios.post(url);
                flash('Terminated', this.boxer.name + this.fire[Math.floor(Math.random() * this.fire.length)], 'info');
            }
        }
    }
</script>