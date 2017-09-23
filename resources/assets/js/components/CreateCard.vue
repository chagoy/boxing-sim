<template>
    <div>
        <div class="form-group">
            <span class="demonstration">Date</span>
            <el-date-picker
                v-model="date"
                type="date"
                placeholder="Pick a day">
            </el-date-picker>
        </div>
        <div class="form-group">
            <el-select v-model="network" placeholder="Network">
                <el-option
                        v-for="network in networks"
                        :key="network.id"
                        :label="network.name"
                        :value="network.id">
                </el-option>
            </el-select>
            <p class="text-muted" v-if="network">Networks influence the amount of money earned, but not all networks are interested in your fights.</p>
        </div>
        <div class="form-group">
            <el-select v-model="venue" placeholder="Venue">
                <el-option
                        v-for="location in locations"
                        :key="location.id"
                        :label="location.venue"
                        :value="location.id">
                </el-option>
            </el-select>
            <p class="text-muted" v-if="venue"><strong>Capacity: {{ this.getL.capacity }}</strong> Some venues may not want to hold your event if it is too small. Smaller venues will not generate much revenue or attendance.</p>
        </div>

        <div class="form-group">
            <el-input placeholder="Headline for your card. This will help it trend on Twitter" v-model="headline"></el-input>
        </div>

        <el-select @change="others" v-model="a_side" placeholder="Headliner">
            <el-option
                v-for="boxer in userboxers"
                :key="boxer.id"
                :label="boxer.name"
                :value="boxer.id">
            </el-option>
        </el-select>
        <p class="help" v-if="a_side">Division: {{ this.getA.division }} Record: {{ this.getA.win }}-{{ this.getA.loss}}-{{this.getA.draws }}, {{ this.getA.knockouts }} KOs. Current rating: {{ this.getA.overall }} Current: popularity: {{ this.getA.popularity }}</p>

        <el-select v-loading.body="loading" v-model="b_side" placeholder="Opponent">
            <el-option
                v-for="boxer in opponents"
                :key="boxer.id"
                :label="boxer.name"
                :value="boxer.id">
            </el-option>
        </el-select>
        <p class="text-muted" v-show="loading">Opponents generated after Headliner is chosen.</p>
        <p class="help" v-if="b_side">Division: {{ this.getB.division }} Record: {{ this.getB.win }}-{{ this.getB.loss}}-{{this.getB.draws }}, {{ this.getB.knockouts }} KOs. Current rating: {{ this.getB.overall }} Current popularity: {{ this.getB.popularity }}</p>

        <el-button type="primary" @click.prevent="division">Submit</el-button>
    </div>
</template>

<script>
    export default {
        components: { flash },

        props: ['networks', 'userboxers', 'boxers', 'locations'],

        data() {
            return {
                network: '',
                headline: '',
                venue: '',
                a_side: '',
                b_side: '',
                date: '',
                opponents: '',
                loading: true,
            }
        },

        computed: {
            getA: function () {
                return _.find(this.userboxers, ['id', this.a_side]);
            },

            getB: function () {
                return _.find(this.boxers, ['id', this.b_side]);
            },

            getN: function() {
                return _.find(this.networks, ['id', this.network]);
            },

            getL: function() {
                return _.find(this.locations, ['id', this.venue])
            }
        },

        methods: {
            others() {
                this.loading = false;
                return this.opponents = _.filter(this.boxers, ['division', this.getA.division])
            },

            rating(a) {
                return Math.round((a.power + a.speed + a.offense + a.defense + a.stamina + a.chin) / 6);
            },

            same() {
                if (this.a_side === this.b_side) {
                    flash('Error!', 'This fight can\'t be made!', 'error')
                } else this.division();
            },

            division() {
                if (this.getA.division !== this.getB.division) {
                    return flash('These fighters are not in the same weight class');
                } else this.popular();
            },

            popular() {
                if (this.getA.popularity - this.getB.popularity > 30) {
                    return flash('Rejected!', this.getA.name + ' has rejected this fight. "' + this.getB.name + ' is not a big enough draw to face me.', 'error');
                } else if (this.getB.popularity - this.getA.popularity > 30) {
                    return flash('Rejected!', this.getB.name + ' has rejected this fight. "' + this.getA.name + ' is not a big enough draw to face me.', 'error');
                } else {
                    return this.tv();
                }
            },

            tv() {
                if (((this.getA.popularity + this.getB.popularity) / 2) < this.getN.popularity) {
                return flash('Not interested!', this.getN.name + ' is not interested in this fight!', 'error');
                } else {
                    return this.location();
                }
            },

            location() {
                if ((this.getA.popularity + this.getB.popularity) / 2 < this.getL.popularity) {
                    flash('Denied!', this.getL.venue + ' has rejected hosting the fight due to WWE being in town.', 'error')
                } else {
                    this.overall(this.getA, this.getB);
                }
            },

            overall(a, b) {
                if (this.rating(a) - this.rating(b) > 35) {
                    return flash('Opponent rejected!', a.name + '\'s camp has rejected this fight. "' + b.name + ' is a fucking bum!"', 'error');
                } else if (this.rating(b) - this.rating(a) > 35) {
                    return flash('Opponent rejected!', b.name + '\'s camp has rejected this fight. "' + a.name + ' is a fucking bum!"', 'error');
                } else {
                    return this.sign()
                }
            },

            reset() {
                this.network = '',
                this.headline = '',
                this.a_side = '',
                this.b_side = ''
            },

            sign() {
                if (this.a_side === '' || this.b_side === '') {
                    flash('A fight requires 2 fighters!')
                } else {
                    axios.post('/create', {
                        network: this.network,
                        headline: this.headline,
                        location: this.venue,
                        a_side: this.a_side,
                        b_side: this.b_side,
                        date: this.date
                    }).then(({data}) => {
                        flash('Fight signed!', this.getA.name + ' and ' + this.getB.name + ' have agreed to terms on a fight!', 'success');
                        this.reset();
                    });
                }
            }
        }
    }
</script>