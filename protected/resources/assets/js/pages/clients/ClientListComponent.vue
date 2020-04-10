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
        :rows="clients"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a client',
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
                <span v-else-if="props.column.field == 'auth_status'">
                    <span v-if="props.row.auth_status == 'pending' || props.row.auth_status == 'Pending'"
                        class="label label-info">
                        {{$stringUtil.capitalize(props.row.auth_status)}}
                    </span>
                    <span v-else
                        class="label label-success">
                        {{$stringUtil.capitalize(props.row.auth_status)}}
                    </span>
                </span>
                <span v-else-if="props.column.field == 'camp'">
                    {{props.row.camp && props.row.camp.camp_name ? $stringUtil.capitalize(props.row.camp.camp_name) : $stringUtil.capitalize(props.row.camp_name)}}
                </span>
                <span v-else-if="props.column.field == 'action'">
                    <ul class="icons-list text-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                             <ul class="dropdown-menu dropdown-menu-right">
                                 <li :id="props.row.id + '-view'"><a href="#" @click="performAction('view', props.row)" class="showRecord label "><i class="fa fa-eye "></i> View </a></li>
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
    name: 'client-list-component',
    computed: {
        ...mapGetters([
            'clients',
            'client',
            'authRole',
            'authPermission',
            'isLoading',
            'pagination',
        ]),
        mLoading: {
            get() { return this.isLoading; },
            set(value){
                this.$store.commit('setLoading', value);
            }
        }
    },
    data(){
        return {
            columns: [
                {
                    label: 'Full Name',
                    field: 'full_name',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'HAI Reg #',
                    field: 'hai_reg_number',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Individual ID',
                    field: 'individual_id',
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'Sex',
                    field: 'sex',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Age',
                    field: 'age',
                    type: 'number',
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'Address',
                    field: 'present_address',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Date of Arrival',
                    field: 'date_arrival',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Camp',
                    field: 'camp',
                    type: Object,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Auth Status',
                    field: 'auth_status',
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
            this.loadClients();
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
            this.loadClients();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchClientWithPagination', this.pagination);
        },
        performAction(actionType, client) {
            switch(actionType) {
                case 'view':
                    this.$modal.loadPageInAModal('/clients/' + client.id, 'Client Details', 'fa-eye');
                    break;
                case 'edit':
                    this.$modal.loadPageInAModal('/clients/' + client.id + '/edit', 'Update Client Details', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/clients/' + client.id);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/rest/secured/clients/' + client.id + '/authorize');
                    break;
            }
        },
        loadClients() {
            this.$store.dispatch('getClients', this.pagination);
        },
    },
    created() {
        this.loadClients();
    },
};
</script>
