@extends('layouts.admin_layout')
@section('links')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding-top:0px;">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                @foreach ($updates as $item)
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div style="font-size:12px; font-weight:700;">{{ $item->name }} -
                                <span style="font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($item->check_out)->format('d M Y') }} at
                                    {{ \Carbon\Carbon::parse($item->check_out)->format('h:i') }}
                                </span>

                            </div>
                            <div style="font-size:12px;">
                                {!! $item->daily_update !!}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
@endsection
