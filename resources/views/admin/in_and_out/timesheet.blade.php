@extends('layouts.admin_layout')

{{-- Page custom links  --}}
@section('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<link rel="stylesheet" href="{{ asset("dev-assets/css/datatable.css") }}">
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
                                    <h4>Month : <span class="text-primary">February</span></h4>
                                    <h4>Year : <span class="text-primary">2022</span> </h4>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleSelect1">
                                        <option>Select Month</option>
                                        <option value=1>January</option>
                                        <option value=2>February</option>
                                        <option value=3>March</option>
                                        <option value=4>April</option>
                                        <option value=5>May</option>
                                        <option value=6>June</option>
                                        <option value=7>July</option>
                                        <option value=8>August</option>
                                        <option value=9>September</option>
                                        <option value=10>October</option>
                                        <option value=11>November</option>
                                        <option value=12>December</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="exampleSelect1">
                                        <option>Select Year</option>
                                        @for ($i = 2020; $i <= Carbon\Carbon::now()->year; $i++)
                                            <option value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col">
                                    <a href="" class="btn btn-primary">Get Record</a>
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
                                    @foreach ($user as $elements)
                                    <th>{{ explode(" ",$elements->name)[0]  }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php $days = Carbon\Carbon::now()->daysInMonth @endphp
                                @for($i=1; $i<=$days; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>64616-103</td>
                                    <td>Brazil</td>
                                    <td>São Félix do Xingu</td>
                                    <td>Brazil</td>
                                    <td>São Félix do Xingu</td>
                                </tr>
                                @endfor
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
    $(document).ready( function () {
    $('#timesheetDatatable').DataTable();
} );
</script>
@endsection

