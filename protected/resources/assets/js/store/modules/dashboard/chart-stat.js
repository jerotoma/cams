// initial state
const state = {
    clientRegistration: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'line'
            },
            noData: {
                text: 'Loading...',
            }
        },
        year: new Date().getFullYear(),
    },
    clientNeeds: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'pie'
            },
            noData: {
                height: 365,
                text: 'Loading...',
            }
        },
        dateRange: {
            startDate: null,
            endDate: null
        },
    },
    ageGroups: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'pie'
            },
            noData: {
                text: 'Loading...',
            }
        },
    },
    monthlyItemDistributions: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'bar'
            },
            noData: {
                text: 'Loading...',
            }
        },
        year: new Date().getFullYear(),
    },
    monthlyCashProvisions: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'bar'
            },
            noData: {
                text: 'Loading...',
            }
        },
        year: new Date().getFullYear(),
    },
    cases: {
        series: [],
        options: {
            chart: {
                height: 380,
                type: 'pie'
            },
            noData: {
                text: 'Loading...',
            }
        },
    },
    casesPerStatus: {
        series: [],
        options: {
            chart: {
                height: 365,
                type: 'bar'
            },
            noData: {
                text: 'Loading...',
            }
        },
        year: new Date().getFullYear(),
    },
  }

  // getters
  const getters = {
    clientNeeds: state => state.clientNeeds,
    ageGroups: state => state.ageGroups,
    monthlyItemDistributions: state => state.monthlyItemDistributions,
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
            commit('setMonthlyItemDistributions', data.monthlyItemDistributions);
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
    loadClientRegistrationByDateRange({ commit }, data) {
        axios({
            method: 'POST',
            url: '/rest/secured/dashboard/registered-clients/date-range',
            data: data
        })
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setClientRegistration', data.clientRegistration);
            commit('setAuthRole', data.authRole);
            commit('setAuthPermission', data.authPermission);
        }).catch((error) => {
            commit('setLoading', false);
            console.log(error);
        });
    },
    loadNFISDistributionByYear({ commit }, data){
        axios({
            method: 'POST',
            url: '/rest/secured/dashboard/nfis-distributions/year',
            data: data
        })
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setMonthlyItemDistributions', data.monthlyItemDistributions);
            commit('setAuthRole', data.authRole);
            commit('setAuthPermission', data.authPermission);
        }).catch((error) => {
            commit('setLoading', false);
            console.log(error);
        });
    },
    loadMonthlyCashProvisionByYear({ commit }, data){
        axios({
            method: 'POST',
            url: '/rest/secured/dashboard/cash-provisions/year',
            data: data
        }).then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setMonthlyCashProvisions', data.monthlyCashProvisions);
            commit('setAuthRole', data.authRole);
            commit('setAuthPermission', data.authPermission);
        }).catch((error) => {
            commit('setLoading', false);
            console.log(error);
        });
    },
    loadMonthlyAverageCaseByYear({ commit }, data){
        axios({
            method: 'POST',
            url: '/rest/secured/dashboard/cases/year',
            data: data
        }).then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setCasesPerStatus', data.casesPerStatus);
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
    setMonthlyItemDistributions (state, monthlyItemDistributions) {
      state.monthlyItemDistributions = monthlyItemDistributions;
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
