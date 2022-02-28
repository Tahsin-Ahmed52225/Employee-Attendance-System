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
                                <tr data-toggle="modal" data-target="#exampleModal{{ $value->id }}">
                                    <td>{{ $value->user->name }}</td>
                                    <td> {{ \Carbon\Carbon::parse($value->created_at)->format('d M Y') }}</td>
                                    <td>{{ $value->leave_days }}</td>
                                    <td>{{ $value->leave_description }}</td>
                                    <td> <span class="badge badge-pill badge-warning">{{ $value->leave_status }}</span>
                                    </td>
                                </tr>



                                {{-- Leave details modal starts --}}
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title" id="exampleModalLabel">Name:
                                                    {{ $value->user->name }}
                                                    <div style="font-size:14px; color:gray;">
                                                        {{ $value->user->position }}
                                                    </div>
                                                </div>

                                                <button type="button" class="btn text-light" data-dismiss="modal"
                                                    aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($value->leave_ending_date == null)
                                                    <div>
                                                        <b>Leave Date:</b> {{ $value->leave_starting_date }}
                                                    </div>
                                                @else
                                                    <div>
                                                        <b>Leave :</b> {{ $value->leave_starting_date }} to
                                                        {{ $value->leave_ending_date }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <b>Days :</b> {{ $value->leave_days }}
                                                </div>
                                                <div> <b>Leave Describtion: </b><br>
                                                    {{ $value->leave_description }}
                                                </div>

                                            </div>
                                            <div class="modal-footer ">
                                                {{-- Accept or decline leave request --}}
                                                <form method="POST"
                                                    action="{{ route('admin.leave_request_update', encrypt($value->id)) }}"
                                                    class="row">
                                                    @csrf
                                                    <select class="form-control col" id="exampleSelectl"
                                                        name="leave_status">
                                                        <option> - </option>
                                                        <option value="accepted">Accept</option>
                                                        <option value="declined">Decline</option>

                                                    </select>
                                                    <button type="type" class="btn btn-primary col-auto">
                                                        Save Changes
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Leave details modal end --}}
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
