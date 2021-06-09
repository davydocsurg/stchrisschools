<div class="container-fluid bg-dark text-white parallax-x p-5 my-5" style="max-height: 350rem !important;">
    <div class="justify-content-center mt-5">
        <div class="col-12 text-center">

            <div class="row text-center justify-content-center align-items-center">
                {{-- <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <b></b>
                            <br>
                            <b>{{ count($users) }}</b>
                        </div>
                    </div>
                </div> --}}

                <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="text-center text-white my-4">
                        <i class="fas fa-chalkboard-teacher display-4"></i>
                        <br>
                        <b class="display-4 my-3">{{ count($teachers) }}</b>
                        <br>
                    </div>

                    <div class="card bg-warning">
                        <div class="card-body">
                            <h3>Teachers</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="text-center text-white my-4">
                        <i class="fas fa-user-tie display-4"></i>
                        <br>
                        <b class="display-4 my-3">{{ count($parents) }}</b>
                        <br>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body">
                            <h3>Parents</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="text-center text-white my-4">
                        <i class="fas fa-users display-4"></i>
                        <br>
                        <b class="display-4 my-3">{{ count($students) }}</b>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body">
                            <h3 class="">Students</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12" style="">

        </div>
    </div>
</div>
