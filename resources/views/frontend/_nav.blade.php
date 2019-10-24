<!-- Navbar -->
<nav class="navbar navbar-expand-xl navbar-dark scrolling-navbar fixed-top">

    <a class="navbar-brand" href="{{route('main')}}">
        <img src="{{asset('images/logo.svg')}}" alt="{{env('APP_NAME')}}"/>
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
            <li class="nav-item my-auto">
                <a class="nav-link" href="{{route('main')}}">{{__('frontend.home')}}
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item my-auto">
                <a class="nav-link" href="{{route('products.brand')}}">{{__('frontend.brands')}}
                    <span class="sr-only">(current)</span>
                </a>
            </li>

            <li class="nav-item my-auto">
                <a class="nav-link" href="{{route('products.category')}}">{{__('frontend.categories')}}
                    <span class="sr-only">(current)</span>
                </a>
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
                   aria-expanded="false"><i class="fa fa-language"></i> {{ LaravelLocalization::getCurrentLocale() }}
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
                        <a class="dropdown-item text-center"
                           href="{{ route('cabinet.home') }}">{{ __('Cabinet') }}</a>
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
