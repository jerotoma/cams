// initial state
const state = {
    itemDistribution: {

    },
    itemDistribution: [],
  }

  // getters
  const getters = {
      itemDistribution: state => state.itemDistribution,
      itemDistribution: state => state.itemDistribution,
  }

  // actions
  const actions = {
    getItemDistributions ({ commit }, data) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({
                method: 'GET',
                url: '/rest/secured/inventories/distributions?page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            })
            .then((response) => {
                const data = response.data;
                commit('setLoading', false);
                commit('setItemDistributions', data.itemDistribution.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
                resolve(data);
            }).catch((error) => {
                commit('setLoading', false);
                const resp = error.response;
                reject(resp);
            });
        });
    },
    postItemDistribution({ commit }, itemDistribution) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/inventories/distributions',
                data: itemDistribution
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    updateItemDistribution({ commit }, itemDistribution) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/inventories/distributions',
                data: itemDistribution
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    deleteItemDistribution({ commit }, itemDistribution) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'DELETE',
                url: '/rest/secured/inventories/distributions/' + itemDistribution.id,
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
    searchItemDistributionWithPagination({ commit, dispatch }, data) {
        if (data.searchTerm) {
            axios({
                method: 'GET',
                url: '/rest/secured/inventories/distributions/search-paginated?searchTerm=' + data.searchTerm + '&page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            }).then((response) => {
                const data = response.data;
                commit('setItemDistributions', data.itemDistribution.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
            }).catch((error) => {
                const resp = error.response;

            });
        } else {
            dispatch('getItemDistributions', data);
        }
    },
    searchItemDistribution({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'GET',
                url: '/rest/secured/inventories/distributions/search?searchTerm=' + data.searchTerm,
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
    setItemDistribution (state, itemDistribution) {
      state.itemDistribution = itemDistribution
    },
    setItemDistributions (state, itemDistribution) {
        state.itemDistribution = itemDistribution
    },
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
