<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <li class="active"><a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <!-- Main -->
            
            <li>
                <a href="#"><i class="icon-users"></i> <span>Clients</span></a>
                <ul>
                    <li ><a href="{{url('clients')}}">Clients Management</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                <ul>
                    <li ><a href="{{url('assessments/vulnerability')}}">Vulnerability assessment</a></li>
                    <li><a href="{{url('assessments/home')}}">Home Assessment </a></li>
                    <li><a href="{{url('assessments/paediatric')}}">Paediatric Assessment </a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-stack"></i> <span>Client Referrals</span></a>
                <ul>
                    <li ><a href="{{url('referrals')}}">Referrals</a></li>
                </ul>
            </li>
            <!-- /main -->
            <!-- Forms -->
          @permission('inventory')

                <li>
                    <a href="#"><i class="icon-popout"></i> <span>NFIs Inventory</span></a>
                    <ul>
                        <li><a href="{{url('items/distributions')}}">Item Distribution</a></li>
                        <li><a href="{{url('inventory-received')}}">Received Items</a></li>
                        <li><a href="{{url('inventory')}}">Items Inventory</a></li>
                        <li><a href="{{url('inventory-categories')}}">Items Categories</a></li>
                    </ul>
                </li>
            <li>
                <a href="#"><i class="fa fa-money"></i> <span>Cash Monitoring</span></a>
                <ul>
                    <li><a href="{{url('cash/monitoring/provision')}}">Cash Provision</a></li>
                    <li><a href="{{url('cash/monitoring/budget')}}">Budget Register</a></li>
                    <li><a href="{{url('post/cash/monitoring')}}">Cash Post Distribution Monitoring</a></li>
                </ul>
            </li>
            @endpermission
            <!-- /forms -->
            <!-- Forms -->
            
            <li>
                <a href="#"><i class="icon-grid"></i> <span>Progress Monitoring</span></a>
                <ul>
                    <li><a href="{{url('cases')}}">Case Management</a></li>
                    <li><a href="{{url('progressive/notices')}}">Progressive Note</a></li>
                </ul>
            </li>
        @permission('backup')
            <!-- Backup Restore-->
            <li class="navigation-header"><span>Data Sharing/Backup</span> <i class="icon-menu" title="Data Sharing"></i></li>
            <li>
                <a href="#"><i class="fa fa-upload "></i> <span>Data import</span></a>
                <ul>
                    <li><a href="{{url('backup/import/advanced')}}">Import data</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-download"></i> <span>Data Export</span></a>
                <ul>
                    <li><a href="{{url('backup/export/advanced')}}">Export data</a></li>
                </ul>
            </li>
            <!-- End Backup Restore-->
        @endpermission
        @permission('reports')
            <!-- Data visualization -->
            
            <li>
                <a href="#"><i class="icon-graph"></i> <span> Reports</span></a>
                <ul>
                    <li><a href="{{url('reports/clients')}}">Client Reports</a></li>
                    <li ><a href="{{url('reports/assessments')}}">Assessments Reports</a></li>
                    <li><a href="{{url('reports/referrals')}}">Referrals Reports</a></li>
                    <li><a href="{{url('reports/nfis')}}">NFIs Reports</a></li>
                </ul>
            </li>
            <!-- /data visualization -->
        @endpermission

        <!-- Settings -->
            @role('admin')
            
            <li>
                <a href="#"><i class="icon-list"></i> <span>Locations</span></a>
                <ul>
                    <li><a href="{{url('countries')}}">Countries</a></li>
                    <li><a href="{{url('regions')}}">Regions</a></li>
                    <li><a href="{{url('districts')}}">Districts</a></li>
                    <li><a href="{{url('camps')}}">Camps</a></li>
					<li><a href="{{url('origins')}}">Origins</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-puzzle4"></i> <span>Vulnerability Codes</span></a>
                <ul>
                    <li><a href="{{url('psncodes')}}">Codes</a></li>
                    <li><a href="{{url('psncodes-categories')}}">Categories</a></li>
                </ul>
            </li>

            <!-- /appearance -->

            <!-- Layout -->
            <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>
            <li>
                <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                <ul>
                    <li><a href="{{url('users')}}">Manage Users</a></li>
                    <li><a href="{{url('departments')}}">Departments</a></li>
                    <li><a href="{{url('access/rights')}}">User Rights</a></li>
                    <li><a href="{{url('audit/los')}}">User Logs</a></li>
                </ul>
            </li>
            <li class="navigation-header"><span></span> <i class="icon-menu" title="Users Managements"></i></li>
            <!-- /Settings -->
            @endrole
        </ul>
    </div>
</div>