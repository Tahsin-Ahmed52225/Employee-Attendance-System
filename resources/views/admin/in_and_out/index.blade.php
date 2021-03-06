@extends('layouts.admin_layout')

{{-- Page custom links --}}
@section('links')
    <link rel="stylesheet" href="{{ asset('dev-assets/css/timer.css') }}">
@endsection('links')


@section('content')
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <div id="page_name" class="container">
            <div id="time_msg"></div>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3 ">
                                    <div id="timer_label" class="text-xs font-weight-bold text-primary text-uppercase mb-5">
                                        TIMER
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div id="stopwatch" style="font-size: 60px;" class="mb-0 font-weight-bold text-gray">
                                        00:00:00 </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="row mb-2">
                                        <button id="start_button" class="clock_button btn btn btn-success"
                                            style="width:100px">Check In</button>
                                    </div>
                                    <div class="row">
                                        <button class="clock_button btn btn-danger " data-toggle="modal"
                                            data-target="#exampleModalCenter" style="width:100px">Check Out</button>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- check in modal starts  -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Description</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="was-validated">
                                    <div class="mb-3">
                                        <textarea id="kt-tinymce-3" name="description" class="tox-target @error('details') is-invalid @enderror"
                                            placeholder="message" required>
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

                                <button type="button" id="timer_submit" class="btn btn-primary"
                                    data-dismiss="modal">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- check in modal ends  -->

                <!-- Earnings (Monthly) Card Example -->


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection('content')


@section('scripts')
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
    <script src={{ asset('dev-assets/js/timer.js') }}></script>
@endsection
