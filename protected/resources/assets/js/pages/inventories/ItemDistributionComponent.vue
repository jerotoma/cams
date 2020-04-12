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
        :rows="itemDistributions"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a Item Distributions',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <div slot="emptystate">
                No Item Distributions were found
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'disbursements_date'">
                    <span class="text-primary">{{props.row.disbursements_date | moment("MMMM Do, YYYY")}}</span>
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
                                    <li :id="props.row.id + '-print'"><a href="#"  :onclick="'printPage(\'/print/items/distributions/' + props.row.id + '\');'" class="editRecord label "><i class="fa fa-print "></i> Print </a></li>
                                    <li :id="props.row.id + '-download'"><a :href="'/download/pdf/items/distributions/' + props.row.id" target="_blank" class="label"><i class="fa fa-download"></i> Download </a></li>
                                    <template v-if="authRole === 'authorize'  || authPermission == 'authorize'">
                                        <li :id="props.row.id + '-authorize'"><a href="#" @click="performAction('authorize', props.row)" class="authorizeRecord label "><i class="fa fa-check "></i> Authorize </a></li>
                                    </template>
                                    <template v-if="authRole === 'admin' || authRole === 'authorize' || authRole === 'inputer' ">
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
    name: 'item-distribution-list-component',
    computed: {
        ...mapGetters([
            'itemDistribution',
            'itemDistributions',
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
                    label: 'Items',
                    field: 'items',
                     formatFn: this.$stringUtil.concatString,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Full Name',
                    field: 'full_name',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Hai Reg #',
                    field: 'hai_reg_number',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Distributed By',
                    field: 'disbursements_by',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Comment',
                    field: 'comments',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Camp',
                    field: 'camp_name',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Distribution Date',
                    field: 'disbursements_date',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Auth Status',
                    field: 'auth_status',
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
            this.loadItemDistributions();
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
            this.loadItemDistributions();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchItemDistributionWithPagination', this.pagination);
        },
        performAction(actionType, itemDistribution) {
            switch(actionType) {
                case 'view':
                    this.$modal.loadPageInAModal('/items/distributions/' + itemDistribution.id, 'NFIS Item Distributions Details', 'fa-eye');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/items/distributions/' + itemDistribution.id);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/rest/secured/inventories/distributions/' + itemDistribution.id+ '/authorize');
                    break;
            }
        },
        loadItemDistributions() {
            this.$store.dispatch('getItemDistributions', this.pagination);
        },
    },
    created() {
        this.loadItemDistributions();
    },
};
</script>
