<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
           href="{{route('dashboard.v1.index')}}">{{__('Dashboard')}}</a>
    {{-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
     <div class="form-group mb-0">
         <div class="input-group input-group-alternative">
         <div class="input-group-prepend">
             <span class="input-group-text"><i class="fas fa-search"></i></span>
         </div>
         <input class="form-control" placeholder="Search" type="text">
         </div>
     </div>
     </form>--}}
    <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="{{Auth::user()->name}}" src="{{auth()->user()['custom_avatar']}}">
                </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{__('welcome')}}</h6>
                    </div>
                    <a href="{{route('dashboard.v1.users.edit',auth()->id())}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{__('profile')}}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>{{__('logout')}}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
