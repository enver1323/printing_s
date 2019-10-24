<!--Footer-->
<footer>
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-lg-6 col-md-12">
                <div class="footer-col">
                    <h5 class="title">ABOUT {{env('APP_NAME')}}</h5>
                    <div>
                        <img src="{{asset('images/logo.svg')}}" alt="{{env('APP_NAME')}}"/>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quibusdam assumenda sequi ducimus temporibus dolore, libero inventore dolorum error illo.
                    </p>

                </div>
            </div>
            <!--/About -->

            <!-- Done by -->
            <div class="col-lg-6 col-md-12">
                <div class="footer-col">
                    <h5>Project by</h5>
                    <p>Enver Menadjiev</p>
                    <p>
                        <i class="fas fa-phone pr-3 mb-2 blue-text"></i>
                        +998 90 326 84 03
                    </p>
                </div>
            </div>
            <!-- /Done by -->
        </div>
    </div>

    <!--Copyright-->
    <div class="copyright">
        <div class="container-fluid">
            <p>
                © {{date("Y")}} Copyright: <a href="{{route('main')}}" target="_blank"> {{env('APP_NAME')}} </a>
            </p>
        </div>
    </div>
    <!--/Copyright-->

</footer>
<!--/Footer-->
