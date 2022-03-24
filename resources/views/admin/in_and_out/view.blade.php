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
                                    Timesheet
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
                                    <th>Checked Out</th>
                                    <th>Total hour</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timesheet as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d M Y') }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->check_in)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->check_out)->format('h:i A') }}</td>
                                        <td>{{ App\Helpers::min_to_hour($item->total_time) }}
                                        </td>
                                        <td>
                                            @php
                                                $badge = App\Helpers::stringToBadge($item->status);
                                                foreach ($badge as $key => $value) {
                                                    echo $value;
                                                }
                                            @endphp
                                        </td>
                                    </tr>
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
