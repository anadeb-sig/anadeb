@extends('layouts.app')

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
    <h5 class="mb-0 text-gray-800">
            <a href="{{ route('cantons.index') }}">
                <i class='fas fa-arrow-circle-left' style='font-size:30px;color: #126e51;'></i>
            </a>&nbsp;&nbsp;
            Liste des cantines bénéficiaires
        </h5>          
        <button class="btn btn-outline-purple" style="background-color: #126e51;color: white;" onclick="ExportToExcel('xlsx')">Export en excel</button>
    </div>
    <!--<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
        
        <h4>
            Ecoles bénéficiaires du canton
        </h4>
        <a href="{{ route('cantons.index') }}">
            <i class='fas fa-arrow-circle-left' style='font-size:30px'></i>
        </a>
        
        <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="add_canton" style="font-size: 1.1rem;">
            <i class="fas fa-plus"></i>
        </a>
    </div>-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="liste_ecoles"></div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('./assets/gridjs/gridjs.parcanton.js') }}"></script>
@endsection