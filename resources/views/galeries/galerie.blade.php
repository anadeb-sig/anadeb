@extends('layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Galérie Photos</h1>
        <!--<a href="javascript:void(0)" class="btn btn-sm btn-primary" id="add_galerie" style="font-size: 1.1rem;">
            <i class="fas fa-plus"></i>
        </a>-->
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <ul class="list-inline categories-filter button-group" id="filter">
                        <li class="list-inline-item"><a class="categories active" data-filter="*">Toutes</a></li>
                        @foreach($typeouvrages as $typeouvrage)
                            <li class="list-inline-item"><a class="categories" data-filter=".{{ str_replace(' ', '', $typeouvrage->nom_type) }}">{{ $typeouvrage->nom_type }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row gallery-wrapper" style="position: relative; height: 489.547px;">
                        @foreach($suivis as $element)
                            <div class="element-item col-xl-4 col-sm-6 {{ $element->suivi->signer->ouvrage->typeouvrage->nom_type }}" data-category="{{ $element->suivi->signer->ouvrage->typeouvrage->nom_type }}" style="position: absolute; left: 0px; top: 0px;">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="/images/{{$element->photo}}" data-title="{{ $element->nom_ouvrage }}" data-description="{{$element->descrip}}">
                                            <img class="gallery-img img-fluid mx-auto" src="/images/{{$element->photo}}" alt="">
                                            <div class="gallery-overlay"></div>
                                        </a>
                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">{{ $element->nom_ouvrage }}</h5>
                                        <p class="post"> <a href="#" class="text-body">{{ $element->niveau_exe }}</a></p>
                                    </div>
                                </div>
                            </div>
                            @if($loop->iteration % 3 == 0)
                                </br>
                            @endif
                        @endforeach
                    </div>
                    <!-- end row -->
                    <!-- end row -->
                </div>
                <!-- ene card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <!-- or -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/lightbox.init.js')}}"></script>
    <script src="{{ asset('assets/libs/isotope-layout/isotope.pkgd.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/gallery.init.js')}}"></script>
@endsection