<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/users" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-users"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Users</div>
                                <div class="text-muted">{{usersCount}}</div>
                            </li>
                        </ul>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="new-visitors"></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/cases" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Cases</div>
                                <div class="text-muted">{{clientCasesCount}}</div>
                            </li>
                        </ul>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="new-sessions"></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/clients" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">PSN</div>
                                <div class="text-muted"> {{clientsCount}}</div>
                            </li>
                        </ul>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="total-online"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/referrals" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-calendar5"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Referrals</div>
                                <div class="text-muted"> {{clientReferralCount}}</div>
                            </li>
                        </ul>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="total-referral"></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/items/distributions" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-calendar52"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">NFI Distribution</div>
                                <div class="text-muted"> {{itemsDisbursementCount}}</div>
                            </li>
                        </ul>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="total-itemsDisbursementCount"></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="/assessments/vulnerability" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-cash3"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Assessed Clients</div>
                                <div class="text-muted"> {{vulnerabilityAssessmentCount}}</div>
                            </li>
                        </ul>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="content-group" id="total-vulnerabilityAssessmentCount"></div>
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
    name: 'counter-stat-component',
    computed: {
        ...mapGetters([
            'authRole',
            'authPermission',
            'isLoading',
            'vulnerabilityAssessmentCount',
            'itemsDisbursementCount',
            'clientReferralCount',
            'clientsCount',
            'clientCasesCount',
            'usersCount',
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
            this.$store.dispatch('loadCounterStats');
        }
    },
    created() {
        this.loadChartStats();
    },
}
</script>
<style scoped>

</style>
