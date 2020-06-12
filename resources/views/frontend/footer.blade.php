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
                    <a href="mailto:info@intach-di.com" class="text-white" target="_blank">
                        <i class="fa fa-envelope mr-3"></i>
                        info@intach-di.com
                    </a>
                </p>
                <p>
                    <a href="tel:+998712565354" class="text-white" target="_blank">
                        <i class="fa fa-phone mr-3"></i>
                        +998712565354
                    </a>
                </p>
                <p>
                    <a href="tel:+998712565354" class="text-white" target="_blank">
                        <i class="fa fa-print mr-3"></i>
                        +998712565354
                    </a>
                </p>
                <p>
                    <a href="https://g.page/Intach-DI?share" class="text-white" target="_blank">
                        <i class="fa fa-location-arrow mr-3"></i>
                        {{__('frontend.location')}}
                    </a>
                </p>
                <p>
                    <a href="https://g.page/Intach-DI?share" class="text-white" target="_blank">
                        <i class="fa fa-search-location mr-3"></i>
                        {{__('frontend.fullLocation')}}
                    </a>
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
                    © {{date('Y')}} Copyright: <a href="{{route('main')}}" target="_blank"> {{config('app.name')}} </a>
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
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0"
                               href="https://www.facebook.com/intach.di.polygraphy/" target="_blank">
                                <i class="fa fa-2x fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0"
                               href="https://instagram.com/intach.di?igshid=1oclefs62n4ji" target="_blank">
                                <i class="fa fa-2x fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0"
                               href="https://t.me/intach_di" target="_blank">
                                <i class="fa fa-2x fa-telegram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a class="btn-floating btn-sm rgba-white-slight mr-xl-4 waves-effect waves-light p-0"
                               href="mailto:info@intach-di.com" target="_blank">
                                <i class="fa fa-2x fa-envelope"></i>
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
