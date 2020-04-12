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
        :rows="receivedItems"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a Item Received',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <div slot="emptystate">
                No Item Received was found
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'date_received'">
                    <span class="text-primary">{{props.row.date_received | moment("MMMM Do, YYYY")}}</span>
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
                <span v-else-if="props.column.field == 'action'">
                    <ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                    <li :id="props.row.id + '-view'"><a href="#" @click="performAction('view', props.row)" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                                    <li :id="props.row.id + '-print'"><a href="#"  :onclick="'printPage(\'/print/inventory-received/' + props.row.id + '\');'" class="editRecord label "><i class="fa fa-print "></i> Print </a></li>
                                    <li :id="props.row.id + '-download'"><a :href="'download/pdf/inventory-received/' + props.row.id" target="_blank" class="label"><i class="fa fa-download"></i> Download </a></li>
                                    <template v-if="authRole === 'authorize'  || authPermission == 'authorize'">
                                        <li :id="props.row.id + '-authorize'"><a href="#" @click="performAction('authorize', props.row)" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                                    </template>
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
    },
    data(){
        return {
            columns: [
                {
                    label: 'Ref No#',
                    field: 'reference_number',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Date Received',
                    field: 'date_received',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Donor Ref',
                    field: 'donor_ref',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Received From/Supplier',
                    field: 'received_from',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'HAI Receiving Officer',
                    field: 'receiving_officer',
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
                    this.$modal.loadPageInAModal('/inventories/received-items/' + receivedItem.id, 'NFIS Received Item Details', 'fa-eye');
                    break;
                case 'edit':
                    this.$modal.loadPageInAModal('/inventories/received-items/' + receivedItem.id + '/edit', 'Edit NFIS Received Item Details', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/inventories/received-items/' + receivedItem.id);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/rest/secured/inventories/received-items/' + receivedItem.id+ '/authorize');
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
