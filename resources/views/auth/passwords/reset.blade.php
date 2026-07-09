@extends('layouts.auth2')
@section('title', __('lang_v1.reset_password'))

@section('content')
    <div class="login-wrapper">
        <h1 class="login-title">@lang('lang_v1.reset_password')</h1>

        <form method="POST" action="{{ route('password.request') }}" id="login-form">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="auth-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="auth-label" for="email">
                    @lang('Email')<span>*</span>
                </label>
                <div class="auth-input-wrapper">
                    <input id="email" type="email" class="auth-input {{ $errors->has('email') ? 'has-error-border' : '' }}"
                        name="email" value="{{ $email ?? old('email') }}" required autofocus
                        placeholder="@lang('lang_v1.email_address')">
                </div>
                @if ($errors->has('email'))
                    <span class="auth-error-message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <!-- Password Input -->
            <div class="auth-form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="auth-label" for="password">
                    @lang('lang_v1.password')<span>*</span>
                </label>
                <div class="auth-input-wrapper">
                    <input id="password" type="password"
                        class="auth-input {{ $errors->has('password') ? 'has-error-border' : '' }}" name="password" required
                        placeholder="@lang('lang_v1.password')">
                </div>
                @if ($errors->has('password'))
                    <span class="auth-error-message">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <!-- Confirm Password Input -->
            <div class="auth-form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="auth-label" for="password_confirmation">
                    @lang('business.confirm_password')<span>*</span>
                </label>
                <div class="auth-input-wrapper">
                    <input id="password_confirmation" type="password"
                        class="auth-input {{ $errors->has('password_confirmation') ? 'has-error-border' : '' }}"
                        name="password_confirmation" required placeholder="@lang('business.confirm_password')">
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="auth-error-message">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="auth-submit-btn">
                @lang('lang_v1.reset_password')
            </button>
        </form>

        <!-- <div class="auth-footer-text" style="margin-top: 24px;">
            <a href="{{ route('login') }}" class="auth-forgot-link">
                Back to login
            </a>
        </div> -->
    </div>
@endsection