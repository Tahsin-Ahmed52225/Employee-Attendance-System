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
                                                <div class="col d-flex align-items-center justify-content-between">
                                                    <a
                                                        href="{{ route('admin.office_days', ['id' => encrypt($values->id)]) }}">
                                                        <button class="btn btn-sm btn-primary">View Details</button>
                                                    </a>

                                                </div>
                                                <div class="col d-flex align-items-center justify-content-between"
                                                    onclick="deleteMember({!! $values->id !!})">
                                                    <i class="fas fa-trash-alt p_icon"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/html.js') }}"></script>
    <!--end::Page Scripts-->
    <script src="{{ asset('dev-assets/js/update-member.js') }}"></script>

    <script>
        $(document).on('click', '.toggle', function() {
            let id = $(this).children(".switchT").attr("data-user");
            let stage = $(this).children(".switchT").attr("checked");
            switchT(id, stage);
        });
    </script>
@endsection
