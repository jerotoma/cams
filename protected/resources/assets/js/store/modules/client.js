// initial state
const state = {
    client: {

    },
    clients: [],
  }

  // getters
  const getters = {
      clients: state => state.clients,
      client: state => state.client,
  }

  // actions
  const actions = {
    getClients ({ commit }, data) {
        return new Promise((resolve, reject) => {
            commit('setLoading', true);
            axios({
                method: 'GET',
                url: '/rest/secured/clients?page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            })
            .then((response) => {
                const data = response.data;
                commit('setLoading', false);
                commit('setClients', data.clients.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
                resolve(data);
            }).catch((error) => {
                commit('setLoading', false);
                const resp = error.response;
                reject(resp);
                console.log(error);
            });
        });
    },
    postClient({ commit }, client) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'POST',
                url: '/rest/secured/clients',
                data: client
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    updateClient({ commit }, client) {
        return new Promise((resolve, reject) => {
                axios({
                method: 'PUT',
                url: '/rest/secured/clients',
                data: client
            }).then((response) => {
                const data = response.data;
                resolve(data);
            }).catch((error) => {
                const resp = error.response;
                reject(resp);
            });
        });
    },
    deleteClient({ commit }, client) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'DELETE',
                url: '/rest/secured/clients/' + client.id,
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
    searchClientWithPagination({ commit, dispatch }, data) {
        if (data.searchTerm) {
            axios({
                method: 'GET',
                url: '/rest/secured/clients/search-paginated?searchTerm=' + data.searchTerm + '&page='+ data.currentPage + '&perPage=' + data.perPage + '&sortType='+ data.sortType + '&sortField=' + data.sortField,
            }).then((response) => {
                const data = response.data;
                commit('setClients', data.clients.data);
                commit('setPagination', data.pagination);
                commit('setAuthRole', data.authRole);
                commit('setAuthPermission', data.authPermission);
            }).catch((error) => {
                const resp = error.response;

            });
        } else {
            dispatch('getClients', data);
        }
    },
    searchClient({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'GET',
                url: '/rest/secured/clients/search?searchTerm=' + data.searchTerm,
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
    setClient (state, client) {
      state.client = client
    },
    setClients (state, clients) {
        state.clients = clients
    },
  }

  export default {
    state,
    getters,
    actions,
    mutations
  }
