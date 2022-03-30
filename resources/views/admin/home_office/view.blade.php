@extends('layouts.admin_layout')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('dev-assets/css/datatable.css') }}">
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <div class="container">
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
                <div class="card-header flex-wrap">
                    <div class="row w-100 align-items-center">
                        <div class="col">
                            <h3> Home List</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered " id="timesheetDatatable">
                        <thead>

                            <tr class="text-center">
                                <th>Name</th>
                                <th>Home Office Date</th>
                                <th>Number of Days</th>
                                <th>Reason</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ho_list as $value)
                                <tr class="text-center">
                                    <td>{{ $value->user->name }}</td>
                                    <td> {{ \Carbon\Carbon::parse($value->ho_starting_date)->format('d M Y') }}
                                        @if ($value->leave_days > 1)
                                            -
                                            {{ \Carbon\Carbon::parse($value->ho_ending_date)->format('d M Y') }}
                                        @endif
                                    </td>
                                    <td>{{ $value->ho_days }}</td>
                                    <td>{{ $value->ho_description }}</td>
                                    <td> <span class="badge badge-pill badge-success" style="text-transform:capitalize">
                                            {{ $value->ho_status }}</span>
                                    </td>
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
