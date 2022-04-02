@extends('layouts.employee_layout')


@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
@endsection


@section('content')
    {{-- pending table starts --}}
    <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Updates</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="timesheetDatatable">
                        <thead>

                            <tr>
                                <th>Date</th>
                                <th>Checked In</th>
                                <th>Checked Out</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending_state as $item)
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
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#staticBackdrop{{ $item->id }}"> <i
                                                class="flaticon-edit"></i></a>
                                    </td>
                                </tr>
                                {{-- Update Daily Update Starts --}}
                                <div class="modal fade" id="staticBackdrop{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Update</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="was-validated" method="POST"
                                                    id="update_form{{ $item->id }}"
                                                    action="{{ route('employee.update_task', encrypt($item->id)) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea class="kt-tinymce-3" name="description" placeholder="message" required>
                                                        {{ $item->description }}
                                                    </textarea>
                                                        @error('details')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">

                                                <button data-id={{ $item->id }} type="button"
                                                    class="btn btn-primary submit_btn" data-dismiss="modal">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Update Daily Update Ends --}}
                            @endforeach
                        </tbody>
                    </table>

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
            $('#timesheetDatatable').DataTable();
        });
    </script>
    <script>
        // Class definition

        var KTTinymce = function() {
            // Private functions
            var demos = function() {
                tinymce.init({
                    selector: '.kt-tinymce-3',
                    menubar: false,
                    toolbar: ['styleselect fontselect fontsizeselect',
                        'undo redo | cut copy paste | bold italic | alignleft aligncenter alignright alignjustify',
                        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview '
                    ],
                    plugins: 'advlist autolink link  lists charmap print preview'
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        // Initialization
        jQuery(document).ready(function() {
            KTTinymce.init();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.submit_btn').on("click", (e) => {
                $(`#update_form` + e.target.getAttribute('data-id')).submit();
            });
        });
    </script>
@endsection
