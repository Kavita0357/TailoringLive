@extends('layouts.auth2')
@section('title', __('lang_v1.reset_password'))

@section('content')
<div class="login-wrapper">
    <h1 class="login-title">@lang('lang_v1.reset_password')</h1>

    @if (session('status') && is_string(session('status')))
        <div class="alert alert-info" role="alert" style="margin-bottom: 20px; border-radius: 8px; font-size: 14px; font-weight: 500;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" id="login-form">
        {{ csrf_field() }}

        <!-- Email Input -->
        <div class="auth-form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="auth-label" for="email">
                @lang('Email')<span>*</span>
            </label>
            <div class="auth-input-wrapper">
                <input
                    id="email" type="email" 
                    class="auth-input {{ $errors->has('email') ? 'has-error-border' : '' }}" 
                    name="email" value="{{ old('email') }}" required autofocus 
                    placeholder="@lang('lang_v1.email_address')">
            </div>
            @if ($errors->has('email'))
                <span class="auth-error-message">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="auth-submit-btn">
            @lang('lang_v1.send_password_reset_link')
        </button>
    </form>
<!-- 
    <div class="auth-footer-text" style="margin-top: 24px;">
        <a href="{{ route('login') }}" class="auth-forgot-link">
            Back to login
        </a>
    </div> -->
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.change_lang').click(function() {
                window.location = "{{ route('password.request') }}?lang=" + $(this).attr('value');
            });
        })
    </script>
@endsection