import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import client from './modules/client';
import vulnerabilityAssessment from './modules/assessments/vulnerability-assessment';
import homeAssessment from './modules/assessments/home-assessment';
import referral from './modules/referral';
import itemCategory from './modules/inventories/item-category';
import itemReceived from './modules/inventories/item-received';
import itemDistribution from './modules/inventories/item-distribution';
import itemInventory from './modules/inventories/item-inventory';

import chartStat from "./modules/dashboard/chart-stat";
import counterStat from "./modules/dashboard/counter-stat";


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        client,
        homeAssessment,
        vulnerabilityAssessment,
        referral,
        counterStat,
        chartStat,
        itemCategory,
        itemDistribution,
        itemInventory,
        itemReceived
    },
    state,
    getters,
    mutations,
    actions,
})
