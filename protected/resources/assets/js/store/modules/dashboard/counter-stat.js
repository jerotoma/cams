// initial state
const state = {
    vulnerabilityAssessmentCount: 0,
    itemsDisbursementCount: 0,
    clientReferralCount: 0,
    clientsCount: 0,
    clientCasesCount: 0,
    usersCount: 0,
    casesPerStatus: [],
  }

  // getters
  const getters = {
    itemsDisbursementCount: state => state.itemsDisbursementCount,
    clientReferralCount: state => state.clientReferralCount,
    clientsCount: state => state.clientsCount,
    clientCasesCount: state => state.clientCasesCount,
    usersCount: state => state.usersCount,
    vulnerabilityAssessmentCount: state => state.vulnerabilityAssessmentCount,
  }

  // actions
  const actions = {
    loadCounterStats ({ commit }, data) {
        commit('setLoading', true);
        axios({
            method: 'GET',
            url: '/rest/secured/dashboard/counter-stats',
        })
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setItemsDisbursementCount', data.itemsDisbursementCount);
            commit('setClientReferralCount', data.clientReferralCount);
            commit('setClientsCount', data.clientsCount);
            commit('setClientCasesCount', data.clientCasesCount );
            commit('setUsersCount', data.usersCount);
            commit('setVulnerabilityAssessmentCount', data.vulnerabilityAssessmentCount);
            commit('setAuthRole', data.authRole);
            commit('setAuthPermission', data.authPermission);
        }).catch((error) => {
            commit('setLoading', false);
            console.log(error);
        });
    },
  }

  // mutations
  const mutations = {
    setItemsDisbursementCount(state, itemsDisbursementCount) {
      state.itemsDisbursementCount = itemsDisbursementCount
    },
    setClientReferralCount(state, clientReferralCount) {
        state.clientReferralCount = clientReferralCount
    },
    setClientsCount (state, clientsCount) {
      state.clientsCount = clientsCount;
    },
    setClientCasesCount(state, clientCasesCount) {
        state.clientCasesCount = clientCasesCount;
    },
    setUsersCount(state, usersCount) {
        state.usersCount = usersCount;
    },
    setCasesPerStatus(state, casesPerStatus) {
        state.casesPerStatus = casesPerStatus;
    },
    setVulnerabilityAssessmentCount(state, vulnerabilityAssessmentCount) {
        state.vulnerabilityAssessmentCount = vulnerabilityAssessmentCount;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
