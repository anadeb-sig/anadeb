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
        <h1 class="h3 mb-0 text-gray-800">Liste des suivis</h1>
        @can('suivi-create')
            <a href="javascript:void(0)" class="btn btn-sm ajout" id="add_suivi">
                Nouvel enregistrement
            </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table_suivi"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    @include('suivis.create')
    @include('suivis.show')
    @include('suivis.edit')
    @include('suivis.delete')
    @include('suivis.crud')

    <!-- gridjs js-->
    <script type="module" src="{{ asset('./assets/gridjs/gridjs.suivi.js') }}"></script>

    <script>
        function ajouterChamp() {
            var nouveauChamp = '<div class="row groupe-champs mt-3">';
            nouveauChamp += '<div class="col-xl-5">'+
                                '<label for="photo" class="control-label">Photo de l\'ouvrage</label>'+
                                '<input class="form-control photo" type="file" name="photo[]" id="photos">'+
                            '</div>';
            nouveauChamp += '<div class="col-xl-5">'+
                                '<label for="descrip" class="control-label">Description</label>'+
                                '<input class="form-control descrip" type="text" name="descrip[]" id="descrip">'+
                            '</div>';
            nouveauChamp += '<div class="col-xl-2">'+
                                '<label for="descrip" class="control-label" style="color:#ffff;"> Titre </label>'+
                                '<a class="btn btn-success" onclick="supprimerChamp(this)">Supprimer</a>'+
                            '</div>';
            nouveauChamp += '</div>';

            $('#container').append(nouveauChamp);
        }

        function supprimerChamp(element) {
            $(element).closest('.groupe-champs').remove();
        }
    </script>

@endsection