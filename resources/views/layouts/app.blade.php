@inject('request', 'Illuminate\Http\Request')

@if (
    ($request->segment(1) == 'pos' || $request->segment(1) == 'cloth-pos') &&
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
            background: #139375;
            box-shadow: none;
        }

        .bg-light-blue,
        .label-primary,
        .modal-primary .modal-body,
        .progress-bar {
            background-color: #139375 !important;
        }

        .tw-dw-btn:not(.btn-group .tw-dw-btn):not(.table tr .tw-dw-btn),
        .btn-primary,
        .btn-success {
            background-color: #139375 !important;
            border: 1px solid #139375 !important;
            color: #fff;
        }

        /* .table tr .tw-dw-btn:hover {
            background-color: #139375;
            color: #fff;
            border-color: #fff;
        } */

        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover {
            background-color: #139375;
            border-color: #139375;
        }

        .tw-to-blue-500:hover,
        .tw-from-indigo-600:hover,
        .pos-header .tw-bg-primary-800:hover,
        .tw-dw-btn:hover:not(.table tr .tw-dw-btn:hover),
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active,
        .new-order-button:hover,
        .new-order-button:focus,
        .new-order-button:active {
            background-color: #027257 !important;
            border-color: #027257 !important;
            color: #ffffff;
        }

        .side-bar-link {
            background-color: #007F61 !important;
            height: 62px;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #139375;
        }

        .tw-text-primary-700,
        a {
            color: #139375;
        }

        a:active,
        a:focus,
        a:hover {
            color: #027257;
        }

        .pos-header,
        .pos-footer,
        .main-header,
        .main-header .navbar,
        .main-header .logo {
            background-color: #007F61 !important;
        }

        .col-md-12.no-print.pos-header {
            background-color: #333333 !important;
        }

        .pos-sub-footer {
            padding: 14px;
            /* margin: 0 15px; */
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
            border-radius: 50px;
            background-color: #139375 !important;
            border: 1px solid #139375 !important;
        }

        .new-order-button {
            border-radius: .5rem;
            color: #fff;
            background-color: #139375 !important;
            border: 1px solid #139375 !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true],
        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted[aria-selected=true],
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #139375 !important;
            color: #fff !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected]:hover,
        .select2-container--default .select2-results__option--highlighted[aria-selected=false]:hover,
        .select2-container--default .select2-results__option:hover {
            background-color: #027257 !important;
            color: #fff !important;
        }

        .datatable-length-dropdown .select2-results__options {
            overflow-y: auto !important;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .datatable-length-dropdown .select2-results__options::-webkit-scrollbar {
            display: none;
        }

        /* Select2 Focus & Open Border Colors */
        .select2-container--default.select2-container--open,
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--multiple,
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: #139375 !important;
        }

        /* Form Inputs & Select Focus Borders */
        .form-control:focus,
        select:focus,
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            border-color: #139375 !important;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(19, 147, 117, .6) !important;
        }

        select option:checked,
        select option:focus,
        select option:active {
            background-color: #139375 !important;
            color: #ffffff !important;
        }

        input[type="checkbox"],
        input[type="radio"] {
            accent-color: #139375 !important;
        }

        /* All Page Title Font Weight 700 */
        .content-header h1,
        .content-header h2,
        .content-header h3,
        .content-header .box-title,
        .content-header .title,
        .content h1,
        .content h2,
        .content h3,
        .content .box-title,
        .main-content h1,
        .main-content h2,
        .main-content h3,
        h1.tw-text-xl,
        h1.tw-text-2xl,
        h1.tw-text-3xl {
            font-weight: 700 !important;
        }

        .icheckbox_square-blue,
        .iradio_square-blue,
        .icheckbox_flat-blue,
        .iradio_flat-blue {
            position: relative;
            width: 22px;
            height: 22px;
            background: #ffffff !important;
            border: 2px solid #139375 !important;
            border-radius: 3px;
            transition: background-color .15s ease, border-color .15s ease;
        }

        .iradio_square-blue,
        .iradio_flat-blue {
            border-radius: 50%;
        }

        .icheckbox_square-blue:hover,
        .icheckbox_square-blue.hover,
        .iradio_square-blue:hover,
        .iradio_square-blue.hover,
        .icheckbox_flat-blue:hover,
        .icheckbox_flat-blue.hover,
        .iradio_flat-blue:hover,
        .iradio_flat-blue.hover {
            border-color: #027257 !important;
        }

        .icheckbox_square-blue.checked,
        .iradio_square-blue.checked,
        .icheckbox_flat-blue.checked,
        .iradio_flat-blue.checked {
            background: #139375 !important;
            border-color: #139375 !important;
        }

        .d-none+.select2-container,
        .hide+.select2-container,
        select.d-none+.select2-container,
        select.hide+.select2-container,
        select[style*="display: none"]+.select2-container,
        select[style*="display:none"]+.select2-container {
            display: none !important;
        }

        .icheckbox_square-blue.checked:hover,
        .icheckbox_square-blue.checked.hover,
        .iradio_square-blue.checked:hover,
        .iradio_square-blue.checked.hover,
        .icheckbox_flat-blue.checked:hover,
        .icheckbox_flat-blue.checked.hover,
        .iradio_flat-blue.checked:hover,
        .iradio_flat-blue.checked.hover {
            background: #027257 !important;
            border-color: #027257 !important;
        }

        .icheckbox_square-blue.checked::after,
        .icheckbox_flat-blue.checked::after {
            content: '\2713';
            position: absolute;
            left: 2px;
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            line-height: 18px;
        }

        .iradio_square-blue.checked::after,
        .iradio_flat-blue.checked::after {
            content: '';
            position: absolute;
            inset: 4px;
            background-color: #ffffff;
            border-radius: 50%;
        }

        /* Action Buttons and Info Icons */
        .text-info,
        .text-primary,
        i.text-info,
        i.text-primary {
            color: #139375 !important;
        }

        .btn-info:hover,
        .btn-info:focus,
        .btn-info:active {
            background-color: #027257 !important;
            border-color: #027257 !important;
            color: #ffffff !important;
        }

        .content-header small {
            display: none !important;
        }

        .tailor_menu_mb {
            margin-bottom: 1rem;
        }

        .shipping-modal {
            width: 820px !important;
            max-width: 95vw !important;
        }

        @media (max-width: 768px) {
            .shipping-modal {
                width: 90vw !important;
                max-width: 90vw !important;
            }
        }

        @media (max-width: 425px) {
            .shipping-modal {
                width: 95vw !important;
                max-width: 95vw !important;
            }
        }
    </style>

</head>

<body
    class="tw-font-sans tw-antialiased tw-text-gray-900 tw-bg-gray-100 @if ($pos_layout) hold-transition @else hold-transition skin-@if (!empty(session('business.theme_color'))){{ session('business.theme_color') }}@else{{ 'blue-light' }} @endif sidebar-mini @endif">
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
            <div class="tw-flex-1 tw-overflow-y-auto @if (!$pos_layout) tw-h-screen @endif"
                id="scrollable-container">
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

        <script>
            (function($) {
                function styleDataTableLengthSelects() {
                    $('.dataTables_length select').not('.select2-hidden-accessible').select2({
                        dropdownCssClass: 'datatable-length-dropdown',
                        minimumResultsForSearch: Infinity,
                        width: '95px'
                    });
                }

                $(styleDataTableLengthSelects);
                $(document).on('init.dt draw.dt', function() {
                    window.setTimeout(styleDataTableLengthSelects, 0);
                });
            })(jQuery);
        </script>

        <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

        @if (!empty($__additional_views) && is_array($__additional_views))
            @foreach ($__additional_views as $additional_view)
                @includeIf($additional_view)
            @endforeach
        @endif
        <div>
            <div class="modal fade cloth_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>
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
