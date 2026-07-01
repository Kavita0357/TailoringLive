@extends('layouts.app')
@section('title', __('tailoring.tailor_master_dashboard'))

@section('content')
    <section class="content">
        <div
            class="tw-pb-6 tw-bg-gradient-to-r tw-from-@if (!empty(session('business.theme_color'))) {{ session('business.theme_color') }}@else{{ 'primary' }} @endif-800 tw-to-@if (!empty(session('business.theme_color'))) {{ session('business.theme_color') }}@else{{ 'primary' }} @endif-900 xl:tw-pb-0 ">
            <div class="tw-pt-3 tw-mb-4">
                <div class="tw-flex tw-items-center tw-justify-between tw-gap-3">
                    <div class="filter-box">
                        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
                            @lang('tailoring.tailor_master_dashboard')</h1>
                    </div>
                    <div class="filter-box" style="width: 250px;">
                        {!! Form::select('location_id', $business_locations, $location_id, [
                            'class' => 'form-control select2',
                            'placeholder' => __('lang_v1.select_location'),
                            'id' => 'location_id',
                            'style' => 'width: 100%;'
                        ]) !!}
                    </div>
                </div>

                @can('user.view')
                    <div class="tw-grid tw-grid-cols-1 tw-gap-4 tw-mt-6 sm:tw-grid-cols-2 xl:tw-grid-cols-4 sm:tw-gap-5">
                        <div
                            class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                            <div class="tw-p-4 sm:tw-p-5">
                                <div class="tw-flex tw-items-center tw-gap-4">
                                    <div class="tw-flex-1 tw-min-w-0">
                                        <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                            @lang('tailoring.total_tailor_masters')
                                        </p>
                                        <p
                                            class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                            <span id="total_tailor_masters_card">{{ $total_tailor_masters }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                            <div class="tw-p-4 sm:tw-p-5">
                                <div class="tw-flex tw-items-center tw-gap-4">
                                    <div class="tw-flex-1 tw-min-w-0">
                                        <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                            @lang('tailoring.total_completed_orders')
                                        </p>
                                        <p
                                            class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                            <span id="total_completed_orders_card">{{ number_format($total_completed_orders, 2) }}</span> Pcs
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw--translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                            <div class="tw-p-4 sm:tw-p-5">
                                <div class="tw-flex tw-items-center tw-gap-4">
                                    <div class="tw-flex-1 tw-min-w-0">
                                        <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                            @lang('tailoring.total_wages')
                                        </p>
                                        <p
                                            class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                            <span id="total_wages_card" class="display_currency" data-currency_symbol="true">{{ $total_wages }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                            <div class="tw-p-4 sm:tw-p-5">
                                <div class="tw-flex tw-items-center tw-gap-4">
                                    <div class="tw-flex-1 tw-min-w-0">
                                        <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                            @lang('tailoring.total_wages_paid')
                                        </p>
                                        <p
                                            class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                            <span id="total_wages_paid_card" class="display_currency"
                                                data-currency_symbol="true">{{ $total_wages_paid }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                            <div class="tw-p-4 sm:tw-p-5">
                                <div class="tw-flex tw-items-center tw-gap-4">
                                    <div class="tw-flex-1 tw-min-w-0">
                                        <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                            @lang('tailoring.total_wages_due')
                                        </p>
                                        <p
                                            class="tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                            <span id="total_wages_due_card" class="display_currency"
                                                data-currency_symbol="true">{{ $total_wages_due }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

        @can('user.view')
            <div
                class="box-primary tw-mb-4 tw-transition-all lg:tw-col-span-2 tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 hover:tw-shadow-md hover:tw-translate-y-0.5 tw-ring-gray-200">
                <div class="tw-p-2 sm:tw-p-3">
                    <div class="box-header tw-flex tw-items-center tw-justify-between">
                        <h3 class="box-title">@lang('tailoring.completed_orders')</h3>
                        <div class="box-tools">
                            {!! Form::select('tailor_master_filter_id', $tailor_masters->pluck('name', 'user_id'), null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('tailoring.all_tailor_masters'),
                                'id' => 'tailor_master_filter_id',
                                'style' => 'width: 200px;'
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="tw-flow-root tw-border-gray-200">
                    <div>
                        <div class="tw-py-2 tw-align-middle sm:tw-px-5">
                            <table class="table table-bordered table-striped tw-mb-0" id="tailor_masters_dashboard_table">
                                <thead>
                                    <tr>
                                        {{-- <th>@lang('messages.action')</th> --}}
                                        <th>@lang('tailoring.date')</th>
                                        <th>@lang('tailoring.particulars')</th>
                                        <th>@lang('tailoring.wages')</th>
                                        <th>@lang('tailoring.tailor_master')</th>
                                        <th>@lang('tailoring.payment_status')</th>
                                        <th>@lang('tailoring.total_paid')</th>
                                        <th>@lang('tailoring.total_due')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
    </section>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            @can('user.view')
                var tailor_masters_table = $('#tailor_masters_dashboard_table').DataTable({
                    processing: true,
                    serverSide: true,
                    fixedHeader: false,
                    ajax: {
                        url: '/tailor-master/list',
                        data: function (d) {
                            d.is_dashboard = 'true';
                            d.location_id = $('#location_id').val();
                            d.tailoring_master_id = $('#tailor_master_filter_id').val();
                        }
                    },
                    order: [
                        [0, 'asc']
                    ],
                    columns: [
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false
                        // },
                        {
                            data: 'added_on',
                            name: 'transaction_date'
                        },
                        {
                            data: 'particulars',
                            name: 'particulars',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'total_wages',
                            name: 'total_wages',
                            render: $.fn.dataTable.render.number(',', '.', 2, ''),
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tailor_master',
                            name: 'tailor_master',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'payment_status',
                            name: 'payment_status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'total_wages_paid',
                            name: 'total_wages_paid',
                            render: $.fn.dataTable.render.number(',', '.', 2, ''),
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'total_wages_due',
                            name: 'total_wages_due',
                            render: $.fn.dataTable.render.number(',', '.', 2, ''),
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                tailor_masters_table.on('xhr.dt', function (e, settings, json, xhr) {
                    if (json && json.totals !== undefined) {
                        var totals = json.totals;
                        $('#total_tailor_masters_card').text(totals.total_tailor_masters);
                        $('#total_completed_orders_card').text(__currency_trans_from_en(totals.total_completed_orders, false, false, __currency_precision, true));
                        $('#total_wages_card').text(__currency_trans_from_en(totals.total_wages, true));
                        $('#total_wages_paid_card').text(__currency_trans_from_en(totals.total_wages_paid, true));
                        $('#total_wages_due_card').text(__currency_trans_from_en(totals.total_wages_due, true));
                    }
                });

                if ($('#location_id').length) {
                    $('#location_id').select2();
                    $('#location_id').change(function() {
                        tailor_masters_table.ajax.reload();
                    });
                }

                if ($('#tailor_master_filter_id').length) {
                    $('#tailor_master_filter_id').select2();
                    $('#tailor_master_filter_id').change(function() {
                        tailor_masters_table.ajax.reload();
                    });
                }
            @endcan

            $(document).on('click', '.delete_user_button', function () {
                var delete_button = $(this);
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_user,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "DELETE",
                            url: delete_button.data('href'),
                            dataType: "json",
                            success: function (result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    if (typeof tailor_masters_table !== 'undefined') {
                                        tailor_masters_table.ajax.reload();
                                    }
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.update_tailor_status', function (e) {
                e.preventDefault();
                var status_button = $(this);
                $.ajax({
                    method: "POST",
                    url: status_button.attr('href'),
                    dataType: "json",
                    success: function (result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            if (typeof tailor_masters_table !== 'undefined') {
                                tailor_masters_table.ajax.reload();
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('click', '.pay_tailor_due', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                $.ajax({
                    url: href,
                    dataType: 'html',
                    success: function (result) {
                        $('.pay_contact_due_modal').html(result).modal('show');
                    }
                });
            });

            $(document).on('submit', 'form#tailor_master_edit_form', function (e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();
                $.ajax({
                    method: "POST",
                    url: form.attr('action'),
                    dataType: "json",
                    data: data,
                    success: function (result) {
                        if (result.success == true) {
                            $('.user_modal').modal('hide');
                            toastr.success(result.msg);
                            if (typeof tailor_masters_table !== 'undefined') {
                                tailor_masters_table.ajax.reload();
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection