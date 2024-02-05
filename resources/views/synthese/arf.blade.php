@extends('layouts.app')

@section('content')

    <style>
        .hiddenclass{
        display:block;
        }

        .gridjs-th{
            min-width: 150px;
            width: 200px!important;
        }

    </style>
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
        <h1 class="h3 mb-0 text-gray-800">Synthèse /Jour <br><a href="#" class="text_export" onclick="ExporToExcel('xlsx')">... Exporter en excel par recherche multiple du tableau!</a></h1>            
        <button class="btn btn_export export" id="export-btn">Export en excel</button>
    </div>

    <div class="toggle-container mb-4">
        <h1 class="h1 fs-4 tbl_btn tbl_btn1 rid_green rot filtre">
            <i id="toggleIcon" class="fas fa-caret-right" style="font-size: 1.5em;"></i>
            <span style="font-size: 1.5em;">&nbsp;Filtrer la liste </span>
        </h1>

        <div id="hiddenContent" class="hidden mt-4 mb-4">
            <div class="card card-body mb-0">
                <form method="get" action="" accept-charset="UTF-8">
                    <div class="row">
                        <div class="col-xl-4">
                            <label for="start-date">Date début</label>
                            <input class="form-control" type="date" id="start" name="start">
                        </div>
                        <div class="col-xl-4">
                            <label for="end-date">Date fin</label>
                            <input class="form-control" type="date" id='end'  name="end">
                        </div>
                        <div class="col-xl-2">
                            <label for=""></label>
                            <button id="btnP" type="button" class="form-control btn button mt-2 recherche">
                                <i class="fa fa-search"></i> Rechercher
                            </button>
                        </div>
                        <div class="col-xl-2">
                            <label for=""></label>
                            <a href="{{ route('repas.synthese_arf') }}" id="btnP" type="button" class="form-control btn button mt-2 recherche">
                                <i class="fas fa-sync-alt"></i> Rafraichir
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table_arf"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    
    <script type="text/javascript"> 
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction par défaut sans paramètres
            loaddatauserdefault();
            // Gestionnaire de clic sur le bouton "Afficher avec paramètres"
            document.getElementById('btnP').addEventListener('click', function() {
                // Appeler la fonction avec des paramètres
                const startDate = document.getElementById('start').value;
                const endDate = document.getElementById('end').value;
                rendutableau(startDate,endDate);
            });
        });

        function loaddatauserdefault(){
            const startDate = "2023-01-01";
            const endDate = "2024-09-30";
            rendutableau(startDate,endDate);
        }
        
        function hideRo(table,rowIndex){
            var elt = document.getElementById('table_arf');
            for (var i = 0, row; row = elt.length; i++) {
                if(rowIndex==i){
                    row.className ="hiddenclass";
                }
            }        
        }

        function ExporToExcel(type, fn, dl) {
            var elt = document.getElementById('table_arf');
            console.log("elt");
            hideRo(  elt,2);
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1", ignoreHiddenRows: true });
            
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('arf.' + (type || 'xlsx')));
        }
    </script>
@endsection