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

        .action-btn-group > a, button {
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

        <!-- Dynamic Table Full -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Company list</h3>
            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->

                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th class="d-none d-sm-table-cell" >Name</th>
                        <th class="d-none d-sm-table-cell" >Email</th>
                        <th class="d-none d-sm-table-cell" >Webstie</th>
                        <th class="d-none d-sm-table-cell" style="width: 5%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($company_array as $company)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>
                                <div class="items-push js-gallery" style="width: 120px;">
                                    <div class="animated fadeIn ">
                                        <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="{{asset('/images').'/original/'.$company->logo_uri}}">
                                            <img class="img-fluid" src="{{asset('/images').'/thumbnail/'.$company->logo_uri}}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="#">{{$company->name}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$company->email}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{$company->website}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group action-btn-group">
                                    <a href="{{url('company/create')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Create">
                                        <span>Create</span>
                                    </a>
                                    <a href="{{url('company/'.$company->id)}}"  type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Show">
                                        <span>Show</span>
                                    </a>
                                    <a href="{{url('company/'.$company->id.'/edit')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <span>Edit</span>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete" onclick="page.deleteCompany({{ $company->id }});">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->

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
            window.page = new Dashmix.pages.CompanyIndexPage();
        });
    </script>

@endsection
