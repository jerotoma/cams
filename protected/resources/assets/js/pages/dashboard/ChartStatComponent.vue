<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Monthly Client Registration for year
                        </div>
                        <div class="panel-body">
                            <div id="clientRegistration" v-if="clientRegistration && clientRegistration.series">
                                <apexchart width="100%" height="400"  type="line" :options="clientRegistration.options" :series="clientRegistration.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Clients registered & their vulnerabilities
                        </div>
                        <div class="panel-body">
                            <div id="clientsNeeds" v-if="clientNeeds && clientNeeds.series">
                                <apexchart width="100%" height="350" type="pie" :options="clientNeeds.options" :series="clientNeeds.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Client Distribution Age Groups
                        </div>
                        <div class="panel-body">
                            <div id="ageGroup" v-if="ageGroups && ageGroups.series">
                                <apexchart width="100%" height="350" type="pie" :options="ageGroups.options" :series="ageGroups.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Monthly NFIS Distributions
                        </div>
                        <div class="panel-body">
                            <div id="monthlyNfisDistributions" v-if="monthlyItemDistributions&& monthlyItemDistributions.series">
                                <apexchart width="100%" height="400" type="bar" :options="monthlyItemDistributions.options" :series="monthlyItemDistributions.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Monthly Cash Distribution
                        </div>
                        <div class="panel-body">
                             <div v-if="monthlyCashProvisions && monthlyCashProvisions.series">
                                  <apexchart width="100%" height="400" type="bar" :options="monthlyCashProvisions.options" :series="monthlyCashProvisions.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Client Distribution Age groups
                        </div>
                        <div class="panel-body">
                             <div id="cases" v-if="clientNeeds && clientNeeds.series">
                                <apexchart width="100%" height="400" type="pie" :options="ageGroups.options" :series="ageGroups.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Client Distribution Age groups
                        </div>
                        <div class="panel-body">
                            <div id="casesPerStatus" v-if="clientNeeds && clientNeeds.series">
                                <apexchart width="100%" height="400" type="pie" :options="ageGroups.options" :series="ageGroups.series"></apexchart>
                            </div>
                        </div>
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
            'ageGroups',
            'clientNeeds',
            'monthlyCashProvisions',
            'monthlyItemDistributions',
            'clientRegistration'
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
