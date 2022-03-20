@foreach ($updates as $item)
    <div class="card mb-2 update_card">
        <div class="card-header ">
            <div class="row align-items-center">
                <div class="col">
                    <div style="font-size:12px; font-weight:700;">{{ $item->name }} -
                        <span style="font-weight: 500;">
                            {{ \Carbon\Carbon::parse($item->check_out)->format('d M Y') }} at
                            {{ \Carbon\Carbon::parse($item->check_out)->format('h:i') }}
                        </span>
                        <span>
                            @if ($item->update_status)
                                <span class="badge badge-pill badge-success">updated</span>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class="card-toolbar float-right">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-sm">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">
                                    <li class="navi-item" data-toggle="modal"
                                        data-target="#exampleModalCenter{{ $item->id }}">
                                        <a href="#" class="navi-link">
                                            <i class="flaticon-edit mr-2"></i>
                                            <span>Edit</span>


                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <i class="flaticon2-gear mr-2"></i>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            {{-- Update Daily Update Starts --}}
                            <div class="modal fade" id="exampleModalCenter{{ $item->id }}" tabindex="-1"
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
                        </div>
                    </div>
                </div>
            </div>





        </div>
        <div class="card-body">

            <div style="font-size:12px;">
                {!! $item->daily_update !!}
            </div>
        </div>
    </div>
@endforeach

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
