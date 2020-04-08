import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import client from './modules/client';
import vulnerabilityAssessment from './modules/vulnerability-assessment';
import referral from './modules/referral';
import chartStat from "./modules/dashboard/chart-stat";
import counterStat from "./modules/dashboard/counter-stat";


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        client,
        vulnerabilityAssessment,
        referral,
        counterStat,
        chartStat
    },
    state,
    getters,
    mutations,
    actions,
})
