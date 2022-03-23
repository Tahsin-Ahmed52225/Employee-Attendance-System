@extends('layouts.admin_layout')


@section('links')
    <link rel="stylesheet" href="{{ asset('dev-assets/css/settings.css') }}">
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid justify-content-center" id="kt_content"
        style="padding-top:0px;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="bg-white rounded-lg shadow-sm mb-4" style="padding: 50px    30px;">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills nav-fill mb-5">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-card" class="nav-link active pill">
                                    System Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link pill">
                                    Personalization Settings
                                </a>
                            </li>
                        </ul>
                        <!-- End -->


                        <!-- Credit card form content -->
                        <div class="tab-content mt-5">

                            <!-- credit card info-->
                            <div id="nav-tab-card" class="tab-pane fade show active">
                                @if (session()->has('success'))
                                    <div class="alert alert-custom alert-light-success fade show mb-5 d-flex py-2"
                                        role="alert">
                                        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                                        <div class="alert-text">{{ session()->get('success') }}
                                        </div>
                                        <div class="alert-close">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('warning'))
                                    <div class="alert alert-custom alert-light-warning fade show mb-5 d-flex py-2"
                                        role="alert">
                                        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                                        <div class="alert-text">{{ session()->get('warning') }}
                                        </div>
                                        <div class="alert-close">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <form role="form" method="POST" action="{{ route('admin.settings') }}">
                                    @csrf
                                    <div class="form-group row align-items-center">
                                        <label class="col-form-label  col-lg-3 col-sm-12">Office Time Starts

                                        </label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <div class="input-group timepicker">
                                                <input name="office_time_starts" class="form-control" id="kt_timepicker_2"
                                                    readonly placeholder="Select time" type="text" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-clock-o"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <i class="flaticon2-information " data-toggle="tooltip" data-placement="right"
                                            title="Input time should be on 24hr format"> </i>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-form-label  col-lg-3 col-sm-12">Office Time Ends</label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <div class="input-group timepicker">
                                                <input name="office_time_ends" class="form-control" id="kt_timepicker_2"
                                                    readonly placeholder="Select time" type="text" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-clock-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="flaticon2-information"> </i>
                                    </div>
                                    <div class="form-group row align-items-center   ">
                                        <label class="col-form-label  col-lg-3 col-sm-12">Office Hours</label>
                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                            <div class="input-group ">
                                                <input name="office_hours" class="form-control" placeholder="Select time"
                                                    type="number" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-clock-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="flaticon2-information"> </i>
                                    </div>
                                    <button type="submit" class="subscribe btn btn-primary btn-block pill shadow-sm">
                                        Save Changes
                                    </button>
                                </form>
                            </div>
                            <!-- End -->

                            <!-- Paypal info -->
                            <div id="nav-tab-paypal" class="tab-pane fade p-3">
                                <div class="p-5 bg-light text-center">On process</div>
                            </div>
                            <!-- End -->
                        </div>
                        <!-- End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('dev-assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}">
    </script>
@endsection
