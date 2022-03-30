@extends('layouts.admin_layout')

{{-- Page custom links --}}
@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('dev-assets/css/datatable.css') }}">
@endsection

{{-- Page content --}}
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">

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
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.pending_clearence') }}" method="POST">
                                                        @csrf
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox1" value="FD">
                                                            <label class="form-check-label" for="inlineCheckbox1">Full
                                                                Day</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox2" value="HD">
                                                            <label class="form-check-label" for="inlineCheckbox2">Half
                                                                Day</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox3" value="Late"
                                                                @if (\Carbon\Carbon::parse($item->check_in)->format('h') > App\Helpers::settings('office_time_starts')) checked @endif>
                                                            <label class="form-check-label" for="inlineCheckbox3">Late Entry
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox3" value="option3">
                                                            <label class="form-check-label" for="inlineCheckbox3">Absent
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Understood</button>
                                                </div>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#timesheetDatatable').DataTable();
        });
    </script>
@endsection
