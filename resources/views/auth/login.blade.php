@extends('layouts.auth2')
@section('title', __('lang_v1.login'))
@inject('request', 'Illuminate\Http\Request')
@section('content')
@php
    $username = old('username');
    $password = null;
    if (config('app.env') == 'demo') {
        $username = 'admin';
        $password = '123456';

        $demo_types = [
            'all_in_one' => 'admin',
            'super_market' => 'admin',
            'pharmacy' => 'admin-pharmacy',
            'electronics' => 'admin-electronics',
            'services' => 'admin-services',
            'restaurant' => 'admin-restaurant',
            'superadmin' => 'superadmin',
            'woocommerce' => 'woocommerce_user',
            'essentials' => 'admin-essentials',
            'manufacturing' => 'manufacturer-demo',
        ];

        if (!empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types)) {
            $username = $demo_types[$_GET['demo_type']];
        }
    }
@endphp

<div class="login-wrapper">
    <h1 class="login-title">Login</h1>

    <!-- Social Login Buttons (Visual Clones) -->
    <div class="social-login-container">
        <button type="button" class="social-btn google-btn" onclick="alert('Social login is not yet configured for this app.')">
            <svg class="social-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
            </svg>
            Login with Google
        </button>
        <button type="button" class="social-btn apple-btn" onclick="alert('Social login is not yet configured for this app.')">
            <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.17c.66-.81 1.11-1.93.99-3.06-1 .04-2.21.67-2.93 1.49-.62.69-1.16 1.84-1.01 2.96 1.12.09 2.27-.58 2.95-1.39z"/>
            </svg>
            Login with Apple
        </button>
    </div>

    <div class="form-divider">
        <span>Or</span>
    </div>

    <form method="POST" action="{{ route('login') }}" id="login-form">
        {{ csrf_field() }}

        <!-- Username Input -->
        <div class="auth-form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="auth-label" for="username">
                @lang('Username')<span>*</span>
            </label>
            <div class="auth-input-wrapper">
                <input
                    class="auth-input {{ $errors->has('username') ? 'has-error-border' : '' }}"
                    name="username" required autofocus placeholder="Please enter your username"
                    id="username" type="text" value="{{ $username }}" />
            </div>
            @if ($errors->has('username'))
                <span class="auth-error-message">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <!-- Password Input -->
        <div class="auth-form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="auth-label" for="password">
                @lang('Password')<span>*</span>
            </label>
            <div class="auth-input-wrapper">
                <input
                    class="auth-input {{ $errors->has('password') ? 'has-error-border' : '' }}"
                    id="password" type="password" name="password" value="{{ $password }}" required
                    placeholder="Please enter your password" />
                <button type="button" id="show_hide_icon" class="auth-password-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye tw-w-6"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#9CA3AF" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                </button>
            </div>
            @if ($errors->has('password'))
                <span class="auth-error-message">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <!-- Remember Me & Forgot Password Links -->
        <div class="auth-extra-links">
            <label class="auth-checkbox-label">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="auth-checkbox">
                <span>@lang('lang_v1.remember_me')</span>
            </label>

            @if (config('app.env') != 'demo')
                <a href="{{ route('password.request') }}" class="auth-forgot-link">
                    @lang('lang_v1.forgot_your_password')
                </a>
            @endif
        </div>

        <!-- Recaptcha if enabled -->
        @if(config('constants.enable_recaptcha'))
            <div class="auth-form-group">
                <div class="g-recaptcha" data-sitekey="{{ config('constants.google_recaptcha_key') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="auth-error-message">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </div>
        @endif

        <button type="submit" class="auth-submit-btn">
            Next
        </button>
    </form>

    <!-- Sign up bottom link -->
    <div class="auth-footer-text">
        @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
            @if (config('constants.allow_registration'))
                Don't have an account? 
                <a href="{{ route('business.getRegister') }}@if (!empty(request()->lang)) {{ '?lang=' . request()->lang }} @endif">
                    Sign up
                </a>
            @endif
        @endif
    </div>

    <!-- Demo Shops widget inside main panel -->
    @if (config('app.env') == 'demo')
        <div class="demo-shops-card">
            <h3 class="demo-shops-title">Demo Shops</h3>
            <span class="demo-shops-subtitle">Click a business shop below to quickly log in.</span>
            
            <div class="demo-grid">
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['all_in_one'] }}">
                    <i class="fas fa-star"></i> All In One
                </a>
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['pharmacy'] }}">
                    <i class="fas fa-medkit"></i> Pharmacy
                </a>
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['services'] }}">
                    <i class="fas fa-wrench"></i> Service Center
                </a>
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['electronics'] }}">
                    <i class="fas fa-laptop"></i> Electronics
                </a>
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['super_market'] }}">
                    <i class="fas fa-shopping-cart"></i> Super Market
                </a>
                <a href="#" class="demo-btn demo-login" data-admin="{{ $demo_types['restaurant'] }}">
                    <i class="fas fa-utensils"></i> Restaurant
                </a>
            </div>

            <div class="demo-modules-title">Premium Optional Modules</div>
            <div class="demo-modules-list">
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['superadmin'] }}">SaaS / Superadmin</span>
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['woocommerce'] }}">WooCommerce</span>
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['essentials'] }}">Essentials & HRM</span>
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['manufacturing'] }}">Manufacturing</span>
            </div>
        </div>
    @endif
</div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#show_hide_icon').off('click');
            
            $('.change_lang').click(function () {
                window.location = "{{ route('login') }}?lang=" + $(this).attr('value');
            });
            
            $('.demo-login').click(function (e) {
                e.preventDefault();
                $('#username').val($(this).data('admin'));
                $('#password').val("{{ $password }}");
                $('form#login-form').submit();
            });

            $('#show_hide_icon').on('click', function (e) {
                e.preventDefault();
                const passwordInput = $('#password');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    $('#show_hide_icon').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off tw-w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9CA3AF" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"/><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"/><path d="M3 3l18 18"/></svg>');
                }
                else if (passwordInput.attr('type') === 'text') {
                    passwordInput.attr('type', 'password');
                    $('#show_hide_icon').html('<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye tw-w-6" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9CA3AF" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/></svg>');
                }
            });
        })
    </script>
@endsection