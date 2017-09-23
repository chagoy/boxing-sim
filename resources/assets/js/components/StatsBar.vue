<template>
    <div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.overall + '%'}" aria-valuenow="{ boxer.overall }" aria-valuemin="0" aria-valuemax="100">Overall:  {{ boxer.overall }}</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.power + '%'}" aria-valuenow="{ boxer.power }" aria-valuemin="0" aria-valuemax="100">Power:  {{ boxer.power }}</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.speed + '%'}" aria-valuenow="{ boxer.speed }" aria-valuemin="0" aria-valuemax="100">Speed:  {{ boxer.speed }}</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.offense + '%'}" aria-valuenow="{ boxer.offense }" aria-valuemin="0" aria-valuemax="100">Offense:  {{ boxer.offense }}</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.defense + '%'}" aria-valuenow="{ boxer.defense }" aria-valuemin="0" aria-valuemax="100">Defense:  {{ boxer.defense }}</div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-dark" role="progressbar" v-bind:style="{ width: boxer.popularity + '%'}" aria-valuenow="{ boxer.popularity }" aria-valuemin="0" aria-valuemax="100">Popularity:  {{ boxer.popularity }}</div>
        </div>
        <div v-if="boxer.promoter_id === 1">
            <el-button type="primary" @click="check">Upgrade</el-button>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['boxer', 'funds'],

        methods: {
            check() {
                if (this.funds > 500000) {
                    this.upgrade();
                } else {
                    flash('Failure', 'You do not have enough funds to upgrade a fighter. Try earning some money by putting on cards people want to watch', 'danger')
                }
            },

            upgrade() {
                var url = '/api/boxers/upgrade/' + this.boxer.id;
                axios.post(url);
                flash('Success', 'You have upgraded this boxer', 'success')
            }
        }
    }
</script>

<style>
    .bg-dark {
        background-color: #475669;
    }
</style>