<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img
                src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img
                src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img
                src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img
                src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{asset('assets/img/1.jpg')}}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{ Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            @can('index.show')
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/') }}">
                    <img class="side-menu__icon"
                        src="{{url('https://img.icons8.com/fluency/48/000000/dashboard-layout.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Dashboard')}}</span>
                </a>
            </li>
            @endcan
            @canany(['admins.view' , 'clients.view' , 'categories.view' , 'work.view' , 'role.view' , 'services.view' , 'Settings.view'])
            <li class="side-item side-item-category">General</li>
            @endcanany
            @canany(['admins.view' , 'clients.view'])
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                        src="{{url('https://img.icons8.com/external-icongeek26-outline-colour-icongeek26/64/000000/external-monitor-online-education-icongeek26-outline-colour-icongeek26-1.png')}}" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Client Admins')}}</span>
                    <i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('admins.view')
                    <li><a class="slide-item" style=" font-weight: bold;"
                            href="{{ route('admin') }}">{{trans('Admins')}}</a></li>
                    @endcan
                    @can('clients.view')
                    <li><a class="slide-item" style=" font-weight: bold;"
                            href="{{ route('clients') }}">{{trans('Clients')}}</a></li>
                    @endcan

                </ul>

            </li>
            @endcanany
            @canany(['categories.view' , 'work.view'])
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <img class="side-menu__icon" style=" width: 30px; height: 30px;"
                        src="{{url('https://img.icons8.com/nolan/344/work.png')}}" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Works')}}</span>
                    <i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('categories.view')
                    <li><a class="slide-item" style=" font-weight: bold;"
                            href="{{ route('categore.create') }}">{{trans('categores')}}</a></li>
                    @endcan
                    @can('work.view')
                    <li><a class="slide-item" style=" font-weight: bold;"
                            href="{{ route('work.index') }}">{{trans('Work')}}</a></li>
                    @endcan
                </ul>

            </li>
            @endcanany
            @can('role.view')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('roles.index') }}">
                    <img class="side-menu__icon"
                        src="{{url('https://img.icons8.com/external-filled-color-icons-papa-vector/344/external-Setting-protecting-privacy-online-filled-color-icons-papa-vector.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Roles')}}</span>
                </a>
            </li>
            @endcan
            @can('services.view')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('service.index') }}">

                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/344/service.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Services')}}</span>

                </a>
            </li>
            @endcan
            @can('Settings.view')
            <li class="slide">
                <a class="side-menu__item" href="{{route('edite.setting.general')}}">

                    <img class="side-menu__icon" src="{{url('https://img.icons8.com/nolan/64/settings--v1.png')}}"
                        style=" width: 30px; height: 30px;" />
                    <span class="side-menu__label" style=" font-weight: bold;">{{trans('Settings')}}</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->