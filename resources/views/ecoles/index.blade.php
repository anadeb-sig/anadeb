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
        <h1 class="h3 mb-0 text-gray-800">Liste des cantines scolaires</h1>
        @can('ecole-create')
            <a href="javascript:void(0)" class="btn btn-sm ajout" id="add_ecole">
                Nouvel enregistrement
            </a>
        @endcan
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table_ecole"></div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    @include('ecoles.create')
    @include('ecoles.edit')
    @include('ecoles.show')
    @include('ecoles.delete')
    @include('ecoles.crud')

    <!-- gridjs js-->
    <script type="module" src="{{ asset('./assets/gridjs/gridjs.ecole.js') }}"></script>
    <script>
        $('#region').change(function(){
            var myvalue = $("#region option:selected").attr("id");
            $.ajax({url: "/prefectures/"+myvalue, success: function(result){
            $("#prefect").html(result);
            document.getElementById('prefecturecss').style.display = "block";
            }});
        });   
        
        $('#region_edit').change(function(){
            var myvalue = $("#region_edit option:selected").attr("id");
            $.ajax({url: "/prefectures/"+myvalue, success: function(result){
            $("#prefect_edit").html(result);
            document.getElementById('prefecturecss_edit').style.display = "block";
            }});
        }); 
    </script>

    <script>
        $('#prefect').change(function(){
            var myvalu = $("#prefect option:selected").attr("id");
            $.ajax({url: "/communes/"+myvalu, success: function(result){
            $("#commun").html(result);
            document.getElementById('communecss').style.display = "block";
            }});
        });
        $('#prefect_edit').change(function(){
            var myvalu = $("#prefect_edit option:selected").attr("id");
            $.ajax({url: "/communes/"+myvalu, success: function(result){
            $("#commun_edit").html(result);
            document.getElementById('communecss_edit').style.display = "block";
            }});
        });            
    </script>

    <script>
        $('#commun').change(function(){
            var myvalue = $("#commun option:selected").attr("id");
            $.ajax({url: "/cantons/"+myvalue, success: function(result){
            $("#canto").html(result);
            document.getElementById('cantoncss').style.display = "block";
            }});
        }); 
        $('#commun_edit').change(function(){
            var myvalue = $("#commun_edit option:selected").attr("id");
            $.ajax({url: "/cantons/"+myvalue, success: function(result){
            $("#canto_edit").html(result);
            document.getElementById('cantoncss_edit').style.display = "block";
            }});
        });           
    </script>
    <script>
        $('#canto').change(function(){
            var myvalue = $("#canto option:selected").attr("id");
            $.ajax({url: "/villages/"+myvalue, success: function(result){
            $("#localit").html(result);
            document.getElementById('localitecss').style.display = "block";
            }});
        });
        $('#canto_edit').change(function(){
            var myvalue = $("#canto_edit option:selected").attr("id");
            $.ajax({url:"/villages/"+myvalue, success: function(result){
            $("#localit_edit").html(result);
            document.getElementById('localitecss_edit').style.display = "block";
            }});
        });
    </script>
@endsection