
<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo.png') }}" alt="" height="110">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png') }}" alt="" height="52"> <!--<span class="logo-txt">ANADEB</span>-->
                </span>
            </a>
        </div>
        <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
            <i class="fa fa-fw fa-bars font-size-16"></i>
        </button>
    </div>

    <div class="d-flex">
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Profile picture image-->
                @if(!empty(Auth::user()->avatar))
                    <img class="rounded-circle header-profile-user" alt="Avatar" src="/admin/img/{{ Auth::user()->avatar }}">
                @else
                    <img class="rounded-circle header-profile-user" alt="Avatar" src="{{ asset('admin/img/undraw_profile.svg') }}">
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <h6 class="dropdown-header">{{ Auth::user()->last_name." ".Auth::user()->first_name }}</h6>
                <a class="dropdown-item" href="{{ route('profile.detail') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Déconnexion!
                </a>
            </div>
        </div>
    </div>
</div>