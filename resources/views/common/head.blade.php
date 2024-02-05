<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>ANADEB</title>
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

<link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/boxicons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- gridjs css 
<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
-->
<link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css')}}">
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<script src="{{ asset('assets/libs/ajax/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.synecole.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.syncanton.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.syncommune.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.synprefecture.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.synregion.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.arf.js') }}"></script>
<script type="text/javascript" src="{{ asset('./assets/gridjs/gridjs.compta.js') }}"></script>

<style>

    .hidden {
        display: none;
    }

    .rotate {
        transform: rotate(90deg);
        transition: transform 0.3s ease-in-out;
    }
    .btn_export{
        background-color: #126e51;
        color: white;
    }
    .ajout, .export{
        font-size: 1.1rem;
        color: #fff;
        background-color: #5f9ea0;
        border-color: #126e51;
    }
    .filtre{
        color:#5f9ea0;
    }
    .recherche{
        background-color: #5f9ea0;
        color: white;
    }
    .text_export{
        font-size: medium;
        color: #c77b39;
    }
    .h3{
        color: #5f9ea0;
        font-size: 1.75em;
    }
    .majuscules{
        text-transform: uppercase;
    }
    /* Propriété CSS avec plusieurs préfixes de fournisseur */
    #sidebar-menu ul li ul.sub-menu li ul.sub-menu li a {
        padding: .4rem 1.5rem .4rem 3.5rem;
    }

    body {
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    .gridjs-tr td, .gridjs-tr th{
        text-align: left!important;
    }
    /**.gridjs-th{
        min-width: 311px;
        width: 380px!important;
    }*/
    #sidebar-menu ul li a{
        color: #515154;
    }

    #sidebar-menu ul li a{
        color: #515154;
    }

    .menu-title {
        color: #0b0b0b;
    }

    #sidebar-menu ul li ul.sub-menu li a {
        color: #0b0b0b;
    }

    #sidebar-menu ul li ul.sub-menu {
        padding: 0;
        background-color: #eeedf9;
        margin-right: 10px;
        margin-left: 10px;
        border-radius: 5px;
        margin-top: 2px;
    }
    
    .modal-title{
        color: #776acf;
        text-transform: uppercase;
    }

    #scrollToTopBtn {
    display: none; /* Hide the button by default */
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99;
    font-size: 14px;
    padding: 10px;
    border: none;
    outline: none;
    background-color: #5f9ea0;
    color: #fff;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.3s;
    }

    #scrollToTopBtn:hover {
    opacity: 1;
    }

    @media screen and (min-width: 769px){
        .header-search .search-widget {
            align-items: center;
            display: flex;
            gap: .5rem;
        }
    }
    .header-search .search-widget {
        margin: 0 auto;
        max-width: 20rem;
        position: relative;
        width: 100%;
    }

    .button.action.has-icon {
        --button-font: var(--type-emphasis-m);
        text-transform: none;
    }
    .button.clear-search-button {
        display: none;
    }

    .button.clear-search-button, .button.search-button {
        --button-color: var(--icon-secondary);
        --button-height: 1.5rem;
        --button-padding: 0;
        position: absolute;
        border: none;
        background-color: #fff;
        right: .75rem;
        width: 1.5rem;
    }
    .button .icon {
        background-color: var(--button-color);
        margin: 0 -1px;
    }
    .button-wrap {
        align-items: center;
        background-color: var(--button-bg);
        border: 1px solid var(--button-border-color);
        border-radius: var(--button-radius);
        color: var(--button-color);
        display: flex;
        font: var(--button-font);
        gap: .25rem;
        height: var(--button-height);
        justify-content: center;
        padding-left: var(--button-padding);
        padding-right: var(--button-padding);
        position: relative;
    }

    #add_repas, .header-search {
    display: inline-block;
    }

</style>
</head>