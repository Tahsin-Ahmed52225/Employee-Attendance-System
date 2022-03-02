@extends('layouts.admin_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('dev-assets/css/admin_dashboard.css') }}">
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top: 0px;">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-9">
                        <div class="card card-custom">

                            <div class="card-body"></div>

                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card card-custom ">

                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <i class="fas fa-chart-bar"></i>
                                        Employee Online
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body"></div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
@endsection
