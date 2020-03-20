<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('main') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <div class="logo"></div>
        </div>
        <div class="sidebar-brand-text mx-1">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{request()->routeIs('admin.home') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('breadcrumbs.dashboard')}}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Printing
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{request()->routeIs('admin.users*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-users fa-user-alt-slash"></i>
            <span>{{__('breadcrumbs.users')}}</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        {{__('adminPanel.systems')}}
    </div>

    <li class="nav-item {{request()->routeIs('admin.languages*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.languages.index') }}">
            <i class="fas fa-language"></i>
            <span>{{__('breadcrumbs.languages')}}</span>
        </a>
    </li>
    <li class="nav-item {{request()->routeIs('admin.slides*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.slides.index') }}">
            <i class="fas fa-image"></i>
            <span>{{__('breadcrumbs.slides')}}</span>
        </a>
    </li>
    <li class="nav-item {{request()->routeIs('admin.articles*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.articles.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>{{__('breadcrumbs.articles')}}</span>
        </a>
    </li>

    <li class="nav-item {{request()->routeIs('admin.pages*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.pages.index') }}">
            <i class="fas fa-file-word"></i>
            <span>{{__('breadcrumbs.pages')}}</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        {{__('adminPanel.products')}}
    </div>

    <li class="nav-item {{request()->routeIs('admin.categories*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-list"></i>
            <span>{{__('breadcrumbs.categories')}}</span>
        </a>
    </li>

    <li class="nav-item {{request()->routeIs('admin.brands*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.brands.index') }}">
            <i class="fas fa-shield-alt"></i>
            <span>{{__('breadcrumbs.brands')}}</span>
        </a>
    </li>

    <li class="nav-item {{request()->routeIs('admin.lines*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.lines.index') }}">
            <i class="fas fa-align-justify"></i>
            <span>{{__('breadcrumbs.lines')}}</span>
        </a>
    </li>

    <li class="nav-item {{request()->routeIs('admin.products*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-boxes"></i>
            <span>{{__('breadcrumbs.products')}}</span>
        </a>
    </li>

<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
