<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class=""><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i>&nbsp;
                Dashboard</a>
        </li>
        <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-user"></i>&nbsp; Manager User</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa  fa-calendar"></i>&nbsp;
                Manager Project <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('project.index') }}">List Project</a></li>
                <li><a href="{{ route('project.create') }}">Create Project</a></li>
                <li><a href="{{ route('assign.create') }}">Assign Project</a></li>
            </ul>
        </li>
        <li class=""><a href="{{ route('customer.index') }}"><i class="fa fa-users"></i>&nbsp; Manager Customer</a></li>
        <li class=""><a href="{{ route('department.index') }}"><i class="fa fa-folder"></i>&nbsp; Manager Department</a>
        </li>
        <li class=""><a href="{{ route('role.index') }}"><i class="fa fa-eye"></i>&nbsp; Manager Role</a>
        </li>
        <li class=""><a href="{{ route('department.index') }}"><i class="fa fa-calendar"></i>&nbsp; Report</a></li>
    </ul>
</div>
