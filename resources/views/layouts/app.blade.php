@inject('request', 'Illuminate\Http\Request')

@if (
    $request->segment(1) == 'pos' &&
        ($request->segment(2) == 'create' || $request->segment(3) == 'edit' || $request->segment(2) == 'payment'))
    @php
        $pos_layout = true;
    @endphp
@else
    @php
        $pos_layout = false;
    @endphp
@endif

@php
    $whitelist = ['127.0.0.1', '::1'];
@endphp

<!DOCTYPE html>
<html class="tw-bg-white tw-scroll-smooth" lang="{{ app()->getLocale() }}"
    dir="{{ in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr' }}">

<head>
    <!-- Tell the browser to be responsive to screen width -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
        name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ Session::get('business.name') }}</title>

    @include('layouts.partials.css')


    @include('layouts.partials.extracss')

    @yield('css')

    <style type="text/css">
        .tw-to-blue-500,
        .tw-from-indigo-600,
        div.pos-tab-menu div.list-group>a.active,
        div.pos-tab-menu div.list-group>a.active .glyphicon,
        div.pos-tab-menu div.list-group>a.active .fa {
            background: #ed143d;
            box-shadow: none;
        }

        .bg-light-blue,
        .label-primary,
        .modal-primary .modal-body,
        .progress-bar {
            background-color: #ed143d !important;
        }

        .tw-dw-btn:not(.btn-group .tw-dw-btn):not(.table tr .tw-dw-btn) {
            background-color: #ed143d;
            border: 1px solid #ed143d;
            color: #fff;
        }

        /* .table tr .tw-dw-btn:hover {
            background-color: #ed143d;
            color: #fff;
            border-color: #fff;
        } */

        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover {
            background-color: #ed143d;
            border-color: #ed143d;
        }

        .tw-to-blue-500:hover,
        .tw-from-indigo-600:hover,
        .pos-header .tw-bg-primary-800:hover,
        .tw-dw-btn:hover:not(.table tr .tw-dw-btn:hover) {
            background: #912018;
            color: #ffffff;
        }

        .side-bar-link {
            background-color: #333;
            height: 62px;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #ed143d;
        }

        .tw-text-primary-700,
        a {
            color: #ed143d;
        }

        a:active,
        a:focus,
        a:hover {
            color: #912018;
        }

        .pos-header,
        .pos-footer {
            background-color: #333333;
        }

        .pos-sub-footer {
            padding: 15px 30px 10px 30px;
            margin: 0 15px;
            width: auto;
        }

        .pos-sub-header {
            margin: 15px auto;
        }

        .pos-tab-content select,
        .pos-tab-content input {
            background-color: #ffffff;
        }

        .pos-header .tw-bg-primary-800 {
            background-color: #ed143d;
            border-radius: 50px;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #3c8dbc;
            color: #fff;
        }
    </style>

</head>

<body
    class="tw-font-sans tw-antialiased tw-text-gray-900 tw-bg-gray-100 @if ($pos_layout) hold-transition lockscreen @else hold-transition skin-@if (!empty(session('business.theme_color'))){{ session('business.theme_color') }}@else{{ 'blue-light' }} @endif sidebar-mini @endif">
    <div class="tw-flex">
        <script type="text/javascript">
            if (localStorage.getItem("upos_sidebar_collapse") == 'true') {
                var body = document.getElementsByTagName("body")[0];
                body.className += " sidebar-collapse";
            }
        </script>
        @if (!$pos_layout)
            @include('layouts.partials.sidebar')
        @endif

        @if (in_array($_SERVER['REMOTE_ADDR'], $whitelist))
            <input type="hidden" id="__is_localhost" value="true">
        @endif

        <!-- Add currency related field-->
        <input type="hidden" id="__code" value="{{ session('currency')['code'] }}">
        <input type="hidden" id="__symbol" value="{{ session('currency')['symbol'] }}">
        <input type="hidden" id="__thousand" value="{{ session('currency')['thousand_separator'] }}">
        <input type="hidden" id="__decimal" value="{{ session('currency')['decimal_separator'] }}">
        <input type="hidden" id="__symbol_placement" value="{{ session('business.currency_symbol_placement') }}">
        <input type="hidden" id="__precision" value="{{ session('business.currency_precision', 2) }}">
        <input type="hidden" id="__quantity_precision" value="{{ session('business.quantity_precision', 2) }}">
        <!-- End of currency related field-->
        @can('view_export_buttons')
            <input type="hidden" id="view_export_buttons">
        @endcan
        @if (isMobile())
            <input type="hidden" id="__is_mobile">
        @endif
        @if (session('status'))
            <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
                data-msg="{{ session('status.msg') }}">
        @endif
        <main class="tw-flex tw-flex-col tw-flex-1 tw-h-full tw-min-w-0 tw-bg-gray-100">

            @if (!$pos_layout)
                @include('layouts.partials.header')
            @else
                @include('layouts.partials.header-pos')
            @endif
            <!-- empty div for vuejs -->
            <div id="app">
                @yield('vue')
            </div>
            <div class="tw-flex-1 tw-overflow-y-auto tw-h-screen" id="scrollable-container">
                @yield('content')
                @if (!$pos_layout)

                    @include('layouts.partials.footer')
                @else
                    @include('layouts.partials.footer_pos')
                @endif
            </div>
            <div class='scrolltop no-print'>
                <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
            </div>

            @if (config('constants.iraqi_selling_price_adjustment'))
                <input type="hidden" id="iraqi_selling_price_adjustment">
            @endif

            <!-- This will be printed -->
            <section class="invoice print_section" id="receipt_section">
            </section>
        </main>

        @include('home.todays_profit_modal')
        <!-- /.content-wrapper -->



        <audio id="success-audio">
            <source src="{{ asset('/audio/success.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/success.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>
        <audio id="error-audio">
            <source src="{{ asset('/audio/error.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/error.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>
        <audio id="warning-audio">
            <source src="{{ asset('/audio/warning.ogg?v=' . $asset_v) }}" type="audio/ogg">
            <source src="{{ asset('/audio/warning.mp3?v=' . $asset_v) }}" type="audio/mpeg">
        </audio>

        @if (!empty($__additional_html))
            {!! $__additional_html !!}
        @endif

        @include('layouts.partials.javascripts')

        <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

        @if (!empty($__additional_views) && is_array($__additional_views))
            @foreach ($__additional_views as $additional_view)
                @includeIf($additional_view)
            @endforeach
        @endif
        <div>

            <div class="overlay tw-hidden"></div>
</body>
<style>
    @media print {
        #scrollable-container {
            overflow: visible !important;
            height: auto !important;
        }
    }
</style>
<style>
    .small-view-side-active {
        display: grid !important;
        z-index: 1000;
        position: absolute;
    }

    .overlay {
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        position: fixed;
        top: 0;
        left: 0;
        display: none;
        z-index: 20;
    }

    .tw-dw-btn.tw-dw-btn-xs.tw-dw-btn-outline {
        width: max-content;
        margin: 2px;
    }

    #scrollable-container {
        position: relative;
    }
</style>

</html>
