@extends('layouts.admin_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid justify-content-center" id="kt_content">
        <!--begin::Entry-->
        <div>
            <!--begin::Container-->
            <div class="container">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    @if($msg == 'success')
                                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

                                    @else
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endif
                @endforeach
                <!--begin::Profile Account Information-->
                <div class="row ">
                   
                    <div class="col-md-4 col-sm-12 ">
                        <!--begin::Profile Card-->
                        <div class="card card-custom  my-auto">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::User-->
                                <div>
                                    <div class="image-input" id="kt_image_4"
                                        style="background-image: url(assets/media/users/blank.png)">
                                        <div class="image-input-wrapper"
                                            style="background-image: url({{ $user->image == null ? asset('./files/profile_pics/pp.jpg') : asset('files/profile_pics/' . $user->image) }})">
                                        </div>
                                    </div>

                                </div>
                                <div class="pt-2">
                                    <a href="#"
                                        class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                                    <div class="text-muted">{{ Str::ucfirst($user->role) }}</div>
                                </div>
                                <!--end::User-->
                                <!--begin::Contact-->
                                <div class="py-9">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Email:</span>
                                        <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="font-weight-bold mr-2">Phone:</span>
                                        <span
                                            class="text-muted">{{ empty($user->number) ? '-' : $user->number }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="font-weight-bold mr-2">Joined :</span>
                                        <span class="text-muted">
                                            {{ Carbon\Carbon::parse($user->created_at)->format('M d Y') }} </span>
                                    </div>
                                </div>
                                <!--end::Contact-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Profile Card-->
                    </div>

                    <div class="col-md-8 col-sm-12 ">
                        <!--begin::Card-->
                        <div class="card card-custom  my-auto pt-4" id="account_info">
                            <!--begin::Header-->
                            <div class="card-header py-5 ">



                                            <h3 class="card-title font-weight-bold text-dark">Account Information</h3>




                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form">
                                <div class="card-body">
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="">
                                                <input class="form-control form-control-lg form-control-solid" type="text"
                                                    value="{{ $user->name }}" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-at"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg form-control-solid"
                                                    value="{{ $user->email }}" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Number</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg form-control-solid"
                                                    value="{{ $user->number }}" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Position </label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input type="text" class="form-control form-control-lg form-control-solid"
                                                    value="{{ $user->position }}" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <!--end::Form-->
                        </div>
                    </div>

                </div>
                <!--end::Profile Account Information-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
@endsection
