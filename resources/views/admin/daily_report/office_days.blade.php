@extends('layouts.admin_layout')


@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection


@section('content')
    {{-- pending table starts --}}
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <div class="container">
            <div class="card card-custom">
                <div class="card-body row ">

                    <div class="col">
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <div class="col ">
                        <a href="{{ route('admin.view_profile', ['id' => encrypt($user->id)]) }}"><button
                                class="btn btn-sm btn-primary float-right">View Profile</button>
                        </a>
                    </div>


                </div>

            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Office Days</a></li>
                <li><a data-toggle="tab" href="#menu1">Absent</a></li>
                <li><a data-toggle="tab" href="#menu2">Home Office</a></li>
                <li><a data-toggle="tab" href="#menu3">Office Leave</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in show active">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="timesheetDatatable1">
                                <thead>

                                    <tr>
                                        <th>Date</th>
                                        <th>Checked In</th>
                                        <th>Checked Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($office_days as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->check_in)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->check_out)->format('h:i A') }}</td>
                                            <td>
                                                @php
                                                    if ($item->status == 'Pending') {
                                                        echo '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Pending</span>';
                                                    } else {
                                                        $badge = App\Helpers::stringToBadge($item->status);
                                                        foreach ($badge as $key => $value) {
                                                            echo $value;
                                                        }
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="timesheetDatatable2">
                                <thead>

                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absent as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                            <td>
                                                <span class="badge badge-danger mr-1">Absent</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">

                    <div class="card">

                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="timesheetDatatable3">
                                <thead>

                                    <tr>
                                        <th>Starting Date</th>
                                        <th>Ending Date</th>
                                        <th>Days</th>
                                        <th>Reason</th>
                                        <th>Checked Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leave as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->leave_starting_date)->format('d M Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->leave_ending_date)->format('h:i A') }}
                                            </td>
                                            <td>{{ $item->leave_days }}</td>
                                            <td>{{ $item->leave_description }}</td>
                                            <td>
                                                @php
                                                    if ($item->status == 'Pending') {
                                                        echo '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Pending</span>';
                                                    } else {
                                                        echo '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Accepted</span>';
                                                    }
                                                @endphp
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="timesheetDatatable4">
                                <thead>
                                    <tr>
                                        <th>Starting Date</th>
                                        <th>Ending Date</th>
                                        <th>Days</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($home_office as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->ho_starting_date)->format('d M Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->ho_ending_date)->format('h:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->ho_days)->format('h:i A') }}</td>
                                            <td>{{ $item->ho_description }}</td>
                                            <td>
                                                @php
                                                    if ($item->status == 'Pending') {
                                                        echo '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Pending</span>';
                                                    } else {
                                                        echo '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Accepted</span>';
                                                    }
                                                @endphp
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- pedning table ends --}}
@endsection


@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#timesheetDatatable1').DataTable();
            $('#timesheetDatatable2').DataTable();
            $('#timesheetDatatable3').DataTable();
            $('#timesheetDatatable4').DataTable();
        });
    </script>
@endsection
