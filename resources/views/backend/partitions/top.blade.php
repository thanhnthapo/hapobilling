<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="">Manager System</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="navbar-nav ml-auto nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
                <div class="user-profile">
                    <img src="{{ asset('storage/'. Auth::user()->avatar) }}" alt="" class="img-circle">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <ul>
                            <li><a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">Xem hồ sơ</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
