<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <li class="{{Request::is('home') ? 'active' : ''}}">
                <a href="{{url('home')}}"><i class="icon-home4"></i> <span>Dashboard</span></a>
            </li>
            <!-- Main -->

            <li class="{{Request::is('clients') ? 'active' : ''}}">
                <a href="#"><i class="icon-users"></i> <span>Clients</span></a>
                <ul>
                    <li class="{{Request::is('clients') ? 'active' : ''}}"><a href="{{url('clients')}}">Clients Management</a></li>
                </ul>
            </li>
            <li class="{{Request::is('assessments/vulnerability') || Request::is('assessments/home') ? 'active' : ''}}">
                <a href="#"><i class="icon-list-unordered"></i> <span>Client Assessments</span></a>
                <ul>
                    <li class="{{Request::is('assessments/vulnerability') ? 'active' : ''}}"><a href="{{url('assessments/vulnerability')}}">Vulnerability Assessment</a></li>
                    <li class="{{Request::is('assessments/home') ? 'active' : ''}}"><a href="{{url('assessments/home')}}">Home Assessment </a></li>

                </ul>
            </li>
            <li class="{{Request::is('referrals') ? 'active' : ''}}">
                <a href="#"><i class="icon-stack"></i> <span>Client Referrals</span></a>
                <ul>
                    <li class="{{Request::is('referrals') ? 'active' : ''}}"><a href="{{url('referrals')}}">Referrals</a></li>
                </ul>
            </li>
            <!-- /main -->
            <!-- Forms -->
          @permission('inventory')
            <li class="{{
                Request::is('items/distributions')  ||
                Request::is('inventories')          ||
                Request::is('inventories')          ||
                Request::is('inventory-received')   ||
                Request::is('inventory-categories') ? 'active' : ''}}">
                <a href="#"><i class="icon-popout"></i> <span>NFIs Inventory</span></a>
                <ul>
                    <li class="{{Request::is('items/distributions') ? 'active' : ''}}"><a href="{{url('items/distributions')}}">Item Distribution</a></li>
                    <li class="{{Request::is('inventory-received') ? 'active' : ''}}"><a href="{{url('inventory-received')}}">Received Items</a></li>
                    <li class="{{Request::is('inventories') ? 'active' : ''}}"><a href="{{url('inventories')}}">Items Inventory</a></li>
                    <li class="{{Request::is('inventory-categories') ? 'active' : ''}}"><a href="{{url('inventory-categories')}}">Items Categories</a></li>
                </ul>
            </li>
            <li class="{{
                Request::is('cash/monitoring/provision') ||
                Request::is('cash/monitoring/budget')    ||
                Request::is('post/cash/monitoring')  ? 'active' : ''}}">
                <a href="#"><i class="fa fa-money"></i> <span>Cash Monitoring</span></a>
                <ul>
                    <li class="{{Request::is('cash/monitoring/provision') ? 'active' : ''}}"><a href="{{url('cash/monitoring/provision')}}">Cash Distributions</a></li>
                    <li class="{{Request::is('cash/monitoring/budget') ? 'active' : ''}}"><a href="{{url('cash/monitoring/budget')}}">Budget Register</a></li>
                    <li class="{{Request::is('post/cash/monitoring') ? 'active' : ''}}"><a href="{{url('post/cash/monitoring')}}">Cash Post Distribution Monitoring</a></li>
                </ul>
            </li>
            @endpermission
            <!-- /forms -->
            <!-- Forms -->

            <li class="{{Request::is('cases') || Request::is('progressive/notices') ? 'active' : ''}}">
                <a href="#"><i class="icon-grid"></i> <span>Progress Monitoring</span></a>
                <ul>
                    <li class="{{Request::is('cases') ? 'active' : ''}}"><a href="{{url('cases')}}">Case Management</a></li>
                    <li class="{{Request::is('progressive/notices') ? 'active' : ''}}"><a href="{{url('progressive/notices')}}">Progressive Note</a></li>
                </ul>
            </li>
        @permission('backup')
            <!-- Backup Restore-->

            <li class="{{Request::is('backup/import/advanced') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-upload "></i> <span>Data import</span></a>
                <ul>
                    <li class="{{Request::is('backup/import/advanced') ? 'active' : ''}}"><a href="{{url('backup/import/advanced')}}">Import data</a></li>
                </ul>
            </li>
            <li class="{{Request::is('backup/export/advanced') ? 'active' : ''}}">
                <a href="#"><i class="fa fa-download"></i> <span>Data Export</span></a>
                <ul>
                    <li class="{{Request::is('backup/export/advanced') ? 'active' : ''}}"><a href="{{url('backup/export/advanced')}}">Export data</a></li>
                </ul>
            </li>
            <!-- End Backup Restore-->
        @endpermission
        @permission('reports')
            <!-- Data visualization -->

            <li class="{{
                Request::is('backup/import/advanced') ||
                Request::is('reports/clients') ||
                Request::is('reports/assessments') ||
                Request::is('reports/referrals') ||
                Request::is('reports/nfis') ||
                Request::is('reports/case/management')
                ? 'active' : ''}}">
                <a href="#"><i class="icon-graph"></i> <span> Reports</span></a>
                <ul>
                    <li class="{{Request::is('reports/clients') ? 'active' : ''}}"><a href="{{url('reports/clients')}}">Client Reports</a></li>
                    <li class="{{Request::is('reports/assessments') ? 'active' : ''}}"><a href="{{url('reports/assessments')}}">Assessments Reports</a></li>
                    <li class="{{Request::is('reports/referrals') ? 'active' : ''}}"><a href="{{url('reports/referrals')}}">Referrals Reports</a></li>
                    <li class="{{Request::is('reports/nfis') ? 'active' : ''}}"><a href="{{url('reports/nfis')}}">NFIs Reports</a></li>
                    <li class="{{Request::is('reports/case/management') ? 'active' : ''}}"><a href="{{url('reports/case/management')}}">Case Management Reports</a></li>
                </ul>
            </li>
            <!-- /data visualization -->
        @endpermission

        <!-- Settings -->
        @role('admin')

            <li {{
                Request::is('countries') ||
                Request::is('regions') ||
                Request::is('districts') ||
                Request::is('camps') ||
                Request::is('origins')
                ? 'active' : ''}}">
                <a href="#"><i class="icon-list"></i> <span>Locations</span></a>
                <ul>
                    <li class="{{Request::is('countries') ? 'active' : ''}}"><a href="{{url('countries')}}">Countries</a></li>
                    <li class="{{Request::is('regions') ? 'active' : ''}}"><a href="{{url('regions')}}">Regions</a></li>
                    <li class="{{Request::is('districts') ? 'active' : ''}}"><a href="{{url('districts')}}">Districts</a></li>
                    <li class="{{Request::is('camps') ? 'active' : ''}}"><a href="{{url('camps')}}">Camps</a></li>
					<li class="{{Request::is('origins') ? 'active' : ''}}"><a href="{{url('origins')}}">Origins</a></li>
                </ul>
            </li>
            <li class="{{Request::is('backup/import/advanced') ? 'active' : ''}}">
                <a href="#"><i class="icon-puzzle4"></i> <span>Vulnerability Codes</span></a>
                <ul>
                    <li class="{{Request::is('psncodes') ? 'active' : ''}}"><a href="{{url('psncodes')}}">Codes</a></li>
                    <li class="{{Request::is('psncodes-categories') ? 'active' : ''}}"><a href="{{url('psncodes-categories')}}">Categories</a></li>
                </ul>
            </li>
            <li class="{{Request::is('setting/client/needs') ? 'active' : ''}}">
                <a href="{{url('setting/client/needs')}}"><i class="icon-puzzle4"></i> <span>Client Needs Setting</span></a>
            </li>

            <!-- /appearance -->

            <!-- Layout -->
            <li class="navigation-header"><span>Users Managements</span> <i class="icon-menu" title="Users Managements"></i></li>
            <li class="{{
                Request::is('users') ||
                Request::is('departments') ||
                Request::is('access/rights') ||
                Request::is('audit/logs')
                ? 'active' : ''}}">
                <a href="#"><i class="icon-users"></i> <span>Users</span></a>
                <ul>
                    <li class="{{Request::is('users') ? 'active' : ''}}"><a href="{{url('users')}}">Manage Users</a></li>
                    <li class="{{Request::is('departments') ? 'active' : ''}}"><a href="{{url('departments')}}">Departments</a></li>
                    <li class="{{Request::is('access/rights') ? 'active' : ''}}"><a href="{{url('access/rights')}}">User Rights</a></li>
                    <li class="{{Request::is('audit/logs') ? 'active' : ''}}"><a href="{{url('audit/logs')}}">User Logs</a></li>
                </ul>
            </li>
            <li class="navigation-header"><span></span> <i class="icon-menu" title="Users Managements"></i></li>
            <!-- /Settings -->
            @endrole
        </ul>
    </div>
</div>
