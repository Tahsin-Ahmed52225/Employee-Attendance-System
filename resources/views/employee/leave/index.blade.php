@extends('layouts.employee_layout')

@section('links')
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container ">
            <div class="card">
                <!--begin::Form-->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Number of Days <span class="text-danger">*</span></label>
                            <input id="number_of_days" type="number" class="form-control"
                                placeholder="Enter Number of Days" required />
                        </div>
                        <div id="starting_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">From </label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" />
                            </div>
                        </div>
                        <div id="ending_date" class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">To </label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="2011-08-19" id="example-date-input" />
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label for="exampleTextarea">Example textarea <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script src="{{ asset('dev-assets/js/leave_application.js') }}"></script>
@endsection
