<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class=""><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i>&nbsp;
                Dashboard</a>
        </li>
        <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-user"></i>&nbsp; Manager User</a>
        </li>
        <li class="">
            <a href="{{ route('project.index') }}"><i class="fa fa-calendar"></i>&nbsp; Manager Projects</a>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>
                Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
            </ul>
        </li>
        <li class=""><a href="{{ route('customer.index') }}"><i class="fa fa-users"></i>&nbsp; Manager Customer</a></li>
        <li class=""><a href="{{ route('customer.index') }}"><i class="fa fa-folder"></i>&nbsp; Manager Department</a>
        </li>
    </ul>
</div>
