@extends('layouts.employee_layout')
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
                @if (session()->has('success'))
                    <div class="alert alert-custom alert-light-success fade show mb-5 d-flex py-2" role="alert">
                        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                        <div class="alert-text">{{ session()->get('success') }}
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                @endif
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
                                <!--begin::Nav-->
                                <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="{{ route('employee.change_password') }}" class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                                fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-size-lg">Change Password</span>
                                        </a>
                                    </div>
                                </div>
                                <!--end::Nav-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Profile Card-->
                    </div>

                    <div class="col-md-8 col-sm-12 ">
                        <!--begin::Card-->
                        <div class="card card-custom  my-auto pt-4" id="account_info">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <div class="card-title w-100 justify-content-between">
                                    <div class="float-left">
                                        <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                    </div>
                                    <div> <a href="{{ route('employee.edit_profile') }}"> <button
                                                class="btn btn-sm btn-primary ">Edit Profile</button> </a> </div>
                                </div>


                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{ route('employee.change_password') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <div class="input-group mb-4">
                                                <input type="password" class="form-control password" name="new_password"
                                                    placeholder="Enter new Password" aria-describedby="basic-addon2" />
                                                <div class="input-group-append"><span class="input-group-text"><i
                                                            class="flaticon-medical icon-lg"></i></span>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-primary">Change Password</button>

                                        </div>
                                    </div>

                                    <!--begin::Form Group-->

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
    <script>
        $(".input-group-append").on("click", () => {
            if ($('.password').attr('type') == "password") {
                $('.password').attr('type', 'text');
            } else {
                $('.password').attr('type', 'password');
            }
        });
    </script>
@endsection
