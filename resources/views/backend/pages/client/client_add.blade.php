@extends('admin.admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Add client</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add client</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('client.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    Changes</button>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="client_name" class="form-label">Full Name </label>
                                        <input type="text" name="client_name" class="form-control" id="client_name"
                                            placeholder="client Name">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="address" class="form-label">File </label>
                                        <input type="file" name="file_pdf" class="form-control" id="file_pdf"
                                            placeholder="file">
                                    </div>                                 
                                </div>
                            </form>
                            <div class="form-group col-md-6 mb-3">
                                        <label for="client_head" class="form-label">Upload Multiple File(*.jpg) </label>
                                        <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                                            @csrf
                                            <div>
                                                
                                            </div>
                                        </form>
                            </div>
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
                    client_name: {
                        required: true,
                    }
                },
                messages: {
                    client_name: {
                        required: 'Please Enter client Name',
                    }
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
       

        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function(file, response){
                //Here you can get your response.
                console.log(response['success']);
                var photos = response['success'];
                $('#myForm').append('<input type="hidden" name="images[]" value="'+photos+'">');
            }
        };
       

    </script>
@endsection
