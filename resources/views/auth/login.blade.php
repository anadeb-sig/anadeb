@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')

<div class="col-xxl-9 col-lg-8 col-md-7">
    <div class="auth-bg bg-light py-md-5 p-4 d-flex">
        <div class="bg-overlay-gradient"></div>
        <!-- end bubble effect -->
        <div class="row justify-content-center g-0 align-items-center w-100">
            <div class="col-xl-4 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="px-3 py-3">
                            <div class="text-center">
                                <h5 class="mb-0">Content de vous revoir !</h5>
                                <p class="text-muted mt-2">Connectez-vous pour continuer.</p>
                            </div>
                            @if (session('error'))
                                <span class="text-danger"> {{ session('error') }}</span>
                            @endif
                            <form method="POST" action="{{ route('login') }}" class="mt-4 pt-2">
                                @csrf
                                <div class="form-floating form-floating-custom mb-3">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address." id="input-username" placeholder="Enter User Name">
                                    <label for="input-username">Email</label>
                                    <div class="form-floating-icon">
                                        <i class="uil uil-users-alt"></i>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password-input" placeholder="Enter Password">
                                    <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                    </button>
                                    <label for="password-input">Mot de passe</label>
                                    <div class="form-floating-icon">
                                        <i class="uil uil-padlock"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--<div class="form-check form-check-primary font-size-16 py-1">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <div class="float-end">
                                        <a href="{{route('password.request')}}" class="text-muted text-decoration-underline font-size-14">Mot de passe oublié?</a>
                                    </div>
                                    <label class="form-check-label font-size-14" for="remember-check">
                                        Souvenir!
                                    </label>
                                </div>-->

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Connexion</button>
                                </div>

                                <!--<div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-15 mb-4 text-muted fw-medium">- Ou vous pouvez vous joindre à -</h5>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-soft-primary waves-effect waves-light w-100">
                                            <i class="bx bxl-facebook font-size-16 align-middle"></i> 
                                        </button>
                                        <button type="button" class="btn btn-soft-info waves-effect waves-light w-100">
                                            <i class="bx bxl-linkedin font-size-16 align-middle"></i> 
                                        </button>
                                        <button type="button" class="btn btn-soft-danger waves-effect waves-light w-100">
                                            <i class="bx bxl-google font-size-16 align-middle"></i> 
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 text-center">
                                    <p class="text-muted mb-0"><span>Pas de compte?</span> <a href="#" class=" text-muted fw-semibold text-decoration-none"> &emsp;&emsp;S'inscrire maintenant </a> </p>
                                </div>
                                -->
                            </form><!-- end form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection