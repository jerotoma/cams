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
        :rows="homeAssessments"
        :search-options="{
            enabled: true,
            placeholder: 'Search for a Home Assessments',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            setCurrentPage: pagination.currentPage,
            perPage: pagination.perPage,
            perPageDropdown: pagination.perPageDropdown,
        }">
            <div slot="emptystate">
                No Home Assessments were found
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'assessment_date'">
                    <span class="text-primary">{{props.row.assessment_date | moment("MMMM Do, YYYY")}}</span>
                </span>
                <span v-else-if="props.column.field == 'assessment_auth_status'">
                    <span v-if="props.row.assessment_auth_status == 'pending' || props.row.assessment_auth_status == 'Pending'"
                        class="label label-info">
                        {{$stringUtil.capitalize(props.row.assessment_auth_status)}}
                    </span>
                    <span v-else
                        class="label label-success">
                        {{$stringUtil.capitalize(props.row.assessment_auth_status)}}
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
                                <li :id="props.row.id + '-print'"><a href="#"  :onclick="'printPage(\'/assessments/home/' + props.row.assessment_id + '\');'" class="editRecord label "><i class="fa fa-print "></i> Print </a></li>
                                <li :id="props.row.id + '-download'"><a :href="'/assessments/home/download/' + props.row.assessment_id" target="_blank" class="label"><i class="fa fa-download"></i> Download </a></li>
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
    name: 'home-assessment-component',
    computed: {
        ...mapGetters([
            'homeAssessments',
            'homeAssessment',
            'authPermission',
            'authRole',
            'isLoading',
            'pagination',
        ])
    },
    data(){
        return {
            mLoading: true,
            columns: [
                {
                    label: 'Date of Interview',
                    field: 'assessment_date',
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'PSN Case Code',
                    field: 'case_code',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'HAI Reg #',
                    field: 'hai_reg_number',
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'Client No',
                    field: 'client_number',
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
                    label: 'Full Name',
                    field: 'full_name',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: 'Sex',
                    field: 'sex',
                    formatFn: this.$stringUtil.capitalize,
                    thClass: 'text-center',
                    tdClass: 'text-center text-primary',
                },
                {
                    label: 'Age',
                    field: 'age',
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
                    label: 'Auth Status',
                    field: 'assessment_auth_status',
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
            this.loadHomeAssessments();
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
            this.loadHomeAssessments();
        },
        onSearch(params){
           let pagination = this.pagination;
            pagination.searchTerm = params.searchTerm;
            this.$store.commit('setPagination', pagination);
            this.$store.dispatch('searchHomeAssessmentWithPagination', this.pagination);
        },
        performAction(actionType, homeAssessment) {
            switch(actionType) {
                case 'view':
                    this.$modal.loadPageInAModal('/assessments/home/' + homeAssessment.assessment_id, 'View Vulnerabiltiy Assessment', 'fa-eye');
                    break;
                case 'edit':
                    this.$modal.loadPageInAModal('/assessments/home/' + homeAssessment.assessment_id + '/edit', 'Update Vulnerabiltiy Assessment', 'fa-edit');
                    break;
                case 'delete':
                     this.$modal.deleteRecord('/assessments/home/' + homeAssessment.assessment_id);
                    break;
                case 'authorize':
                     this.$modal.authorizeRecord('/rest/secured/assessments/home/' + homeAssessment.assessment_id + '/authorize');
                    break;
            }
        },
        loadHomeAssessments() {
            this.$store.dispatch('getHomeAssessments', this.pagination)
                .then((resp) => {
                    this.mLoading = this.isLoading;
                }).catch(resp => {
                    this.mLoading = this.isLoading;
                });
        },
    },
    created() {
        this.loadHomeAssessments();
    },
};
</script>
