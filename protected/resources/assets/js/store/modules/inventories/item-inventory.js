// initial state
const state = {
    inventory: {},
    inventories: [],
  }

  // getters
  const getters = {
      inventories: state => state.inventories,
      inventory: state => state.inventory,
  }

  // actions
  const actions = {
    getInventories ({ commit }, data) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({
                method: 'GET',
                url: '/rest/secured/inventories?page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            })
            .then((response) => {
                const data = response.data;
                commit('setLoading', false);
                commit('setInventories', data.inventories.data);
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
    postInventory({ commit }, inventory) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/inventories',
                data: inventory
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    updateInventory({ commit }, inventory) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/inventories',
                data: inventory
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    deleteInventory({ commit }, inventory) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'DELETE',
                url: '/rest/secured/inventories/' + inventory.id,
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
    searchInventoryWithPagination({ commit, dispatch }, data) {
        if (data.searchTerm) {
            axios({
                method: 'GET',
                url: '/rest/secured/inventories/search-paginated?searchTerm=' + data.searchTerm + '&page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            }).then((response) => {
                const data = response.data;
                commit('setInventories', data.inventories.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
            }).catch((error) => {
                const resp = error.response;

            });
        } else {
            dispatch('getInventories', data);
        }
    },
    searchInventory({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'GET',
                url: '/rest/secured/inventories/search?searchTerm=' + data.searchTerm,
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
    setInventory (state, inventory) {
      state.inventory = inventory
    },
    setInventories (state, inventories) {
        state.inventories = inventories
    },
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
