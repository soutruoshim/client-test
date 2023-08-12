@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Edit Branch</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Branch</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('branch.update', $branch->id) }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $branch->id }}">

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="branch_name" class="form-label">Branch Name </label>
                                        <input type="text" name="branch_name" class="form-control" id="branch_name" value="{{ $branch->branch_name }}"
                                            placeholder="Branch Name">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="branch_name" class="form-label">Address </label>
                                        <input type="text" name="address" class="form-control" id="address" value="{{ $branch->address }}"
                                            placeholder="address">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="branch_head" class="form-label">Branch Head </label>
                                        <input type="text" name="branch_head" class="form-control" id="branch_head" value="{{ $branch->branch_head }}"
                                            placeholder="Branch Head">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone </label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $branch->phone }}"
                                            placeholder="Phone Head">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="late" class="form-label">Latitude </label>
                                        <input type="text" name="late" class="form-control" id="late" value="{{ $branch->late }}"
                                            placeholder="Phone Head">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="long" class="form-label">Longitude </label>
                                        <input type="text" name="long" class="form-control" id="long" value="{{ $branch->long }}"
                                            placeholder="Phone Head">
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="status">
                                            <option value="" disabled>Select status</option>
                                            <option value="active" @if($branch->status=='active') selected @endif>Active</option>
                                            <option value="inactive" @if($branch->status=='inactive') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    Changes</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    branch_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    branch_head: {
                        required: true,
                    },
                    phone:{
                        required: true,
                    },
                },
                messages: {
                    branch_name: {
                        required: 'Please Enter Branch Name',
                    },
                    address: {
                        required: 'Please Enter Address',
                    },
                    branch_head: {
                        required: 'Please Enter Branch Head',
                    },
                    phone: {
                        required: 'Please Enter Phone',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
