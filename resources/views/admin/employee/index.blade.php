@extends('layouts.admin_layout')

@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dev-assets/css/style.css') }}">
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content" style="padding-top: 0px;">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->

            <div class="container">
                <div class="flash-message"></div>

                <!--begin::Card-->
                <div class="card card-custom gutter-b" id="error_holder">

                    <div class="card-header flex-wrap border-0 pt-6 pb-0">

                        <div class="card-title">
                            <h3 class="card-label">View All Member
                        </div>
                    </div>

                    <div class="card-body" style="overflow-X: scroll;">

                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-checkable text-center " id="kt_datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($users as $values)
                                    <tr id="row{{ $values->id }}">

                                        <td style="padding: 17px 5px !important;">{{ $i }}</td>
                                        <td id="name{{ $values->id }}" style="padding: 17px 5px !important;"
                                            ondblclick="updateName({!! $values->id !!})">
                                            {{ $values->name }}
                                        </td>
                                        <td id="email{{ $values->id }}" style="padding: 17px 5px !important;"
                                            ondblclick="updateEmail({!! $values->id !!})">{{ $values->email }}</td>
                                        <td id="number{{ $values->id }}" style="padding: 17px 5px !important;"
                                            ondblclick="updatePhone({!! $values->id !!})">{{ $values->number }}</td>
                                        <td style="padding: 17px 5px !important;">

                                            <div style="display:none;" id="position-edit{{ $values->id }}">
                                                <select style="border:none" id="positionD{{ $values->id }}">
                                                    <option>Manager</option>
                                                    <option>Web developer</option>
                                                    <option>Designer</option>
                                                    <option>Content Writer</option>
                                                    <option>Support</option>
                                                </select>
                                            </div>
                                            <div id="position{{ $values->id }}"
                                                ondblclick="updatePosition({!! $values->id !!})">
                                                {{ $values->position }}
                                            </div>


                                        </td>
                                        <td>

                                            <div class="row">
                                                <div class="col d-flex align-items-center justify-content-center">
                                                    <a
                                                        href="{{ route('admin.office_days', ['id' => encrypt($values->id)]) }}">
                                                        <button class="btn btn-sm btn-primary">View Details</button>
                                                    </a>

                                                </div>
                                                <div class="col d-flex align-items-center justify-content-between"
                                                    data-toggle="modal" data-target="#exampleModal{{$values->id}}">
                                                    <i class="fas fa-trash-alt p_icon"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- delete modal starts --}}
                                    <!-- Button trigger modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$values->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Disclamer</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this member?<br>
                                                    <b> Deleting this member will delete all the details of this member</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteMember({!! $values->id !!})"
                                                        data-dismiss="modal">Yes,Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                    {{-- delete modal ends --}}
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}"></script>
    <!--end::Page Scripts-->
    <script src="{{ asset('dev-assets/js/update-member.js') }}"></script>
@endsection
