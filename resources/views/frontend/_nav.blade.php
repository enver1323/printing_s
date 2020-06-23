<div class="fixed-top">
    <div class="top-bar">
        <div class="top-bar-socials">
            <a href="tel:998712565354" target="_blank">
                <i class="fa fa-phone white-text"> </i>
                +998 71 2565354
            </a>
            <a href="https://t.me/FastCardBot" target="_blank">
                <i class="fa fa-telegram fa-lg white-text"> </i>
                {{__('frontend.orderCards')}}
            </a>
        </div>
        <div class="align-content-center d-none d-lg-flex">
            <button class="btn btn-sm btn-white my-0 ml-sm-2 bvi-open" type="button">
                <i class="fa fa-eye fa-lg"></i>
            </button>
            <form class="form-inline ml-auto" action="{{route('results')}}">
                <div class="md-form form-sm my-0">
                    <input class="text-white" type="text" placeholder="Search" aria-label="Search" name="search">
                </div>
                <button class="btn btn-sm btn-outline-white my-0 ml-sm-2" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl navbar-dark top-bar top-nav-collapse">
        <a class="navbar-brand m-0 p-0" href="{{route('main')}}">
            <img src="{{asset('images/logo.png')}}" alt="{{config('app.name')}}"/>
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav"
                aria-controls="mainNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="mainNav">

            <!-- Links -->
            <ul class="navbar-nav ml-auto d-flex">
                @if(count($pages))
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" id="navbarAboutLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{__('frontend.about_us')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarAboutLink">
                            @foreach($pages as $page)
                                <a class="dropdown-item text-center"
                                   href="{{route('about.page', $page)}}">
                                    {{ $page->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif
                @if(count($brands))
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" id="navbarBrandsLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{__('frontend.brands')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarBrandsLink">
                            @foreach($brands as $brand)
                                <a class="dropdown-item text-center"
                                   href="{{route('products.brand', $brand)}}">
                                    {{ $brand->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif
                @if(count($categories))
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" id="navbarCategoriesLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" href="{{route('products.category')}}">
                            {{__('frontend.categories')}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarCategoriesLink">
                            @foreach($categories as $category)
                                <a class="dropdown-item text-center"
                                   href="{{route('products.category', $category)}}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif

                <li class="nav-item my-auto">
                    <a class="nav-link" href="{{route('articles.index')}}">{{__('frontend.articles')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <li class="nav-item my-auto">
                    <a class="nav-link" href="{{route('contacts')}}">{{__('frontend.contacts')}}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item my-auto d-block d-md-none">
                    <a href="tel:998712565354" target="_blank" class="nav-link">
                        <i class="fa fa-phone white-text"> </i>
                        +998 71 2565354
                    </a>
                </li>
                <li class="nav-item my-auto d-block d-md-none">
                    <a href="mailto:info@intach-di.com" target="_blank" class="nav-link">
                        <i class="fa fa-envelope white-text"> </i>
                        info@intach-di.com
                    </a>
                </li>
                <li class="nav-item my-auto d-flex d-md-none">
                    <button class="btn btn-sm btn-outline-white my-0 ml-sm-2 bvi-open h-auto" type="button">
                        <i class="fa fa-eye"></i>
                    </button>
                    <form class="ml-auto d-flex" action="{{route('results')}}">
                        <div class="md-form form-sm my-0">
                            <input class="text-white w-100" type="text" placeholder="Search" aria-label="Search"
                                   name="search">
                        </div>
                        <button class="btn btn-sm btn-outline-white my-0 ml-sm-2" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </li>

                <li class="nav-item dropdown my-auto">
                    <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"><i
                            class="fa fa-language"></i> {{ LaravelLocalization::getCurrentLocale() }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdownMenuLink">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item text-center"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </li>

                <!-- Authentication Links -->
                @auth
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="fa fa-user"></i> {{ request()->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdownMenuLink">
                            @if(request()->user()->isAdmin())
                                <a class="dropdown-item text-center" href="{{ route('admin.home') }}">
                                    {{ __('Admin') }}
                                </a>
                            @endif
                            <a class="dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout')}}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
            <!-- /Links -->
        </div>
        <!-- /Collapsible content -->
    </nav>
    <!-- /Navbar -->
</div>
