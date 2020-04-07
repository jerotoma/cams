<template>
    <div class="row">
        <div class="col-md-12">
             <div class="row" style="margin-top: 10px">
                <div class="col-md-12">
                    <div style="min-width: 310px; height: 400px; margin: 0 auto" id="clientRegistration"></div>
                </div>
            </div>
             <div class="row" style="margin-top: 10px">
                <div class="col-md-8">
                    <div style="min-width: 410px; height: 500px; margin: 0 auto" id="clientsNeeds">

                    </div>
                </div>
                <div class="col-md-4">
                    <div style="min-width: 410px; height: 500px; margin: 0 auto" id="ageGroup">

                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div style="min-width: 310px; height: 500px; margin: 0 auto" id="monthlyNfisDistributions">

                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div style="min-width: 310px; height: 500px; margin: 0 auto" id="monthlyCashProvisions">

                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                    <div style="min-width: 310px; height: 400px; margin: 0 auto" id="cases">

                    </div>
                </div>
                <div class="col-md-6">
                    <div style="min-width: 310px; height: 400px; margin: 0 auto" id="casesPerStatus">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    name: 'chart-stat-component',
    computed: {
        ...mapGetters([
            'authRole',
            'authPermission',
            'isLoading',
            'pagination',
        ]),
        mLoading: {
            get() { return this.isLoading; },
            set(value){
                this.$store.commit('setLoading', value);
            }
        }
    },
    data() {
        return {

        }
    },
    methods: {
        loadChartStats() {
            this.$store.dispatch('loadChartStats');
        }
    },
    created() {
        this.loadChartStats();
    },
}
</script>
<style scoped>

</style>
