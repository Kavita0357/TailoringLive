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

    <form method="POST" action="{{ route('login') }}" id="login-form">
        {{ csrf_field() }}

        <!-- Username Input -->
        <div class="auth-form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="auth-label" for="username">
                @lang('Username')<span>*</span>
            </label>
            <div class="auth-input-wrapper">
                <input class="auth-input {{ $errors->has('username') ? 'has-error-border' : '' }}" name="username"
                    required autofocus placeholder="Please enter your username" id="username" type="text"
                    value="{{ $username }}" />
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
                <input class="auth-input {{ $errors->has('password') ? 'has-error-border' : '' }}" id="password"
                    type="password" name="password" value="{{ $password }}" required
                    placeholder="Please enter your password" />
                <button type="button" id="show_hide_icon" class="auth-password-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye tw-w-6"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#9CA3AF" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
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
                <a
                    href="{{ route('business.getRegister') }}@if (!empty(request()->lang)) {{ '?lang=' . request()->lang }} @endif">
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
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['superadmin'] }}">SaaS /
                    Superadmin</span>
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['woocommerce'] }}">WooCommerce</span>
                <span class="demo-module-badge demo-login" data-admin="{{ $demo_types['essentials'] }}">Essentials &
                    HRM</span>
                <span class="demo-module-badge demo-login"
                    data-admin="{{ $demo_types['manufacturing'] }}">Manufacturing</span>
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