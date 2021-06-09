@extends('welcome')

@section('page_title')
    Our Services
@endsection

@section('content')
    <div class="container-fluid bg-dark text-white parallax-abt p-5" style="max-height: 350rem !important;">

        <div class="justify-content-center mt-5">
            <div class="col-12 text-center">
                <h1 class="display-5 _xs d-lg-none d-md-none text-center font-weight-bold mb-5">
                    OUR <br class=""> SERVICES
                </h1>

                <h1
                    class="display-4 text-primar text-center d-none d-lg-inline-block d-md-inline-block font-weight-bold mb-5">
                    OUR SERVICES
                </h1>
                <p class="card-text col-lg- text-dark-x mb-5">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia eveniet, reiciendis incidunt officia
                    eos natus quasi labore quo in sit corporis ut earum maxime quam amet voluptates asperiores nemo
                    consectetur.
                </p>

            </div>

            <div class="col-lg-6 col-md-12 col-sm-12" style="">

            </div>
        </div>
    </div>

    <div class="container my-5" style="margin-bottom: 10rem !important;">
        <div class="row">
            <div class="col-lg-6  col-md-12 col-sm-12">
                <div class="wthree-services-bottom-grids">
                    <div class="wthree-services-left">
                        <img src="{{ asset('assets/images/ab1.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="wthree-services-right">
                        <img src="{{ asset('assets/images/ab2.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="wthree-about-grids">
                    <h4 class="text-center">Welcome to Our University</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
