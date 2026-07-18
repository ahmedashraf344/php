<!-- Sidenav -->
<nav class="rtl navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{url('/')}}">
            <img src="{{--{{setting_value('logo')}}--}}" class="navbar-brand-img"
                 alt="{{--{{setting_value('name')}}--}}">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            {{--<li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                     aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">{{__('profile')}}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{__('logout')}}</a>
                </div>
            </li>--}}
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                <img alt="{{Auth::user()->name}}" src="{{auth()->user()['custom_avatar']}}">
                </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{__('welcome')}}</h6>
                    </div>
                    <a href="#" class="dropdown-item">
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
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{url('/')}}">
                            <img src="{{--{{setting_value('logo')}}--}}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
        {{--<form class="mt-4 mb-3 d-md-none">
            <div class="input-group input-group-rounded input-group-merge">
                <input type="search" class="form-control form-control-rounded form-control-prepended"
                       placeholder="Search" aria-label="Search">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-search"></span>
                    </div>
                </div>
            </div>
        </form>--}}
        <!-- Navigation -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ is_active('dashboard.v1.index')}}" href="{{route('dashboard.v1.index')}}">
                        <i class="ni ni-tv-2 text-primary"></i> {{__('Dashboard')}}
                    </a>
                </li>
                <!-- menu item -->
                @can(['View category','Add category'])
                    <a class="nav-link {{ is_active('dashboard.v1.categories.*')}} collapsed" href="#navbar-category"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.categories.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-books text-pink"></i>
                        <span class="nav-link-text">{{__('Categories')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.categories.*')}}" id="navbar-category"
                         style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View category')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.categories.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.categories.index')}}">{{__('Categories')}}</a>
                                </li>
                            @endcan
                            @can('Add category')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.categories.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.categories.create')}}">{{__('Create category')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif

                @can(['View shop','Add shop'])
                    <a class="nav-link {{ is_active('dashboard.v1.shops.*')}} collapsed" href="#navbar-shop"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.shops.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-bullet-list-67 text-info"></i>
                        <span class="nav-link-text">{{__('Shops')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.shops.*')}}" id="navbar-shop" style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View shop')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.shops.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.shops.index')}}">{{__('Shops')}}</a>
                                </li>
                            @endcan
                            @can('Add shop')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.shops.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.shops.create')}}">{{__('Create shop')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif

                @can(['View announcement','Add announcement'])
                    <a class="nav-link {{ is_active('dashboard.v1.announcements.*')}} collapsed"
                       href="#navbar-announcement"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.announcements.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-notification-70 text-yellow"></i>
                        <span class="nav-link-text">{{__('Announcements')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.announcements.*')}}" id="navbar-announcement"
                         style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View announcement')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.announcements.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.announcements.index')}}">{{__('Announcements')}}</a>
                                </li>
                            @endcan
                            @can('Add announcement')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.announcements.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.announcements.create')}}">{{__('Create announcement')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif

                @can(['View post','Add post'])
                    <a class="nav-link {{ is_active('dashboard.v1.posts.*')}} collapsed" href="#navbar-post"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.posts.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-tag text-primary"></i>
                        <span class="nav-link-text">{{__('Posts')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.posts.*')}}" id="navbar-post" style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View post')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.posts.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.posts.index')}}">{{__('Posts')}}</a>
                                </li>
                            @endcan
                            @can('Add post')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.posts.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.posts.create')}}">{{__('Create post')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif

            <!-- menu item -->

                @can(['View notification','Add notification'])
                    <a class="nav-link {{ is_active('dashboard.v1.notification.*')}} collapsed" href="#navbar-notification"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.notification.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-tag text-primary"></i>
                        <span class="nav-link-text">{{__('Notifications')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.notification.*')}}" id="navbar-notification" style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View notification')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.notification.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.notification.index')}}">{{__('Notification')}}</a>
                                </li>
                            @endcan
                            @can('Add notification')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.notification.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.notification.create')}}">{{__('Create notification')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif

            <!-- menu item -->

                @can(['View competition','Add competition'])
                    <a class="nav-link {{ is_active('dashboard.v1.competition.*')}} collapsed" href="#navbar-competition"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.competition.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-tag text-primary"></i>
                        <span class="nav-link-text">{{__('Competitions')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.competition.*')}}" id="navbar-competition" style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View competition')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.competition.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.competition.index')}}">{{__('Competition')}}</a>
                                </li>
                            @endcan
                            @can('Add competition')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.competition.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.competition.create')}}">{{__('Create Competition')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                @endif
            <!-- menu item -->
                @can(['View user', 'Add user'])
                    <li class="nav-item">
                        <a class="nav-link {{ is_active('dashboard.v1.users.index')}}"
                           href="{{route('dashboard.v1.users.index')}}">
                            <i class="ni ni-settings-gear-65 text-pink"></i> {{__('Users')}}
                        </a>
                    </li>

                    {{--<a class="nav-link {{ is_active('dashboard.v1.users.*')}} collapsed" href="#navbar-user"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.users.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-settings-gear-65 text-pink"></i>
                        <span class="nav-link-text">{{__('Users')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.users.*')}}" id="navbar-user" style="">
                        <ul class="nav nav-sm flex-column">
                            @can('View user')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.users.index')}}"
                                       class="nav-link {{is_active('dashboard.v1.users.index')}}">{{__('Users')}}</a>
                                </li>
                            @endcan
                            @can('Add user')
                                <li class="nav-item">
                                    <a href="{{route('dashboard.v1.users.create')}}"
                                       class="nav-link {{ is_active('dashboard.v1.users.create')}}">{{__('create user')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </div>--}}
                @endif

                @can(['View contactus'])
                    <li class="nav-item">
                        <a class="nav-link {{ is_active('dashboard.v1.contact-us-forms.index')}}"
                           href="{{route('dashboard.v1.contact-us-forms.index')}}">
                            <i class="ni ni-email-83 text-info"></i> {{__('Contact us forms')}}
                        </a>
                    </li>
                @endcan
            <!-- menu item -->
                @can(['View setting'])
                    <a class="nav-link {{ is_active('dashboard.v1.settings.*')}} collapsed" href="#navbar-settings"
                       data-toggle="collapse"
                       role="button" aria-expanded="{{area_expand('dashboard.v1.settings.*')}}"
                       aria-controls="navbar-forms">
                        <i class="ni ni-bullet-list-67 text-primary"></i>
                        <span class="nav-link-text">{{__('Settings & static content')}}</span>
                    </a>
                    <div class="collapse {{ show_collapsed('dashboard.v1.settings.*')}}" id="navbar-settings" style="">
                        <ul class="nav nav-sm flex-column">
                           {{-- <li class="nav-item">
                                <a href="{{route('dashboard.v1.settings.show','general')}}"
                                   class="nav-link {{is_active_url('dashboard.v1.settings.show','general')}}">{{__('General settings')}}</a>
                            </li>--}}
                            <li class="nav-item">
                                <a href="{{route('dashboard.v1.settings.show','about_page')}}"
                                   class="nav-link {{ is_active_url('dashboard.v1.settings.show','about_page')}}">{{__('About us')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('dashboard.v1.settings.show','terms_page')}}"
                                   class="nav-link {{ is_active_url('dashboard.v1.settings.show','terms_page')}}">{{__('Terms')}}</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </ul>

            <hr class="my-2">

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run text-pink"></i>{{__('Logout')}}
                    </a>
                </li>
            </ul>

            <!-- menu item -->
        {{--                @can(['all-roles', 'create-role'])  )
                            <a class="nav-link {{ is_active('role.*')}} collapsed" href="#navbar-role" data-toggle="collapse"
                               role="button" aria-expanded="{{area_expand('role.*')}}"
                               aria-controls="navbar-forms">
                                <i class="ni ni-ui-04 text-pink"></i>
                                <span class="nav-link-text">{{__('aside_roles_managment')}}</span>
                            </a>
                            <div class="collapse {{ show_collapsed('role.*')}}" id="navbar-role" style="">
                                <ul class="nav nav-sm flex-column">
                                    @can('all-roles'))
                                        <li class="nav-item">
                                            <a href="{{route('role.index')}}"
                                               class="nav-link {{is_active('role.index')}}">{{__('aside_all_roles')}}</a>
                                        </li>
                                    @endcan
                                    @can('create-role'))
                                        <li class="nav-item">
                                            <a href="{{route('role.create')}}"
                                               class="nav-link {{ is_active('role.create')}}">{{__('aside_create_role')}}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        @endcan--}}



        <!-- menu item -->
            {{--                    @can(['mobile-fdl-screen','mobile-home-screen'])  )
                                    <a class="nav-link {{ is_active('mobile.*')}} collapsed" href="#navbar-mobile"
                                       data-toggle="collapse"
                                       role="button" aria-expanded="{{area_expand('mobile.*')}}"
                                       aria-controls="navbar-forms">
                                            <i class="ni ni-mobile-button text-info"></i>
                                        <span class="nav-link-text">{{__('aside_mobile_app_content')}}</span>
                                    </a>
                                    <div class="collapse {{ show_collapsed('mobile.*')}}" id="navbar-mobile" style="">
                                        <ul class="nav nav-sm flex-column">
                                            @can('mobile-home-screen')  )
                                                <li class="nav-item">
                                                    <a href="{{route('mobile.home')}}"
                                                       class="nav-link {{ is_active('mobile.home')}}">{{__('home_screen_content')}}</a>
                                                </li>
                                            @endcan
                                            @can('mobile-home-screen'))
                                                <li class="nav-item">
                                                    <a href="{{route('mobile.fdl')}}"
                                                       class="nav-link {{is_active('mobile.fdl')}}">{{__('fdl_screen_content')}}</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                @endcan--}}

            {{-- <li class="nav-item">
                 <a class="nav-link" href="./examples/icons.html">
                     <i class="ni ni-planet text-blue"></i> Icons
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./examples/maps.html">
                     <i class="ni ni-pin-3 text-orange"></i> Maps
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./examples/profile.html">
                     <i class="ni ni-single-02 text-yellow"></i> User profile
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./examples/tables.html">
                     <i class="ni ni-bullet-list-67 text-red"></i> Tables
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./examples/login.html">
                     <i class="ni ni-key-25 text-info"></i> Login
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="./examples/register.html">
                     <i class="ni ni-circle-08 text-pink"></i> Register
                 </a>
             </li>--}}
            </ul>
            {{--<!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                       href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
            </ul>
            --}}
        </div>
    </div>
</nav>
