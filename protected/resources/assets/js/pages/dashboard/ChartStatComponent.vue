<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            Registered Clients by thier age group from
                            <button
                                type="button"
                                class="btn btn-sm btn-primary pull-right change-report-range"
                                @click="toggleReportDateRange">
                                    {{ hideReportDateRange ? 'Show Date Range Form': 'Hide Date Range Form' }}
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="row" v-bind:class="{ hidden: hideReportDateRange }">
                                <div class="col-md-3">
                                    <div class="text-right">Select Report Range</div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">From:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <datepicker
                                                input-class='form-control'
                                                @selected="getSelectedStartDate"
                                                v-model="clientRegistered.from">
                                            </datepicker>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">To:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <datepicker
                                                input-class='form-control'
                                                @selected="getSelectedEndDate"
                                                v-model="clientRegistered.to">
                                            </datepicker>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                        <label for="email"></label>
                                        <div class="input-group retrieve-btn">
                                           <button type="button" @click="loadClientRegistrationByDateRange()" class="btn btn-sm btn-success">Retrieve Report</button>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="clientRegistration" v-if="clientRegistration && clientRegistration.series">
                                        <apexchart width="100%" height="400"  type="line" :options="clientRegistration.options" :series="clientRegistration.series"></apexchart>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
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
                            <div class="row">
                                <div class="col-md-9">
                                     Monthly NFIS Distributions
                                </div>
                                <div class="col-md-3">
                                   <label class="pull-right">
                                        Generate by year
                                        <select v-model="nfisDistributionYear" @change="loadNFISDistributionByYear" id="nfisDistribution">
                                            <option v-for="(year, index) in $dateUtil.generatePassedYears(2000)" :value="year" :key="index">{{year}}</option>
                                        </select>
                                   </label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="monthlyNfisDistributions" v-if="monthlyItemDistributions && monthlyItemDistributions.series">
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
                            <div class="row">
                                <div class="col-md-9">
                                    Monthly Cash Provisions
                                </div>
                                <div class="col-md-3">
                                   <label class="pull-right">
                                        Generate by year
                                        <select v-model="monthlyCashProvision" @change="loadMonthlyCashProvisionByYear" id="monthlyCashProvision">
                                            <option v-for="(year, index) in $dateUtil.generatePassedYears(2000)" :value="year" :key="index">{{year}}</option>
                                        </select>
                                   </label>
                                </div>
                            </div>
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
                            CBR Case status
                        </div>
                        <div class="panel-body">
                             <div id="cases" v-if="cases && cases.series">
                                <apexchart width="100%" height="365" type="pie" :options="cases.options" :series="cases.series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading text-primary">
                            <div class="row">
                                <div class="col-md-8">
                                    Monthly Average Cases
                                </div>
                                <div class="col-md-4">
                                   <label class="pull-right">
                                        Generate by year
                                        <select v-model="monthlyAverageCase" @change="loadMonthlyAverageCaseByYear" id="monthlyAverageCase">
                                            <option v-for="(year, index) in $dateUtil.generatePassedYears(2000)" :value="year" :key="index">{{year}}</option>
                                        </select>
                                   </label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="casesPerStatus" v-if="casesPerStatus && casesPerStatus.series">
                                <apexchart width="100%" height="365" type="bar" :options="casesPerStatus.options" :series="casesPerStatus.series"></apexchart>
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
import Datepicker from 'vuejs-datepicker';

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
            'clientRegistration',
            'cases',
            'casesPerStatus'
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
            hideReportDateRange: true,
            clientRegistered: {
                startDate: null,
                endDate: null,
            },
            nfisDistributionYear: new Date().getFullYear(),
            monthlyCashProvision: new Date().getFullYear(),
            monthlyAverageCase: new Date().getFullYear(),
        }
    },
    components: {
        Datepicker
    },
    methods: {
        loadChartStats() {
            this.$store.dispatch('loadChartStats');
        },
        getSelectedStartDate(e) {
            console.log(e);
        },
        getSelectedEndDate(e) {
            console.log(e);
        },
        toggleReportDateRange() {
            this.hideReportDateRange = !this.hideReportDateRange;
        },
        loadClientRegistrationByDateRange() {
            if (this.clientRegistered.from && this.clientRegistered.to) {
                var data = {
                    startDate: this.$moment(this.clientRegistered.from).format('YYYY-MM-DD'),
                    endDate: this.$moment(this.clientRegistered.to).format('YYYY-MM-DD')
                };
                this.$store.dispatch('loadClientRegistrationByDateRange', data);
            }
        },
        loadNFISDistributionByYear(e){
            this.nfisDistributionYear = e.target.value;
             var data = {
                year: this.nfisDistributionYear
            };
            this.$store.dispatch('loadNFISDistributionByYear', data);
        },
        loadMonthlyCashProvisionByYear(e){
            this.monthlyCashProvision = e.target.value;
             var data = {
                year: this.monthlyCashProvision
            };
            this.$store.dispatch('loadMonthlyCashProvisionByYear', data);
        },
        loadMonthlyAverageCaseByYear(e){
            this.monthlyAverageCase = e.target.value;
             var data = {
                year: this.monthlyAverageCase
            };
            this.$store.dispatch('loadMonthlyAverageCaseByYear', data);
        },
    },
    created() {
        this.loadChartStats();
    },
}
</script>
<style scoped>
    .retrieve-btn {
        top: 8px;
    }
    .change-report-range {
        bottom: 5px;
    }
    label {
        margin-bottom: 0;
    }
</style>
