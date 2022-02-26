@extends('layouts.admin_layout')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('dev-assets/css/datatable.css') }}">
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <div class="container">


            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="timesheetDatatable">
                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Applied Date</th>
                                <th>Number of Days</th>
                                <th>Reason</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $value)
                                <tr>
                                    <td>{{ $value->user->name }}</td>
                                    <td> {{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
                                    <td>{{ $value->leave_days }}</td>
                                    <td>{{ $value->leave_description }}</td>
                                    <td>{{ $value->leave_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>



        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#timesheetDatatable').DataTable();
        });
    </script>
@endsection
