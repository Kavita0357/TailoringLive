@extends('layouts.app')
@section('title', __('lang_v1.tailor_master_payment_report'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">{{ __('lang_v1.tailor_master_payment_report')}}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @component('components.filters', ['title' => __('report.filters')])
                {!! Form::open(['url' => '#', 'method' => 'get', 'id' => 'tailor_master_payment_report_form']) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('tailor_id', __('tailoring.tailor_master') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('tailor_id', $tailor_masters, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select'), 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select'), 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('tmpr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'tmpr_date_filter', 'readonly']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tailor_master_payment_report_table">
                        <thead>
                            <tr>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('lang_v1.paid_on')</th>
                                <th>@lang('sale.amount')</th>
                                <th>@lang('tailoring.tailor_master')</th>
                                <th>@lang('lang_v1.payment_method')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="2"><strong>@lang('sale.total'):</strong></td>
                                <td><span class="display_currency" id="footer_total_amount"
                                        data-currency_symbol="true"></span></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endcomponent
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var tailor_master_payment_report = $('table#tailor_master_payment_report_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                aaSorting: [[1, 'desc']],
                ajax: {
                    url: '/reports/tailor-master-payment-report',
                    data: function (d) {
                        d.tailor_id = $('select#tailor_id').val();
                        d.location_id = $('select#location_id').val();
                        var start = '';
                        var end = '';
                        if ($('input#tmpr_date_filter').val()) {
                            start = $('input#tmpr_date_filter')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            end = $('input#tmpr_date_filter')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;
                    },
                },
                columns: [
                    { data: 'payment_ref_no', name: 'payment_ref_no' },
                    { data: 'paid_on', name: 'paid_on' },
                    { data: 'amount', name: 'transaction_payments.amount' },
                    { data: 'tailor_name', name: 'tml.name' },
                    { data: 'method', name: 'method' },
                    { data: 'action', orderable: false, searchable: false },
                ],
                fnDrawCallback: function (oSettings) {
                    var total_amount = sum_table_col($('#tailor_master_payment_report_table'), 'paid-amount');
                    $('#footer_total_amount').text(total_amount);
                    __currency_convert_recursively($('#tailor_master_payment_report_table'));
                },
            });

            if ($('#tmpr_date_filter').length == 1) {
                $('#tmpr_date_filter').daterangepicker(dateRangeSettings, function (start, end) {
                    $('#tmpr_date_filter').val(
                        start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                    );
                    tailor_master_payment_report.ajax.reload();
                });
                $('#tmpr_date_filter').on('cancel.daterangepicker', function (ev, picker) {
                    $('#tmpr_date_filter').val('');
                    tailor_master_payment_report.ajax.reload();
                });
            }

            $(
                '#tailor_master_payment_report_form #location_id, #tailor_master_payment_report_form #tailor_id'
            ).change(function () {
                tailor_master_payment_report.ajax.reload();
            });
        });
    </script>
@endsection