// initial state
const state = {
    homeAssessment: {

    },
    homeAssessments: [],
  }

  // getters
  const getters = {
      homeAssessments: state => state.homeAssessments,
      homeAssessment: state => state.homeAssessment,
      homeAssessmentsCount: state => state.homeAssessmentsCount,
  }

  // actions
  const actions = {
    getHomeAssessments ({ commit }, data) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({
                method: 'GET',
                url: '/rest/secured/assessments/home?page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            })
            .then((response) => {
                const data = response.data;
                commit('setLoading', false);
                commit('setHomeAssessments', data.homeAssessments.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    postHomeAssessment({ commit }, homeAssessment) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/assessments/home',
                data: homeAssessment
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    updateHomeAssessment({ commit }, homeAssessment) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/assessments/home',
                data: homeAssessment
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    deleteHomeAssessment({ commit }, homeAssessment) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'DELETE',
                url: '/rest/secured/assessments/home/' + homeAssessment.id,
                data: {}
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    searchHomeAssessmentWithPagination({ commit, dispatch }, data) {
        if (data.searchTerm) {
            axios({
                method: 'GET',
                url: '/rest/secured/assessments/home/search-paginated?searchTerm=' + data.searchTerm + '&page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            }).then((response) => {
                const data = response.data;
                commit('setHomeAssessments', data.homeAssessments.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
            }).catch((error) => {
                const resp = error.response;

            });
        } else {
            dispatch('getHomeAssessments', data);
        }
    },
    searchHomeAssessment({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'GET',
                url: '/rest/secured/assessments/home/search?searchTerm=' + data.searchTerm,
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    }
  }

  // mutations
  const mutations = {
    setHomeAssessment (state, homeAssessment) {
      state.homeAssessment = homeAssessment
    },
    setHomeAssessments (state, homeAssessments) {
        state.homeAssessments = homeAssessments
    },
    setHomeAssessmentsCount (state, count) {
      state.homeAssessmentsCount = count;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
