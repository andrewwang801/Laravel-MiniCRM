@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/magnific-popup/magnific-popup.css')}}">
@endsection

@section('css_after')
    <style>
        .img-fluid {
            width: 240px;
        }

        .action-btn-group > button {
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Company CRUD</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active" aria-current="page">Company</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Create Company</h3>
            </div>

            <div class="block-content block-content-full">

                <div class="col-lg-6 col-xl-12 col-md-6 col-sm-6">
                <div class="form-area">
                    <form action="{{url('company/')}}" class="js-validation" method="post" id="create-form" enctype="multipart/form-data">
                        <div class="block-content">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter Company name...">
                                </div>
                                <div class="form-group">
                                    <label for="name">Company Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Enter Company Email...">
                                </div>
                                <div class="form-group">
                                    <label for="name">Company Website</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                           placeholder="Enter Company Website URL...">
                                </div>
                                <div class="form-group">
                                    <label for="image">Company Logo</label>
                                    <input type="file" class="form-control"  name="logo" id="logo">
                                </div>
                                <div id="imgContainer"></div>
                            </div>

                        <div class="block-content block-content-full text-right bg-light">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')

    <!-- Page JS Plugins -->
    <script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>


    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>jQuery(function(){ Dashmix.helpers('magnific-popup'); });</script>

    <script>
        $(document).ready(function() {
            window.page = new Dashmix.pages.CompanyCreatePage();
        });
    </script>

@endsection
