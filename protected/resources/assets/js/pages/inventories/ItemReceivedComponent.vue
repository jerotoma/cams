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
        :isLoading.sync="$store.getters.isLoading"
        :columns="columns"
        :rows="ItemReceivedItem"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a Item ReceivedItem',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'referral_date'">
                    <span class="text-primary">{{props.row.referral_date | moment("MMMM Do, YYYY")}}</span>
                </span>
                <span v-else-if="props.column.field == 'referral_auth_status'">
                    <span v-if="props.row.referral_auth_status == 'pending' || props.row.referral_auth_status == 'Pending'"
                        class="label label-info">
                        {{$stringUtil.capitalize(props.row.referral_auth_status)}}
                    </span>
                    <span v-else
                        class="label label-success">
                        {{$stringUtil.capitalize(props.row.referral_auth_status)}}
                    </span>
                </span>
                <span v-else-if="props.column.field == 'status'">
                    <span v-if="props.row.status == 'closed' || props.row.status == 'Closed'"
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
                                    <li :id="props.row.id + '-edit'"><a href="#"  @click="performAction('edit', props.row)" class="editRecord label "><i class="fa fa-pencil "></i> Edit </a></li>
                                    <li :id="props.row.id + '-delete'"><a href="#" @click="performAction('delete', props.row)" class="deleteRecord label"><i class="fa fa-trash text-danger "></i> Delete </a></li>
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
    name: 'item-received-list-component',
    computed: {
        ...mapGetters([
            'receivedItems',
            'receivedItem',
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
                    label: 'Item Name',
                    field: 'name',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Discription',
                    field: 'discription',
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
            this.loadItemReceivedItems();
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
            this.loadItemReceivedItems();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchReceivedItemWithPagination', this.pagination);
        },
         performAction(actionType, receivedItem) {
            switch(actionType) {
                case 'view':
                    this.$modal.loadPageInAModal('/inventories/receivedItems/' + receivedItem.id, 'NFIS Received Item Details', 'fa-eye');
                    break;
                case 'edit':
                    this.$modal.loadPageInAModal('/inventories/receivedItems/' + receivedItem.id + '/edit', 'Edit NFIS Received Item Details', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/inventories/receivedItems/' + receivedItem.id);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/rest/secured/inventories/receivedItems/' + receivedItem.id+ '/authorize');
                    break;
            }
        },
        loadItemReceivedItems() {
            this.$store.dispatch('getReceivedItems', this.pagination);
        },
    },
    created() {
        this.loadItemReceivedItems();
    },
};
</script>
