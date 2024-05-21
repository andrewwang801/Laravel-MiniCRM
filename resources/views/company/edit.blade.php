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

        #logo {
            width: 300px;
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
                <h3 class="block-title">Edit Company</h3>
            </div>

            <div class="block-content block-content-full">

                <div class="col-lg-6 col-xl-12 col-md-6 col-sm-6">
                <div class="form-area">
                    <div class="items-push js-gallery" style="width: 120px;">
                        <div class="animated fadeIn ">
                            <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{asset('/images').'/original/'.$company->logo_uri}}">
                                <img class="img-fluid" src="{{asset('/images').'/thumbnail/'.$company->logo_uri}}" alt="">
                            </a>
                        </div>
                    </div>

                    {{--  Use laravel 5.8 collective cause of PHP error with PUT method --}}
                    {{ Form::model($company, array('route' => array('company.update', $company->id), 'id' => 'edit-form', 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'name') }} <span class="text-danger">*</span>
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('website', 'website') }}
                        {{ Form::text('website', null, array('class' => 'form-control')) }}
                    </div>
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
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
            window.page = new Dashmix.pages.CompanyEditPage();
        });
    </script>

@endsection
