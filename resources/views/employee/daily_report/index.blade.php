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
                    @endif
                    @include('employee.daily_report.data')
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
        // Initialization
        jQuery(document).ready(function() {
            KTTinymce.init();
        });
    </script>
    <script>
        function loadMoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html",
                    beforeSend: function() {
                        $('.ajax-load').show();
                    }

                }).done(function(data) {


                    if (data.html === "" || data.html === " ") {
                        $('.ajax-load').html('');
                        $('.ajax-load').hide();
                        return;
                    } else {

                        $('#post_data').append(data.html);
                        $('.ajax-load').hide();
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    //alert('No response from server');
                    console.log(thrownError);
                })


        }
        var page = 1;
        $(document).scroll(function() {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.submit_btn').on("click", (e) => {
                $(`#update_form` + e.target.getAttribute('data-id')).submit();
            });
        });
    </script>
@endsection
