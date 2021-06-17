@extends('welcome')

@section('page_title')
    Contact Us
@endsection

@section('content')
    <div class="container-fluid bg-dark text-white parallax-contact p-5" style="max-height: 350rem !important;">

        <div class="justify-content-center mt-5">
            <div class="col-12 text-center">
                <h1 class="display-5 _xs d-lg-none d-md-none text-center font-weight-bold mb-5">
                    CONTACT <br class=""> US
                </h1>

                <h1
                    class="display-4 text-primar text-center d-none d-lg-inline-block d-md-inline-block font-weight-bold mb-5">
                    CONTACT US
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

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt my-2 about-title"></i>
                        <p>
                            Campus 1: No.32 Uratta Road, by Railway Crossing
                        </p>
                        <p>
                            Campus 2: Plot 5 Ugorji Street, by Railway
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-phone my-2 about-title"></i>
                        <p>
                            +234 803 294 0163
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope my-2 about-title"></i>
                        <p>
                            <a href="mailto:christutors@yahoo.com " class="text-primary-y">
                                christutors@yahoo.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow-lg" style="border: 0 !important; cursor: pointer;" v-scrollAnime>
                    <div class="card-body pt-5">
                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control shadow-sm" placeholder="Name" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control shadow-sm" placeholder="Phone" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control shadow-sm" placeholder="Message" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="" class="form-control shadow-sm" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-2 text-center">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="btn btn-primary-y text-white">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe id="gmap_canvas" class="img-fluid"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.7206724814478!2d7.33624641476408!3d5.148591196263695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10429a31a6ccbc9f%3A0xbbb53986e3822beb!2sUmuodu%20Rd%2C%20Aba!5e0!3m2!1sen!2sng!4v1611151493479!5m2!1sen!2sng"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                            href="https://yt2.org"></a><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
