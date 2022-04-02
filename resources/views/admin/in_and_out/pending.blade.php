@extends('layouts.admin_layout')

{{-- Page custom links --}}
@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection

{{-- Page content --}}
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
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
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title w-100">
                            <div class="row w-100 align-items-center">
                                <div class="col">
                                    Pending Timesheet
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-striped table-bordered" id="timesheetDatatable">
                            <thead>

                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Checked In</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PendingList as $item)
                                    <tr data-toggle="modal" data-target="#staticBackdrop{{ $item->id }}">
                                        <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d M Y') }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->check_in)->format('h:i A') }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                        </td>
                                    </tr>
                                    {{-- modal starts --}}
                                    <div class="modal fade" id="staticBackdrop{{ $item->id }}"
                                        data-bs-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $item->name }}
                                                    </h5>
                                                    <p>
                                                        <span class="badge badge-pill badge-light">
                                                            Date:{{ \Carbon\Carbon::parse($item->check_in)->format('d M Y') }}</span>
                                                        <span
                                                            class="badge badge-pill badge-light">Time:{{ \Carbon\Carbon::parse($item->check_in)->format('h:i A') }}</span>
                                                    </p>
                                                </div>
                                                <form action="{{ route('admin.pending_clearence', encrypt($item->id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">

                                                        <div class="mb-4">
                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="data"
                                                                    id="inlineCheckbox1" value="approve"
                                                                    data-key="{{ $item->id }}">
                                                                <label class="form-check-label"
                                                                    for="inlineCheckbox1">Approve</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="data"
                                                                    id="inlineCheckbox3" value="HO">
                                                                <label class="form-check-label" for="inlineCheckbox3">Home
                                                                    Office
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="data"
                                                                    id="inlineCheckbox3" value="Absent">
                                                                <label class="form-check-label" for="inlineCheckbox3">Absent
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="check_out_time{{ $item->id }}"
                                                            class="row align-items-center check_out_T mb-4">
                                                            <label class="col-form-label  col">Check Out Time
                                                            </label>
                                                            <div class="col">
                                                                <div class="input-group timepicker">
                                                                    <input name="office_time_ends" class="form-control"
                                                                        id="kt_timepicker_2" readonly
                                                                        placeholder="Select time" type="text" />
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-clock-o"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save,
                                                                Response</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal ends --}}
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- Page specific scripts --}}
@section('scripts')
    <script src="{{ asset('dev-assets/js/pending.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}">
        < script type = "text/javascript"
        charset = "utf8"
        src = "https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js" >
            <
            /> <
        script >
            $(document).ready(function() {
                $('#timesheetDatatable').DataTable();
            });
    </script>
@endsection
