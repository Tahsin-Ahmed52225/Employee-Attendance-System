@extends('layouts.admin_layout')

@section('links')
    <link rel="stylesheet" href="{{ asset('dev-assets/css/datatable.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container ">
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
            <div class="card">
                <div class="card-header mt-2">

                    <h3 class="font-weight-bolder">Holiday Form</h3>

                </div>
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.office_holidays') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group mb-1">
                                <label for="exampleTextarea">Holiday Title <span class="text-danger">*</span></label>
                                <input name="reason" class="form-control" id="exampleTextarea" rows="3" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number of Days <span class="text-danger">*</span></label>
                            <input name="number_of_days" id="number_of_days" type="number" class="form-control"
                                placeholder="Enter Number of Days" required />
                        </div>
                        <div id="starting_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">From </label>
                            <div class="col-10">
                                <input name="starting_date" class="form-control" type="date" id="example-date-input"
                                    required />
                            </div>
                        </div>
                        <div id="ending_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">To </label>
                            <div class="col-10">
                                <input name="ending_date" class="form-control" type="date" id="example-date-input" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Add Holiday</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            {{-- Leave Table Starts --}}
            {{-- <div class="card card-custom mt-4">
                <div class="card-body">
                    <table class="table text-center" id="timesheetDatatable">
                        <thead>

                            <tr>
                                <th>Applied Date</th>
                                <th>Number of Days</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $value)
                                <tr
                                    style="background-color: @if ($value->leave_status == 'Pending') #FFF3CD @elseif($value->leave_status == 'declined') #F8D7DA @else #D4EDDA @endif ">
                                    <td> {{ \Carbon\Carbon::parse($value->check_in)->format('d M Y') }}</td>
                                    <td>{{ $value->leave_days }}</td>
                                    <td>{{ $value->leave_description }}</td>
                                    <td style="text-transform: capitalize;">{{ $value->leave_status }}</td>
                                    @if ($value->leave_status == 'Pending')
                                        <td>
                                            <button data-toggle="modal" data-target="#exampleModal"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </td>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            <i class="flaticon-warning-sign text-warning"></i> Disclamer
                                                        </h5>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete this leave request?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">No</button>
                                                        <form method="POST"
                                                            action="{{ route('employee.delete_leave_request', ['id' => encrypt($value->id)]) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Yes, Sure</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <td>
                                            <button class="btn btn-sm btn-light" disabled>Non Deletable</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div> --}}
            {{-- Leave Table Ends --}}
        </div>
    </div>
@endsection




@section('scripts')
    <script src="{{ asset('dev-assets/js/leave_application.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#timesheetDatatable').DataTable();
        });
    </script>
@endsection
