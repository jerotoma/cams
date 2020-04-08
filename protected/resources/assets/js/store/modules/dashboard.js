// initial state
const state = {
    clientRegistration: [],
    clientNeeds: [],
    ageGroups: [],
    monthlyNfisDistributions: [],
    monthlyCashProvisions: [],
    cases: [],
    casesPerStatus: [],
  }

  // getters
  const getters = {
    clientNeeds: state => state.clientNeeds,
    ageGroups: state => state.ageGroups,
    monthlyNfisDistributions: state => state.monthlyNfisDistributions,
    monthlyCashProvisions: state => state.monthlyCashProvisions,
    cases: state => state.cases,
    casesPerStatus: state => state.casesPerStatus,
    clientRegistration: state => state.clientRegistration,
  }

  // actions
  const actions = {
    loadChartStats ({ commit }, data) {
        commit('setLoading', true);
        axios({
            method: 'GET',
            url: '/rest/secured/dashboard/chart-stats',
        })
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setClientNeeds', data.clientNeeds);
            commit('setAgeGroups', data.ageGroups);
            commit('setMonthlyNfisDistributions', data.monthlyNfisDistributions);
            commit('setMonthlyCashProvisions', data.monthlyCashProvisions );
            commit('setCases', data.cases);
            commit('setCasesPerStatus', data.casesPerStatus);
            commit('setClientRegistration', data.clientRegistration);
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
    setClientNeeds(state, clientNeeds) {
      state.clientNeeds = clientNeeds
    },
    setAgeGroups(state, ageGroups) {
        state.ageGroups = ageGroups
    },
    setMonthlyNfisDistributions (state, monthlyNfisDistributions) {
      state.monthlyNfisDistributions = monthlyNfisDistributions;
    },
    setMonthlyCashProvisions(state, monthlyCashProvisions) {
        state.monthlyCashProvisions = monthlyCashProvisions;
    },
    setCases(state, cases) {
        state.cases = cases;
    },
    setCasesPerStatus(state, casesPerStatus) {
        state.casesPerStatus = casesPerStatus;
    },
    setClientRegistration(state, clientRegistration) {
        state.clientRegistration = clientRegistration;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
