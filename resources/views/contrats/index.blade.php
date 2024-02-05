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
        <h1 class="h3 mb-0 text-gray-800">Liste des contrats</h1>
        @can('contrat-create')
            <a href="javascript:void(0)" class="btn btn-sm ajout" id="add_contrat">
                Nouvel enregistrement
            </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table_contrat"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    @include('contrats.create')
    @include('contrats.show')
    @include('contrats.edit')
    @include('contrats.delete')
    @include('contrats.crud')

    <!-- gridjs js-->
    <script type="module" src="{{ asset('./assets/gridjs/gridjs.contrat.js') }}"></script>
@endsection