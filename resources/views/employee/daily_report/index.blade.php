@extends('layouts.employee_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:0px;">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="container" id="post_data">
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
@endsection
