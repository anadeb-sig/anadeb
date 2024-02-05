@extends('layouts.app')

@section('title', 'Users List')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="uil uil-check me-2"></i>
                {!! session('success_message') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="uil uil-exclamation-octagon me-2"></i>
                {!! session('error_message') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Utilisateurs</h1>
        <div class="row">
            <div class="col-md-9">
                <div class="header-search">
                    <form action="{{ route('users.upload') }}" method="post" class="search-form search-widget" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input type="file" class="form-control" name="file" required="" value="">
                        <button type="submit" class="button action has-icon search-button">
                            <span class="button-wrap"><span class="fa fa-file-import "></span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-1" style="margin-top: 3px;">
                <a href="{{ route('users.export') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-file"></i>
                </a>
            </div>
            <div class="col-md-2" style="margin-top: 3px; text-align: right;">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i>
                </a>
            </div>            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table_user"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    @include('users.delete')
    @include('users.crud')
    
    <!-- gridjs js-->
    <script type="module" src="{{ asset('./assets/gridjs/gridjs.user.js') }}"></script>

@endsection
