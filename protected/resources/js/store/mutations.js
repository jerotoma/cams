const mutations =  {
    setLoading(state, isLoading) {
        state.isLoading = isLoading;
    },
    setSending(state, isSending) {
        state.isSending = isSending;
    },
    setPagination(state, pagination) {
        state.pagination = pagination;
    },
}

export default mutations;
