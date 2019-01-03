<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="active"><a href="{{ url('admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Users</span></a>
            <ul>
                <li><a href="{{ url('admin/add-user') }}">Add User</a></li>
                <li><a href="{{ url('admin/view-users') }}">View Users</a></li>
            </ul>
        </li>
        <li class="submenu"><a href="#"><i class="icon icon-globe"></i> <span>Countries</span></a>
            <ul>
                <li><a href="{{ url('admin/add-country') }}">Add Country</a></li>
                <li><a href="{{ url('admin/view-countries') }}">View Countries</a></li>
            </ul>
        </li>
        <li class="submenu"><a href="#"><i class="icon icon-building"></i> <span>Cities</span></a>
            <ul>
                <li><a href="{{ url('admin/add-city') }}">Add City</a></li>
                <li><a href="{{ url('admin/view-cities') }}">View Cities</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span></a>
            <ul>
                <li><a href="{{ url('admin/add-category') }}">Add Category</a></li>
                <li><a href="{{ url('admin/view-categories') }}">View Categories</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-screenshot"></i> <span>Companies</span></a>
            <ul>
                <li><a href="{{ url('admin/add-company') }}">Add Company</a></li>
                <li><a href="{{ url('admin/view-companies') }}">View Companies</a></li>
            </ul>
        </li>
        <li class="submenu"> <a id="aF" href="#"><i class="icon icon-briefcase"></i> <span>Meetings</span> <span class="label label-important">{{$metrCount}}</span></a>
            <ul>
                <li><a href="{{ url('admin/add-meeting') }}">Add Meeting</a></li>
                <li><a href="{{ url('admin/view-meetings') }}">View Meetings</a></li>
            </ul>
        </li>
        <li class="submenu"> <a id="aA" href="#"><i class="icon icon-comments-alt"></i> <span>Comments</span> <span class="label label-important">{{$comrCount}}</span></a>
            <ul>
                <li><a href="{{ url('admin/view-comment') }}">View Comments</a></li>
                <li><a href="{{ url('admin/view-reply') }}">View Replies</a></li>
            </ul>
        </li>
        <li><a href="{{ url('admin/view-documents') }}"><i class="icon icon-file"></i> <span>Documents</span></a></li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-large"></i> <span>Types</span></a>
            <ul>
                <li><a href="{{ url('admin/add-type') }}">Add Type</a></li>
                <li><a href="{{ url('admin/view-types') }}">View Types</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th"></i> <span>Subtypes</span></a>
            <ul>
                <li><a href="{{ url('admin/add-subtype') }}">Add Subtype</a></li>
                <li><a href="{{ url('admin/view-subtypes') }}">View Subtypes</a></li>
            </ul>
        </li>
        <li class="submenu"> <a id="aB" href="#"><i class="icon icon-cogs"></i> <span>Projects</span> <span class="label label-important">{{$prorCount}}</span></a>
            <ul>
                <li><a href="{{ url('admin/add-project') }}">Add Project</a></li>
                <li><a href="{{ url('admin/view-projects') }}">View Projects</a></li>
            </ul>
        </li>
        <li><a id="aC" href="{{ url('admin/view-solutions') }}"><i class="icon icon-wrench"></i> <span>Tasks</span> <span class="label label-important">{{$solrCount}}</span></a></li>
        <li><a id="aC" href="{{ url('admin/view-solutions') }}"><i class="icon icon-table"></i> <span>Reports</span> </a></li>
    </ul>
</div>
<!--sidebar-menu-->