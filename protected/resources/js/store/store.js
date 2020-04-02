import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import getters from './getters';
import actions from './actions';

import client from './modules/client';


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        client
    },
    state,
    getters,
    mutations,
    actions,
})
