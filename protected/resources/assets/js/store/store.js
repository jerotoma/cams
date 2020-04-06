import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import client from './modules/client';
import vulnerabilityAssessment from './modules/vulnerability-assessment';
import referral from './modules/referral';


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        client,
        vulnerabilityAssessment,
        referral
    },
    state,
    getters,
    mutations,
    actions,
})
