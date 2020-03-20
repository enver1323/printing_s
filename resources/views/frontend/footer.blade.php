<footer class="page-footer rgba-stylish-strong text-center text-md-left mt-0 pt-4">

    <!--Footer Links-->
    <div class="container">

        <!-- Footer links -->
        <div class="row text-center text-md-left mt-3 pb-3">

            <!--First column-->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">{{__('frontend.about_us')}}</h6>
                @foreach($pages as $page)
                    <p>
                        <a href="{{route('about.page', $page)}}">{{ $page->name }}</a>
                    </p>
                @endforeach
            </div>
            <!--/.First column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Second column-->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">{{__('frontend.categories')}}</h6>
                @foreach($categories as $category)
                <p>
                    <a href="{{route('products.category', $category)}}">{{ $category->name }}</a>
                </p>
                    @endforeach
            </div>
            <!--/.Second column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Third column-->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">{{__('frontend.brands')}}</h6>
                @foreach($brands as $brand)
                <p>
                    <a href="{{route('products.brand')}}">{{$brand->name}}</a>
                </p>
                @endforeach
            </div>
            <!--/.Third column-->

            <hr class="w-100 clearfix d-md-none">

            <!--Fourth column-->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 font-weight-bold">{{__('frontend.contacts')}}</h6>
                <p>
                    <i class="fa fa-envelope mr-3"></i>
                    support@intach.di
                </p>
                <p>
                    <i class="fa fa-phone mr-3"></i>
                    +998909791130
                </p>
                <p>
                    <i class="fa fa-print mr-3"></i>
                    +998909791130
                </p>
            </div>
            <!--/.Fourth column-->

        </div>
        <!-- Footer links -->

        <hr>
        <div class="row py-3 d-flex align-items-center">

            <!--Grid column-->
            <div class="col-md-7 col-lg-8">

                <!--Copyright-->
                <p class="text-center text-md-left grey-text">
                    © {{date('Y')}} Copyright: <a href="{{route('main')}}" target="_blank"> {{getenv('app')}} </a>
                </p>
                <!--/.Copyright-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-5 col-lg-4 ml-lg-0">

                <!--Social buttons-->
                <div class="social-section text-center text-md-left">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0">
                                <i class="fa fa-2x fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0">
                                <i class="fa fa-2x fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0">
                                <i class="fa fa-2x fa-google"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0">
                                <i class="fa fa-2x fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--/.Social buttons-->

            </div>
            <!--Grid column-->

        </div>

    </div>

</footer>
