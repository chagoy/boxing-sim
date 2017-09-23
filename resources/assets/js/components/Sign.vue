<template>
    <div>
        <button class="button is-black" v-show="! discuss" @click.prevent="negotiate">Begin Negotiation</button>

        <div v-show="discuss">
            <div class="field">
                <label for="length" class="label">How many fights?</label>
                <div class="select">
                    <select class="form-control" id="length" value="0" v-model="fights">
                        <option v-bind:value="1">1</option>
                        <option v-bind:value="2">2</option>
                        <option v-bind:value="3">3</option>
                        <option v-bind:value="4">4</option>
                        <option v-bind:value="5">5</option>
                        <option v-bind:value="6">6</option>
                        <option v-bind:value="7">7</option>
                        <option v-bind:value="8">8</option>
                    </select>
                </div>
            </div>


          <div class="field has-addons">
                <p class="control">
                    <a class="button is-static">$</a>
                </p>
                <p class="control">
                    <input type="number" v-model.number="money" class="input" value="0" placeholder="Total amount">
                </p>
            </div>

            <div class="field">
                <div class="control">
                    <button v-if="boxer.promoter_id !== game" class="button is-black" @click.prevent="review">Sign!</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import messages from '../mixins/messages';

    export default {
        props: ['boxer', 'game', 'funds'],

        mixins: [messages],

        data() {
            return {
                discuss: false,
                fights: 0,
                money: 0
            }
        },

        computed: {
            cost: function () {
                var x = numeral(this.boxer.cost);
                return x.value();
            }
        },

        methods: {
            negotiate() {
                this.discuss = true;
                flash('A note from ' + this.boxer.name, 'I am expecting somewhere in the neighborhood of $'+ this.numberWithCommas(this. cost * 1.5) + ' per fight. You do the math.', 'info');
            },

            review() {
                if (this.fights > 5 && (this.money / this.fights < (this.cost * 1.5))) {
                    flash('Bad move', this.boxer.name + this.rejection[Math.floor(Math.random() * this.rejection.length)], 'error');
                } else if (this.fights === 8 && (this.money / this.fights < this.cost * 1.7 && this.boxer.potential > 80)) {
                    flash('Rejected!', this.boxer.name + this.rejection[Math.floor(Math.random() * this.rejection.length)], 'error');
                } else if (this.money / this.fights < this.cost * 0.8 || this.money < 500000) {
                    flash('Unacceptable offer!', this.boxer.name + this.rejection[Math.floor(Math.random() * this.rejection.length)], 'error');
                } else {
                    this.sign();
                }
            },

            sign() {
                var url = '/' + this.game + '/boxers/sign/' + this.boxer.id;
                if (this.money > this.funds) {
                    flash('Uh-oh', this.boxer.name + this.overdraft[Math.floor(Math.random() * this.overdraft.length)], 'error')
                } else {
                    axios.post(url, { money: this.money, contract: this.fights });
                    this.discuss = false;
                    flash('Congratulations!', this.boxer.name + this.signing[Math.floor(Math.random() * this.signing.length)], 'info');
                }
            },

            numberWithCommas(x) {
                var parts = x.toString().split(".");
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return parts.join(".");
            },
        }
    }
</script>