@extends('auth.master') @section('content_page')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="{{ asset('asset/images/logo.svg') }}" alt="logo">
                    </div>
                    <h4>{{ __('dashboard.hellow') }}</h4>
                    <h6 class="fw-light">{{ __('dashboard.Sign_in') }}</h6>
                    <form class="pt-3" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror form-control-lg" id="exampleInputEmail1" placeholder="{{ __('dashboard.E-Mail Address') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror form-control-lg" id="exampleInputPassword1" placeholder="{{ __('dashboard.Password') }}" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">{{ __('dashboard.Login') }}</button>
                        </div>

                        <div class="my-2 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input">
                                    {{ __('dashboard.Keep me signed in') }}
                                </label>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
@endsection
