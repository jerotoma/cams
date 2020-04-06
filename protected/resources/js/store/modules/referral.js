// initial state
const state = {
    referral: {

    },
    referrals: [],
  }

  // getters
  const getters = {
      referrals: state => state.referrals,
      referral: state => state.referral,
      referralsCount: state => state.referralsCount,
  }

  // actions
  const actions = {
    getReferrals ({ commit }, data) {
        commit('setLoading', true);
        axios({
            method: 'GET',
            url: '/rest/secured/referrals?page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
        })
        .then((response) => {
            const data = response.data;
            commit('setLoading', false);
            commit('setReferrals', data.referrals.data);
            commit('setPagination', data.pagination);
            commit('setAuthRole', data.authRole);
        }).catch((error) => {
            commit('setLoading', false);
            console.log(error);
        });
    },
    postReferral({ commit }, referral) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/referrals',
                data: referral
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    updateReferral({ commit }, referral) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/referrals',
                data: referral
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    deleteReferral({ commit }, referral) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'DELETE',
                url: '/rest/secured/referrals/' + referral.id,
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
    searchReferralWithPagination({ commit, dispatch }, data) {
        if (data.searchTerm) {
            axios({
                method: 'GET',
                url: '/rest/secured/referrals/search-paginated?searchTerm=' + data.searchTerm + '&page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            }).then((response) => {
                const data = response.data;
                commit('setReferrals', data.referrals.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
            }).catch((error) => {
                const resp = error.response;

            });
        } else {
            dispatch('getReferrals', data);
        }
    },
    searchReferral({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'GET',
                url: '/rest/secured/referrals/search?searchTerm=' + data.searchTerm,
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
    setReferral (state, referral) {
      state.referral = referral
    },
    setReferrals (state, referrals) {
        state.referrals = referrals
    },
    setReferralsCount (state, count) {
      state.referralsCount = count;
    }
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
