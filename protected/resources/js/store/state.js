const state = {
    isLoading: false,
    isSending: false,
    authRole: 'view',
    pagination: {
        currentPage: 1,
        firstPageUrl: '',
        from: '',
        lastPage: '',
        lastPageUrl: '',
        nextPageUrl: '',
        path: '',
        perPage: 15,
        prevPageUrl: '',
        to: '',
        total: 0,
        sortType: 'desc',
        sortField: 'created_at',
        perPageDropdown: [15, 30, 45, 60],
        searchTerm: ''
    },
};

export default state;
