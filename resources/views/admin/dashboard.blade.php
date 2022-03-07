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

                    <div class="col-3">
                        <div class="card card-custom ">

                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <i class="fas fa-chart-bar"></i>
                                        Checked In
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body cardScroll">
                                {{-- Employee Card Starts --}}
                                <div class=" chat-app">
                                    <div id="plist" class="people-list">
                                        <ul class="list-unstyled chat-list mt-2 mb-0">
                                            @foreach ($employee_checked_in as $item)
                                                <li class="clearfix active">
                                                    <img src="{{ $item->image == null ? asset('./files/profile_pics/pp.jpg') : asset('files/profile_pics/' . $item->image) }}"
                                                        alt="avatar">
                                                    <div class="about">
                                                        <div class="name"> <b>{{ $item->name }}</b> -
                                                            {{ $item->position }}
                                                        </div>
                                                        <div class="status"> <i class="fa fa-circle online"></i>
                                                            online
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                {{-- Employee Card Ends --}}


                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card card-custom">

                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <i class="fas fa-chart-bar"></i>
                                        Checked Out
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body cardScroll">
                                {{-- Employee Card Starts --}}
                                <div class=" chat-app">
                                    <div id="plist" class="people-list">
                                        <ul class="list-unstyled chat-list mt-2 mb-0">
                                            @foreach ($employee_checked_out as $item)
                                                <li class="clearfix active mb-2">
                                                    <img src="{{ $item->image == null ? asset('./files/profile_pics/pp.jpg') : asset('files/profile_pics/' . $item->image) }}"
                                                        alt="avatar">
                                                    <div class="about">
                                                        <div class="name"> <b>{{ $item->name }}</b> -
                                                            {{ $item->position }}
                                                        </div>
                                                        <div class="status"> <i class="fa fa-circle away"></i>
                                                            away
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                {{-- Employee Card Ends --}}


                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card card-custom ">

                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <i class="fas fa-chart-bar"></i>
                                        On Leave
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body cardScroll">
                                {{-- Employee Card Starts --}}
                                <div class=" chat-app">
                                    <div id="plist" class="people-list">
                                        <ul class="list-unstyled chat-list mt-2 mb-0">
                                            @foreach ($employee_checked_in as $item)
                                                <li class="clearfix active">
                                                    <img src="{{ $item->image == null ? asset('./files/profile_pics/pp.jpg') : asset('files/profile_pics/' . $item->image) }}"
                                                        alt="avatar">
                                                    <div class="about">
                                                        <div class="name"> <b>{{ $item->name }}</b> -
                                                            {{ $item->position }}
                                                        </div>
                                                        <div class="status"> <i class="fa fa-circle online"></i>
                                                            online
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                {{-- Employee Card Ends --}}


                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="card card-custom ">

                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <i class="fas fa-chart-bar"></i>
                                        Home Office
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body cardScroll">
                                {{-- Employee Card Starts --}}
                                <div class=" chat-app">
                                    <div id="plist" class="people-list">
                                        <ul class="list-unstyled chat-list mt-2 mb-0">
                                            @foreach ($employee_checked_in as $item)
                                                <li class="clearfix active">
                                                    <img src="{{ $item->image == null ? asset('./files/profile_pics/pp.jpg') : asset('files/profile_pics/' . $item->image) }}"
                                                        alt="avatar">
                                                    <div class="about">
                                                        <div class="name"> <b>{{ $item->name }}</b> -
                                                            {{ $item->position }}
                                                        </div>
                                                        <div class="status"> <i class="fa fa-circle online"></i>
                                                            online
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                {{-- Employee Card Ends --}}


                            </div>
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
