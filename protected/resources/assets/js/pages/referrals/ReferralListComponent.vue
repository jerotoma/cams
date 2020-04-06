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
        :isLoading.sync="mLoading"
        :columns="columns"
        :rows="referrals"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a referral',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'date_arrival'">
                    <span class="text-primary">{{props.row.date_arrival | moment("MMMM Do, YYYY")}}</span>
                </span>
                <span v-else-if="props.column.field == 'camp'">
                    <span class="text-primary">{{props.row.camp && props.row.camp.camp_name ? props.row.camp.camp_name : props.row.camp_name }}</span>
                </span>
                <span v-else-if="props.column.field == 'action'">
                    <ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                <li :id="props.row.id + '-view'"><a href="#" @click="performAction('view', props.row)" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
                                <li :id="props.row.id + '-print'"><a href="#"  :onclick="'printPage(\'/referrals/' + props.row.referralId + '\');'" class="editRecord label "><i class="fa fa-print "></i> Print </a></li>
                                <li :id="props.row.id + '-download'"><a :href="'/referrals/download/' + props.row.referralId" class="label"><i class="fa fa-download"></i> Download </a></li>
                                <template v-if="authRole === 'authorize' || authPermission == 'authorize'">
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
    name: 'referral-list-component',
    computed: {
        ...mapGetters([
            'referrals',
            'referral',
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
                    label: 'Referral Ref',
                    field: 'reference_no',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Referral Date',
                    field: 'referral_date',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Individual ID',
                    field: 'individual_id',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Unique ID',
                    field: 'client_number',
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
                    label: 'Age',
                    field: 'age',
                    type: 'number',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Sex',
                    field: 'sex',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Camp',
                    field: 'camp_name',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Progress Status',
                    field: 'referral_status',
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
            this.loadReferrals();
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
            this.loadReferrals();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchReferralWithPagination', this.pagination);
        },
        performAction(actionType, referral) {
            switch(actionType) {
                case 'view':
                    this.$modal.loadPageInAModal('/referrals/' + referral.referralId, 'Referral Details', 'fa-eye');
                    break;
                case 'edit':
                    this.$modal.loadPageInAModal('/referrals/' + referral.referralId + '/edit', 'Update Referral Details', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/referrals/' + referral.referralId);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/authorize/' + referral.referralId);
                    break;
            }
        },
        loadReferrals() {
            this.$store.dispatch('getReferrals', this.pagination);
        },
    },
    created() {
        this.loadReferrals();
    },
};
</script>
