@extends('layouts.app')

@section('content')

<style>
    td.gridjs-td{
        text-alin: center!important;
    }
    .gridjs-th{
        min-width: 311px;
        width: 380px!important;
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
        <h1 class="h3 mb-0 text-gray-800">Synthèse de comptabilité<br><a href="#!" class="text_export" onclick="ExportTExcelee('xlsx')">... Exporter en excel par recherche multiple du tableau!</a></h1>            
        <button class="btn btn_export bouton export">Export en excel</button> 
    </div>

    <div class="toggle-container mb-4">
        <h1 class="h1 fs-4 tbl_btn tbl_btn1 rid_green rot filtre">
            <i id="toggleIcon" class="fas fa-caret-right" style="font-size: 1.5em;"></i>
            <span style="font-size: 1.5em;">&nbsp;Filtrer la liste </span>
        </h1>

        <div id="hiddenContent" class="hidden mt-4 mb-4">
            <div class="card card-body mb-0">
                <form method="get" action="" accept-charset="UTF-8">
                    <div class="row mb-4">
                        <div class="col-xl-4">
                            <label for="canton_id" class="control-label">Région</label>
                            <input class="form-control w-100 majuscules" id="nom_reg" name="nom_reg" type="text" placeholder="exemple: KARA..." />
                        </div>
                        <div class="col-xl-4">
                            <label for="canton_id" class="control-label">Canton</label>
                            <input class="form-control w-100 majuscules" id="nom_cant" name="nom_cant" type="text" placeholder="exemple: SIRKA..." />
                        </div>
                        <div class="col-xl-4 {{ $errors->has('canton_id') ? 'has-error' : '' }}">
                            <label for="canton_id" class="control-label">Financement</label>
                            <input class="form-control w-100" id="nom_fin" name="nom_fin" type="text" placeholder="exemple: Etat..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <label for="canton_id" class="control-label">Cantine</label>
                            <input class="form-control w-100 majuscules" id="nom_ecl" name="nom_ecl" type="text" placeholder="exemple: EPP SIRKA..." />
                        </div>
                        <div class="col-xl-4">
                            <label for="start-date">Date début</label>
                            <input class="form-control" type="date" id="start" name="start">
                        </div>
                        <div class="col-xl-4">
                            <label for="end-date">Date fin</label>
                            <input class="form-control" type="date" id='end'  name="end">
                        </div>
                    </div>           
                    <div class="row mt-4">
                    <div class="col-xl-10">
                        </div>
                        <div class="col-xl-1">
                            <button id="btnP" type="button" class="btn btn-secondary mt-2 recherche">
                                <i class="fa fa-search"></i> Rechercher
                            </button>
                        </div>
                        <div class="col-xl-1">
                            <a href="{{ route('repas.synthese_comptabilite') }}" id="btnP" type="button" class="btn btn-secondary mt-2 recherche">
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
                    <div id="table_compta"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <script type="module" src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    
    <script type="text/javascript"> 
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction par défaut sans paramètres
            loaddatauserdefault();
            // Gestionnaire de clic sur le bouton "Afficher avec paramètres"
            document.getElementById('btnP').addEventListener('click', function() {
                // Appeler la fonction avec des paramètres
                const startDate = document.getElementById('start').value;
                const endDate = document.getElementById('end').value;
                const nom_reg = document.getElementById('nom_reg').value;
                const nom_cant = document.getElementById('nom_cant').value;
                const nom_ecl = document.getElementById('nom_ecl').value;
                const nom_fin = document.getElementById('nom_fin').value;
                rendtable(startDate,endDate,nom_reg,nom_cant,nom_ecl,nom_fin);
            });
        });

        function loaddatauserdefault(){
            const startDate = "2023-01-01";
            const endDate = "2024-09-30";
            const nom_reg = "";
            const nom_cant = "";
            const nom_ecl = "";
            const nom_fin = "";
            rendtable(startDate,endDate,nom_reg,nom_cant,nom_ecl,nom_fin);
        }
        
        $(function() {
            $(".bouton").click(function(event) {
                console.log("Exporting XLS");
                $(".gridjs-table").table2excel({
                exclude: ".excludeThisClass",
                name: $(".gridjs-table").data("tableName"),
                filename: "comptabilite.xls",
                preserveColors: false
                });
            });
        });
    </script>

    <script>
        function hideRw(table,rowIndex){
        var elt = document.getElementById('table_compta');
        for (var i = 0, row; row = elt.length; i++) {
            if(rowIndex==i){
                row.className ="hiddenclass";
            }
            }        
        }

        function ExportTExcelee(type, fn, dl) {
            var elt = document.getElementById('table_compta');
            hideRw(  elt,2);
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1", ignoreHiddenRows: true });
            
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('comptabilite.' + (type || 'xlsx')));
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#nom_reg").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/regions/autocomplete_reg",
                        data: {
                                term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                           var resp = $.map(data,function(obj){
                                return obj.nom_reg;
                        });         
                        response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#nom_fin").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/regions/autocomplete_fin",
                        data: {
                                term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                           var resp = $.map(data,function(obj){
                                return obj.nom_fin;
                        });         
                        response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nom_cant").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/regions/autocomplete_cant",
                        data: {
                                term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                           var resp = $.map(data,function(obj){
                                return obj.nom_cant;
                        });         
                        response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nom_ecl").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/regions/autocomplete_ecl",
                        data: {
                                term : request.term
                        },
                        dataType: "json",
                        success: function(data){
                           var resp = $.map(data,function(obj){
                                return obj.nom_ecl;
                        });         
                        response(resp);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
@endsection