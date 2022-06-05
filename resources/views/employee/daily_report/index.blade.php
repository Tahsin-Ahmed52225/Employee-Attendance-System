@extends('layouts.employee_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('dev-assets/css/daily_update.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>

    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:0px;">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="container" id="post_data">
                    <div id="update_msg">
                    </div>
                    {{-- @if (session()->has('success'))
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
                    @if (session()->has('rejected'))
                        <div class="alert alert-custom alert-light-danger fade show mb-5 d-flex py-2" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{{ session()->get('rejected') }}
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('warning'))
                        <div class="alert alert-custom alert-light-warning fade show mb-5 d-flex py-2" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{{ session()->get('warning') }}
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif --}}

                        <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" id="MonthSelect">
                                                    <option selected value="">Choose Month</option>
                                                    <option value=1>January</option>
                                                    <option value=2>February</option>
                                                    <option value=3>March</option>
                                                    <option value=4>April</option>
                                                    <option value=5>May</option>
                                                    <option value=6>June</option>
                                                    <option value=7>July</option>
                                                    <option value=8>August</option>
                                                    <option value=9>Sepember</option>
                                                    <option value=10>Octorber</option>
                                                    <option value=11>November</option>
                                                    <option value=12>December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control" id="YearSelect">
                                                    <option selected value="">Choose Year</option>
                                                    <option value={{  Carbon\Carbon::now()->year-2 }}>{{  Carbon\Carbon::now()->year-2 }}</option>
                                                    <option value={{ Carbon\Carbon::now()->year-1}}>{{  Carbon\Carbon::now()->year-1 }}</option>
                                                    <option value={{ Carbon\Carbon::now()->year}}>{{  Carbon\Carbon::now()->year }}</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary" id="get_data">Get Data</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="float-right">
                                            <a href="{{ route("employee.daily_update") }}"><button class="btn btn-primary" id="get_data"><i class="flaticon2-refresh-arrow icon-lg"></i></button></a>
                                                <button class="btn btn-primary" id="get_data"><i class="flaticon2-print icon-lg"></i></button>
                                            </div>
                                        </div>
                            </div>



{{-------------------------------------------------------------- All daily update starts  -------------------------------------------------------------}}
                         @if(count($updates)>0)
                            @foreach ($updates as $item)
                                <div class="card mb-2 update_card">
                                    <div class="card-header ">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div style="font-size:12px; font-weight:700;">{{ $item->name }} -
                                                    <span style="font-weight: 500;">
                                                        {{ \Carbon\Carbon::parse($item->check_out)->format('d M Y') }} at
                                                        {{ \Carbon\Carbon::parse($item->check_out)->format('h:i') }}
                                                    </span>
                                                    <span>
                                                        @if ($item->update_status)
                                                            <span class="badge badge-pill badge-success">updated</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card-toolbar float-right">
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="ki ki-bold-more-hor"></i>
                                                        </a>
                                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-sm">
                                                            <!--begin::Navigation-->
                                                            <ul class="navi navi-hover">
                                                                <li class="navi-item" data-toggle="modal"

                                                                    data-target=".exampleModalCenter">
                                                                    <a href="#" class="navi-link" data-itemID="{{ $item->id }}">
                                                                        <i class="flaticon-edit mr-2" data-itemID="{{ $item->id }}"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <i class="flaticon2-gear mr-2"></i>
                                                                        <span>Settings</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <!--end::Navigation-->
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                    </div>
                                    <div class="card-body">

                                        <div id="dailyUpdate{{ $item->id }}" style="font-size:12px;">
                                            {!! $item->daily_update !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- Update Daily Update Starts --}}
                                <div class="modal fade exampleModalCenter" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered update_card" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                Update</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="was-validated" method="POST"
                                                action="{{ route('employee.update_task', encrypt($item->id)) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <textarea id="update_box"  class="kt-tinymce-3" placeholder="message" required>
                                                    </textarea>
                                                    @error('details')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                            <button type="button"
                                                class="btn btn-primary submit_btn" data-dismiss="modal">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Update Daily Update Ends --}}
                        @else
                            <div class="card mb-2 update_card">
                                <div class="card-header ">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div style="font-size:12px; text-align:center">No Data Found
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


{{-------------------------------------------------------------- All daily update ends  -------------------------------------------------------------}}
                </div>
                <div class="ajax-load text-center" style=" display: none;">
                    <p><img style="height:100px;" src="{{ asset('images/loader.gif') }}">Loading More</p>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script>
        // Class definition

        var KTTinymce = function() {
            // Private functions
            var demos = function() {
                tinymce.init({
                    selector: '.kt-tinymce-3',
                    menubar: false,
                    toolbar: ['styleselect fontselect fontsizeselect',
                        'undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify',
                        'bullist numlist | outdent indent | blockquote subscript superscript | lists charmap | print preview '
                    ],
                    plugins: 'advlist autolink link  lists charmap '
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        // Initialization
        KTTinymce.init();
    </script>
    <script src="{{ asset("dev-assets/js/sort_project.js") }}"></script>
@endsection
