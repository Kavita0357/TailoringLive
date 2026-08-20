<link href="{{ asset('css/tailwind/app.css?v='.$asset_v) }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/vendor.css?v='.$asset_v) }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

@if( in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) )
	<link rel="stylesheet" href="{{ asset('css/rtl.css?v='.$asset_v) }}">
@endif

@yield('css')

<!-- app css -->
<link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">

@if(isset($pos_layout) && $pos_layout)
	<style type="text/css">
		.content{
			padding-bottom: 0px !important;
		}
	</style>
@endif
<style type="text/css">
	/*
	* Pattern lock css
	* Pattern direction
	* http://ignitersworld.com/lab/patternLock.html
	*/
	.patt-wrap {
	  z-index: 10;
	}
	.patt-circ.hovered {
	  background-color: #cde2f2;
	  border: none;
	}
	.patt-circ.hovered .patt-dots {
	  display: none;
	}
	.patt-circ.dir {
	  background-image: url("{{asset('/img/pattern-directionicon-arrow.png')}}");
	  background-position: center;
	  background-repeat: no-repeat;
	}
	.patt-circ.e {
	  -webkit-transform: rotate(0);
	  transform: rotate(0);
	}
	.patt-circ.s-e {
	  -webkit-transform: rotate(45deg);
	  transform: rotate(45deg);
	}
	.patt-circ.s {
	  -webkit-transform: rotate(90deg);
	  transform: rotate(90deg);
	}
	.patt-circ.s-w {
	  -webkit-transform: rotate(135deg);
	  transform: rotate(135deg);
	}
	.patt-circ.w {
	  -webkit-transform: rotate(180deg);
	  transform: rotate(180deg);
	}
	.patt-circ.n-w {
	  -webkit-transform: rotate(225deg);
	   transform: rotate(225deg);
	}
	.patt-circ.n {
	  -webkit-transform: rotate(270deg);
	  transform: rotate(270deg);
	}
	.patt-circ.n-e {
	  -webkit-transform: rotate(315deg);
	  transform: rotate(315deg);
	}

	/* Universal Select & Select2 Theme Hover/Highlight Colors */
	.select2-container--default .select2-results__option--highlighted,
	.select2-container--default .select2-results__option--highlighted[aria-selected],
	.select2-container--default .select2-results__option--highlighted[aria-selected=true],
	.select2-container--default .select2-results__option--highlighted[aria-selected=false],
	.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable,
	.select2-container--default .select2-results__option[aria-selected=true],
	.select2-container--default .select2-results__option:hover,
	.select2-results__option--highlighted,
	.select2-results__option:hover,
	.select2-results__option[aria-selected=true] {
	    background-color: #139375 !important;
	    color: #ffffff !important;
	}

	.select2-container--default .select2-results__option--highlighted[aria-selected]:hover,
	.select2-container--default .select2-results__option--highlighted[aria-selected=false]:hover,
	.select2-container--default .select2-results__option--highlighted[aria-selected=true]:hover {
	    background-color: #027257 !important;
	    color: #ffffff !important;
	}

	select option:hover,
	select option:focus,
	select option:active,
	select option:checked {
	    background-color: #139375 !important;
	    color: #ffffff !important;
	}

	/* Uniform Select, Select2 & Filter Dropdown Styles (Page Load & Post-Load Consistency) */
	select.form-control,
	select.select2,
	select {
	    -webkit-appearance: none !important;
	    -moz-appearance: none !important;
	    appearance: none !important;
	    border-radius: 6px !important;
	    background-color: #ffffff !important;
	    border: 1px solid #e5e7eb !important;
	    height: 38px !important;
	    padding: 6px 36px 6px 12px !important;
	    font-size: 14px !important;
	    color: #111827 !important;
	    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23374151' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6l6 -6'/%3E%3C/svg%3E") !important;
	    background-repeat: no-repeat !important;
	    background-position: right 12px center !important;
	    background-size: 16px 16px !important;
	    outline: none !important;
	    box-shadow: none !important;
	    transition: all 0.2s ease-in-out !important;
	}

	select.form-control:focus,
	select.select2:focus,
	select:focus {
	    border-color: #139375 !important;
	    box-shadow: 0 0 0 2px rgba(19, 147, 117, 0.2) !important;
	}

	.select2-container--default .select2-selection--single {
	    border-radius: 6px !important;
	    background-color: #ffffff !important;
	    border: 1px solid #e5e7eb !important;
	    height: 38px !important;
	    outline: none !important;
	    box-shadow: none !important;
	    transition: all 0.2s ease-in-out !important;
	}

	.select2-container--default.select2-container--open .select2-selection--single,
	.select2-container--default.select2-container--focus .select2-selection--single {
	    border-color: #139375 !important;
	    box-shadow: 0 0 0 2px rgba(19, 147, 117, 0.2) !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    line-height: 34px !important;
	    padding-right: 36px !important;
	    color: #111827 !important;
	    font-size: 14px !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
	    height: 36px !important;
	    width: 16px !important;
	    position: absolute !important;
	    top: 1px !important;
	    right: 12px !important;
	    display: flex !important;
	    align-items: center !important;
	    justify-content: center !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow b {
	    border: none !important;
	    width: 16px !important;
	    height: 16px !important;
	    margin: 0 !important;
	    top: auto !important;
	    left: auto !important;
	    position: static !important;
	    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23374151' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6l6 -6'/%3E%3C/svg%3E") !important;
	    background-repeat: no-repeat !important;
	    background-position: center !important;
	    background-size: 16px 16px !important;
	}

	.filter-box {
	    display: inline-block;
	    min-width: 160px;
	}

	.filter-box select,
	.filter-box .select2-container {
	    width: 100% !important;
	}

	#dashboard_date_filter {
	    border-radius: 6px !important;
	    height: 38px !important;
	    border: 1px solid #e5e7eb !important;
	    padding-left: 12px !important;
	    padding-right: 12px !important;
	}
</style>
@if(!empty($__system_settings['additional_css']))
    {!! $__system_settings['additional_css'] !!}
@endif

