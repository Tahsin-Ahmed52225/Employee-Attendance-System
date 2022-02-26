@extends('layouts.employee_layout')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('dev-assets/css/datatable.css') }}">
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
                <!--begin::Form-->
                <form method="POST" action="{{ route('employee.leave_request') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Number of Days <span class="text-danger">*</span></label>
                            <input name="number_of_days" id="number_of_days" type="number" class="form-control"
                                placeholder="Enter Number of Days" required />
                        </div>
                        <div id="starting_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">From </label>
                            <div class="col-10">
                                <input name="starting_date" class="form-control" type="date" id="example-date-input" />
                            </div>
                        </div>
                        <div id="ending_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">To </label>
                            <div class="col-10">
                                <input name="ending_date" class="form-control" type="date" id="example-date-input" />
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label for="exampleTextarea">Example textarea <span class="text-danger">*</span></label>
                            <textarea name="reason" class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Leave Request</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            {{-- Leave Table Starts --}}

            <div class="card card-custom mt-4">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="timesheetDatatable">
                        <thead>

                            <tr>
                                <th>Applied Date</th>
                                <th>Number of Days</th>
                                <th>Reason</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $value)
                                <tr>
                                    <td> {{ \Carbon\Carbon::parse($value->check_in)->format('d M Y') }}</td>
                                    <td>{{ $value->leave_days }}</td>
                                    <td>{{ $value->leave_description }}</td>
                                    <td>{{ $value->leave_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

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
