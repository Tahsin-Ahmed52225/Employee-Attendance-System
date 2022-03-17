@extends('layouts.employee_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('dev-assets/css/daily_update.css') }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    <script>
        // Class definition

        var KTTinymce = function() {
            // Private functions
            var demos = function() {
                tinymce.init({
                    selector: '#kt-tinymce-3',
                    menubar: false,
                    toolbar: ['styleselect fontselect fontsizeselect',
                        'undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify',
                        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview '
                    ],
                    plugins: 'advlist autolink link  lists charmap print preview'
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
        jQuery(document).ready(function() {
            KTTinymce.init();
        });
    </script>
@endsection
