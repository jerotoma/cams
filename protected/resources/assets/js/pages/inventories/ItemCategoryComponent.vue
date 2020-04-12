<template>
  <div>
    <vue-good-table
        mode="remote"
        @on-page-change="onPageChange"
        @on-sort-change="onSortChange"
        @on-per-page-change="onPerPageChange"
        @on-search="onSearch"
        :line-numbers="true"
        :totalRows="pagination.total"
        :isLoading="isLoading"
        :columns="columns"
        :rows="itemCategories"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a Item Category',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <div slot="emptystate">
                No Item Categories were found
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'created_at'">
                    <span class="text-primary">{{props.row.created_at | moment("MMMM Do, YYYY")}}</span>
                </span>
                <span v-else-if="props.column.field == 'auth_status'">
                    <span v-if="$stringUtil.lowerCase(props.row.auth_status) == 'pending'"
                        class="label label-info">
                        {{$stringUtil.capitalize(props.row.auth_status)}}
                    </span>
                    <span v-else
                        class="label label-success">
                        {{$stringUtil.capitalize(props.row.auth_status)}}
                    </span>
                </span>
                <span v-else-if="props.column.field == 'status'">
                    <span v-if="$stringUtil.lowerCase(props.row.status) !== 'available'"
                        class="label label-warning">
                        {{$stringUtil.capitalize(props.row.status)}}
                    </span>
                    <span v-else
                        class="label label-success">
                        {{$stringUtil.capitalize(props.row.status)}}
                    </span>
                </span>
                <span v-else-if="props.column.field == 'action'">
                    <ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                               <template v-if="authRole === 'admin' || authRole === 'authorize' || authRole === 'inputer' ">
                                    <li :id="props.row.id + '-edit'"><a href="#"  @click="performAction('edit', props.row)" class="editRecord label text-primary"><i class="fa fa-pencil "></i> Edit </a></li>
                                    <li :id="props.row.id + '-delete'"><a href="#"  @click="performAction('delete', props.row)" class="deleteRecord label text-danger"><i class="fa fa-trash text-danger "></i> Remove </a></li>
                                </template>
                            </ul>
                        </li>
                    </ul>
                </span>
                <span v-else>
                {{props.formattedRow[props.column.field]}}
                </span>
            </template>
    </vue-good-table>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'item-category-list-component',
    computed: {
        ...mapGetters([
            'itemCategories',
            'itemCategory',
            'authRole',
            'authPermission',
            'isLoading',
            'pagination',
        ]),
        mLoading: {
            get() { return this.$store.state.isLoading; },
            set(value){
                this.$store.commit('setLoading', value);
            }
        }
    },
    data(){
        return {
            columns: [
                {
                    label: 'Category Name',
                    field: 'category_name',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Discription',
                    field: 'description',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Status',
                    field: 'status',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Auth Status',
                    field: 'auth_status',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Date Created',
                    field: 'created_at',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Action',
                    field: 'action',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                    sortable: false,
                },
            ]
        };
    },
    methods: {
        onPageChange(params){
            //console.log('onPageChange', params);
            this.updateParams(params);
        },
        onSortChange(params) {
            let pagination = this.pagination;
            pagination.sortType = params[0].type;
            pagination.sortField = params[0].field;
            this.$store.commit('setPagination', pagination);
            this.loadItemCategories();
        },
        onColumnFilter(params) {
            console.log('onColumnFilter', params[0]);
            //this.updateParams(params[]);
        },
        onPerPageChange(params) {
            //console.log('onPerPageChange', params);
            this.updateParams(params);
        },
        updateParams(params) {
            let pagination = this.pagination;
            pagination.currentPage = params.currentPage;
            pagination.perPage = params.currentPerPage;
            pagination.prevPage = params.prevPage;
            this.$store.commit('setPagination', pagination);
            this.loadItemCategories();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchItemCategoryWithPagination', this.pagination);
        },
         performAction(actionType, itemCategory) {
            switch(actionType) {
               case 'edit':
                    this.$modal.loadPageInAModal('/inventories/categories/' + itemCategory.id + '/edit', 'Edit NFIS Item Category Details', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/inventories/categories/' + itemCategory.id);
                    break;
            }
        },
        loadItemCategories() {
            this.$store.dispatch('getItemCategories', this.pagination);
        },
    },
    created() {
        this.loadItemCategories();
    },
};
</script>
