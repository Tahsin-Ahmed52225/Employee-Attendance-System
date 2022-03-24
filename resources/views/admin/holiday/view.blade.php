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
                                    <th>Title</th>
                                    <th>Number of Days</th>
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holiday as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->days }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#exampleModal{{ $item->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    {{-- holiday delete modal starts --}}
                                    <!-- Button trigger modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <i class="flaticon-warning-sign text-warning"></i>
                                                        Disclamer
                                                    </h5>

                                                </div>
                                                <div class="modal-body">
                                                    Are your sure you want to delete this holiday record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">No</button>
                                                    <form method="POST"
                                                        action="{{ route('admin.delete_office_holidays', encrypt($item->id)) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Yes I'm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- holiday delete modal ends --}}
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
