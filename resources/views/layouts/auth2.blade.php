<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'POS') }}</title>

    @include('layouts.partials.css')

    @include('layouts.partials.extracss_auth')

    <!-- Custom Premium Auth Stylesheet -->
    <link href="{{ asset('css/auth2.css?v=' . $asset_v) }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="pace-done auth-page-body" data-new-gr-c-s-check-loaded="14.1172.0" data-gr-ext-installed=""
    cz-shortcut-listen="true">
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status') && session('status.success'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
            data-msg="{{ session('status.msg') }}">
    @endif

    <div class="auth-container">
        <div class="auth-sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('img/logo-small.png')}}" alt="Logo" class="sidebar-logo-img" />
            </div>
            <div class="sidebar-footer">
                <h1>Tailoring</h1>
            </div>
        </div>

        <!-- Right Column (Auth Main Panel) -->
        <div class="auth-main">
            <div class="auth-header-actions">
                @include('layouts.partials.language_btn')

                @if(Route::has('repair-status'))
                    <a class="header-action-link"
                        href="{{ action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']) }}">
                        @lang('repair::lang.repair_status')
                    </a>
                @endif

                @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                    <!-- Register Url -->
                    @if (config('constants.allow_registration'))
                        <a href="{{ route('business.getRegister')}}@if(!empty(request()->lang)){{'?lang=' . request()->lang}}@endif"
                            class="header-register-btn">
                            {{ __('business.register') }}
                        </a>
                    @endif
                @endif
                @if ($request->segment(1) != 'login')
                    <a class="header-action-link"
                        href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login'])}}@if(!empty(request()->lang)){{'?lang=' . request()->lang}}@endif">
                        {{ __('business.sign_in') }}
                    </a>
                @endif
            </div>

            <div class="auth-content @yield('auth_class')">
                @yield('content')
            </div>

            <div class="auth-help-container">
                <button class="help-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                    Help
                </button>
            </div>
        </div>
    </div>

    @include('layouts.partials.javascripts')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>

    @yield('javascript')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2_register').select2();

            // Close language dropdown when clicking outside
            $(document).on('click', function (e) {
                const container = $(".lang-dropdown");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.removeAttr('open');
                }
            });
        });
    </script>
</body>

</html>