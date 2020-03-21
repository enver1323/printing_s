<div class="fixed-top">
    <div class="top-bar">
        <div class="top-bar-socials">
            <a href="https://www.instagram.com/uzbekjewellery/" target="_blank">
                <i class="fa fa-phone white-text"> </i>
                +998909791130
            </a>
            <a href="https://www.instagram.com/uzbekjewellery/" target="_blank">
                <i class="fa fa-envelope white-text"> </i>
                support@intach.di
            </a>
        </div>
        <div class="d-flex align-content-center">
            <button class="btn btn-sm btn-outline-white my-0 ml-sm-2 bvi-open" type="button">
                <i class="fa fa-eye"></i>
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
    <nav class="navbar navbar-expand-xl navbar-dark scrolling-navbar ">
        <a class="navbar-brand" href="{{route('main')}}">
            <img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}"/>
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
                @if(!$pages->isEmpty())
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
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="{{ route('login') }}">
                            <i class="fa fa-sign-in"></i> {{ __('auth.sign_in') }}
                        </a>
                    </li>
                @else
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
                @endguest
            </ul>
            <!-- /Links -->
        </div>
        <!-- /Collapsible content -->
    </nav>
    <!-- /Navbar -->
</div>
