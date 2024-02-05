<!-- LOGO -->
<style>
    .sous_menu{
        font-weight: 80;
        margin-right: 5%;
    }
    hr{
        color: wheat;
    }
</style>

<div class="navbar-brand-box">
    <a href="{{ route('home') }}" class="logo logo-dark">
        <span class="logo-sm">
            <img src="{{asset('assets/images/ANADEB.png') }}" alt="ANADEB" height="26">
        </span>
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo.png') }}" alt="ANADEB" height="116"> <!--<span class="logo-txt">ANADEB</span>-->
        </span>
    </a>

    <a href="{{ route('home') }}" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{asset('assets/images/ANADEB.png') }}" alt="ANADEB" height="26">
        </span>
        <span class="logo-lg">
            <img src="{{asset('assets/images/ANADEB.png') }}" alt="ANADEB" height="26"> <span class="logo-txt">ANADEB</span>
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li>
                <a href="{{ route('home') }}" class="mt-5">
                    <!--<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>-->
                    <i style="font-size:15px" class="fa">&#xf080;</i>
                    <span class="menu-item" data-key="t-dashboard">Accueil</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-map-marker"></i>
                    <span class="menu-item" data-key="t-localisation">Localisation</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        @can('village-index')
                            <li><a href="{{ route('villages.index') }}" data-key="t-village"><i class="fa fa-circle sous_menu"></i>Villages</a></li>
                        @endcan
                        @can('canton-index')
                            <li><a href="{{ route('cantons.index') }}" data-key="t-canton"><i class="fa fa-circle sous_menu"></i>Cantons</a></li>
                        @endcan
                        @can('commune-index')
                            <li><a href="{{ route('communes.index') }}" data-key="t-commune"><i class="fa fa-circle sous_menu"></i>Communes</a></li>
                        @endcan
                        @can('prefecture-index')
                            <li><a href="{{ route('prefectures.index') }}" data-key="t-prefecture"><i class="fa fa-circle sous_menu"></i>Préfectures</a></li>
                        @endcan
                        @can('region-index')
                            <li><a href="{{ route('regions.index') }}" data-key="t-region"><i class="fa fa-circle sous_menu"></i>Régions</a></li>
                        @endcan
                    </li>
                </ul>
            </li>

            <hr class="sidebar-divider">
            
            <li>
                @can('financement-index')
                    <a href="{{ route('financements.index') }}">
                        <i class="fa fa-dollar-sign" style="padding-right: 5px;"></i>
                        <span class="menu-item" data-key="t-financement">Financement</span>
                    </a>
                @endcan
            </li>

            <!-- Divider -->
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Aadb')  || Auth::user()->hasRole('Assistant')|| Auth::user()->hasRole('Hierachie'))
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="menu-title" data-key="t-basic" style="display:none;">
                    Administration des données
                </div>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square feather-xl text-white-50"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>-->
                        
                        <i class='far fa-edit' style='font-size:15px'></i>
                        <span class="menu-item" data-key="t-donnees">Cantine scolaire</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            @can('ecole-index')
                                <li><a href="{{ route('ecoles.index') }}" data-key="t-ecole"><i class="fa fa-circle sous_menu"></i>Cantines</a></li>
                            @endcan
                            @can('classe-index')
                                <li><a href="{{ route('classes.index') }}" data-key="t-enseignement"><i class="fa fa-circle sous_menu"></i>Ecole</a></li>
                            @endcan
                            @can('repas-index')
                                <li><a href="{{ route('repas.index') }}" data-key="t-repas"><i class="fa fa-circle sous_menu"></i>Repas</a></li>
                            @endcan
                            @can('visite-index')
                                <li><a href="{{ route('visites.index') }}" data-key="t-visites"><i class="fa fa-circle sous_menu"></i>Visites</a></li>
                            @endcan
                            <!--@can('menu-index')
                                <li><a href="{{ route('menus.index') }}" data-key="t-basic">Menus</a></li>
                            @endcan-->
                        </li>

                        <hr class="sidebar-divider">

                        <li>
                            @can('synthese-arf')
                                <a href="{{ route('repas.synthese_arf') }}">
                                    <i class="fa fa-circle sous_menu" style="padding-right: 5px;"></i>
                                    <span class="menu-item" data-key="t-financement">Rapport détaillé</span>
                                </a>
                            @endcan
                        </li>
                        
                        <hr class="sidebar-divider">

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span class="menu-item" data-key="t-synthese">Synthèse cantine</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    @can('synthese-ecole')
                                        <li><a href="{{ route('repas.synthese_ecole') }}" data-key="t-synthese_ecole"><i class="fa fa-circle sous_menu"></i>Par cantine</a></li>
                                    @endcan
                                    @can('synthese-canton')
                                        <li><a href="{{ route('repas.synthese_canton') }}" data-key="t-synthese_canton"><i class="fa fa-circle sous_menu"></i>Par canton</a></li>
                                    @endcan
                                    @can('synthese-commune')
                                        <li><a href="{{ route('repas.synthese_commune') }}" data-key="t-synthese_commune"><i class="fa fa-circle sous_menu"></i>Par commune</a></li>
                                    @endcan
                                    @can('synthese-prefecture')
                                        <li><a href="{{ route('repas.synthese_prefecture') }}" data-key="t-synthese_prefecture"><i class="fa fa-circle sous_menu"></i>Par préfecture</a></li>
                                    @endcan
                                    @can('synthese-region')
                                        <li><a href="{{ route('repas.synthese_region') }}" data-key="t-synthese_region"><i class="fa fa-circle sous_menu"></i>Par région</a></li>
                                    @endcan
                                    @can('synthese-comptabilite')
                                        <li><a href="{{ route('repas.synthese_comptabilite') }}" data-key="t-synthese_comptabilite"><i class="fa fa-circle sous_menu"></i>Comptabilité</a></li>
                                    @endcan
                                </li>
                            </ul>
                        </li>
                        @can('menu-index')
                            <hr class="sidebar-divider">
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="fa fa-cog fa-spin"></i>
                                    <span class="menu-item" data-key="t-synthese">Parametrage</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <li><a href="{{ route('menus.index')}}" data-key="t-menu"><i class="fa fa-circle sous_menu"></i>Coût du plat</a></li>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <hr class="sidebar-divider">
                    </ul>
                </li>
            @endif
            
        
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Infra') || Auth::user()->hasRole('Hierachie'))
                <hr class="sidebar-divider">
                <!-- Divider -->
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span class="menu-item" data-key="t-contrats">Infrastructures</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <li><a href="{{ route('entreprises.index') }}" data-key="t-entreprise"><i class="fa fa-circle sous_menu"></i> Entreprises</a></li>
                            <li><a href="{{ route('ouvrages.index') }}" data-key="t-ouvrages"><i class="fa fa-circle sous_menu"></i> Ouvrages</a></li>
                            <li><a href="{{ route('contrats.index') }}" data-key="t-contrats"><i class="fa fa-circle sous_menu"></i> Contrats</a></li>
                            <li><a href="{{ route('suivis.index') }}" data-key="t-suivis"><i class="fa fa-circle sous_menu"></i> Suivis</a></li>
                            <li><a href="{{ route('suivis.galerie') }}" data-key="t-galerie"><i class="fa fa-circle sous_menu"></i> Galérie photos</a></li>
                            <li><a href="{{ route('typeouvrages.index') }}" data-key="t-typeouvrages"><i class="fa fa-circle sous_menu"></i> Type d'ouvrages</a></li>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider">

            @hasrole('Admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa fa-cog fa-spin"></i>
                        <span class="menu-item" data-key="t-gestion">Gestion des accès</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('roles.index') }}" data-key="t-role"><i class="fa fa-circle sous_menu"></i>Liste rôles</a></li>
                        <li><a href="{{ route('permissions.index') }}" data-key="t-permission"><i class="fa fa-circle sous_menu"></i>Liste permissions</a></li>
                        <li><a href="{{ route('users.index') }}" data-key="t-user"><i class="fa fa-circle sous_menu"></i>Liste utilisateurs</a></li>
                    </ul>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            @endhasrole

            <li>
                <a href="javascript: void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-item">Déconnexion!</span>
                </a>
            </li> 
            <hr class="sidebar-divider" style="color:#73a6dd">
        </ul>
    </div>
    <!-- Sidebar -->
</div>