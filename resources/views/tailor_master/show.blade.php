@extends('layouts.app')
@section('title', __('tailoring.view_tailor_master'))

@section('content')

<!-- Main content -->
<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            <h3>@lang('tailoring.view_tailor_master')</h3>
        </div>
    </div>
    <div class="hide print_table_part">
        <style type="text/css">
            .info_col {
                width: 33.33%;
                float: left;
                padding-left: 10px;
                padding-right: 10px;
            }
        </style>
        <div style="width: 100%;">
            <div class="info_col">
                <strong><i class="fa fa-user margin-r-5"></i> @lang('business.name')</strong>
                <p class="text-muted">
                    {{ $tailor->name }}
                </p>
                <strong><i class="fa fa-mobile margin-r-5"></i> @lang('contact.mobile')</strong>
                <p class="text-muted">
                    {{ $tailor->mobile }}
                </p>
            </div>
            <div class="info_col">
                <strong><i class="fa fa-calendar margin-r-5"></i> @lang('lang_v1.added_on')</strong>
                <p class="text-muted">
                    {{ @format_date($tailor->added_on) }}
                </p>
                <strong><i class="fa fa-check-circle margin-r-5"></i> @lang('business.is_active')</strong>
                <p class="text-muted">
                    @if($tailor->is_active == 'active')
                        <span class="label bg-green">@lang('business.is_active')</span>
                    @else
                        <span class="label bg-red">@lang('lang_v1.inactive')</span>
                    @endif
                </p>
            </div>
            <div class="info_col">
                <strong><i class="fa fa-money-bill-alt margin-r-5"></i> @lang('tailoring.total_wages')</strong>
                <p class="text-muted">
                    <span class="display_currency" data-currency_symbol="true">{{ $tailor->total_wages }}</span>
                </p>
                <strong><i class="fa fa-money-check-alt margin-r-5"></i> @lang('tailoring.total_wages_paid')</strong>
                <p class="text-muted">
                    <span class="display_currency" data-currency_symbol="true">{{ $tailor->total_wages_paid }}</span>
                </p>
                <strong><i class="fa fa-exclamation-triangle margin-r-5"></i>
                    @lang('tailoring.total_wages_due')</strong>
                <p class="text-muted">
                    <span class="display_currency" data-currency_symbol="true">{{ $tailor->total_wages_due }}</span>
                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#ledger_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-scroll"
                                aria-hidden="true"></i> @lang('lang_v1.ledger')</a>
                    </li>
                    <li>
                        <a href="#work_list_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-shopping-cart"
                                aria-hidden="true"></i> Work list</a>
                    </li>
                    <li>
                        <a href="#payments_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-money-bill-alt"
                                aria-hidden="true"></i> @lang('sale.payments')</a>
                    </li>
                    <!-- <li>
                        <a href="#activities_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-pen-square"
                                aria-hidden="true"></i> @lang('lang_v1.activities')</a>
                    </li> -->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="ledger_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ledger_date_range">@lang('report.date_range'):</label>
                                        <input placeholder="@lang('lang_v1.select_a_date_range')" class="form-control" readonly="readonly" name="ledger_date_range" type="text" id="ledger_date_range">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('lang_v1.ledger_format')</label>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default active">
                                                <input type="radio" name="ledger_format" value="format_1" checked> @lang('lang_v1.format_1')
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_format" value="format_2"> @lang('lang_v1.format_2')
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="ledger_format" value="format_3"> @lang('lang_v1.format_3')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ledger_location">@lang('purchase.business_location'):</label>
                                        <select class="form-control select2" id="ledger_location" name="ledger_location">
                                            <option value="">@lang('tailoring.all_locations')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <button class="btn btn-default btn-xs" id="print_ledger_pdf"><i class="fas fa-file-pdf"></i></button>
                                    <button type="button" class="btn btn-default btn-xs" id="send_ledger"><i class="fas fa-envelope"></i></button>
                                </div>
                            </div>
                            
                            <div class="col-md-12 text-right">
                                <p class="text-muted" style="margin-bottom: 0;"><strong>{{ session('business.name') }}</strong></p>
                                <p class="text-muted" style="margin-bottom: 0;">
                                    @if(!empty(session('business.locations')->first()))
                                        {{ session('business.locations')->first()->city }},
                                        {{ session('business.locations')->first()->state }},
                                        {{ session('business.locations')->first()->country }}
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0;">
                                    <div style="background-color: #2b7095; color: white; padding: 5px;">
                                        <strong>@lang('lang_v1.to'):</strong>
                                    </div>
                                    <p><strong>{{ $tailor->name }}</strong>
                                        <br>{{ $tailor->name }}
                                        <br>@lang('contact.mobile'): {{ $tailor->mobile }}
                                    </p>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6 text-right align-right" style="padding-right: 0;">
                                    <div style="background-color: #2b7095; color: white; padding: 5px;">
                                        <h4 class="mb-0 text-white" style="margin: 0; text-align: right;">Account Summary</h4>
                                    </div>
                                    <div style="border: 1px solid #000; padding: 10px;">
                                        <i id="show_info_btn" class="fa fa-info-circle text-info" style="margin-right: 10px; margin-top:4px;"></i>
                                        <b>{{ \Carbon\Carbon::now()->startOfYear()->format(config('constants.default_date_format', 'm/d/Y')) }} @lang('lang_v1.to') {{ \Carbon\Carbon::now()->endOfYear()->format(config('constants.default_date_format', 'm/d/Y')) }}</b>
                                        <table class="table table-condensed text-left align-left no-border" style="margin-bottom: 0;">
                                            <tr>
                                                <td>@lang('tailoring.total_wages')</td>
                                                <td class="align-right">
                                                    <span class="display_currency"
                                                        data-currency_symbol="true">{{ $tailor->total_wages }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('sale.total_paid')</td>
                                                <td class="align-right">
                                                    <span class="display_currency"
                                                        data-currency_symbol="true">{{ $tailor->total_wages_paid }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="border: 1px solid #000; border-top: none; padding: 10px;">
                                        <b> @lang('lang_v1.overall_summary') </b>
                                        <table class="table table-condensed text-left align-left no-border" style="margin-bottom: 0;">
                                            <tr>
                                                <td>@lang('tailoring.total_wages')</td>
                                                <td class="align-right">
                                                    <span class="display_currency"
                                                        data-currency_symbol="true">{{ $tailor->total_wages }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('sale.total_paid')</td>
                                                <td class="align-right">
                                                    <span class="display_currency"
                                                        data-currency_symbol="true">{{ $tailor->total_wages_paid }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>@lang('lang_v1.balance_due')</strong></td>
                                                <td class="align-right">
                                                    <strong><span class="display_currency"
                                                            data-currency_symbol="true">{{ $tailor->total_wages_due }}</span></strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center" style="margin-top: 20px;">
                                <strong>Showing all invoices and payments between {{ \Carbon\Carbon::now()->startOfYear()->format(config('constants.default_date_format', 'm/d/Y')) }} and {{ \Carbon\Carbon::now()->endOfYear()->format(config('constants.default_date_format', 'm/d/Y')) }}</strong>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered table-striped" style="margin-top: 10px;">
                                    <thead style="background-color: #2b7095; color: white;">
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference No</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Payment Status</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Payment Method</th>
                                            <th>Others</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: white; color: black;">
                                        <tr>
                                            <td colspan="9" class="text-center">No data available in table</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="work_list_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped" id="tailor_work_list_table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>@lang('tailoring.date')</th>
                                            <th>@lang('tailoring.order_no')</th>
                                            <th>@lang('tailoring.particulars')</th>
                                            <th>@lang('tailoring.wages')</th>
                                            <th>@lang('tailoring.payment_status')</th>
                                            <th>@lang('tailoring.total_paid')</th>
                                            <th>@lang('tailoring.total_due')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="payments_tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tailor_payments_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@lang('lang_v1.paid_on')</th>
                                        <th>@lang('purchase.ref_no')</th>
                                        <th>@lang('sale.amount')</th>
                                        <th>@lang('lang_v1.payment_method')</th>
                                        <th>@lang('account.payment_for')</th>
                                        <th>@lang('messages.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="activities_tab">
                        <!-- Activities content will go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop
@section('javascript')
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var tailor_work_list_table = $('#tailor_work_list_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                paging: true,
                info: true,
                pageLength: 25,
                lengthChange: true,
                ajax: {
                    url: '/tailor-master/list',
                    data: function (d) {
                        d.is_dashboard = 'true';
                        d.tailoring_master_id = "{{ $tailor->user_id }}";
                    }
                },
                order: [
                    [0, 'desc']
                ],
                columns: [
                    {
                        data: 'added_on',
                        name: 'transaction_date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
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
            var tailor_payments_table = $('#tailor_payments_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('tailor_master.payments', [$tailor->id]) }}",
                    data: function (d) {
                        d.is_dashboard = 'true';
                    }
                },
                columns: [
                    { data: 'paid_on', name: 'transaction_payments.paid_on' },
                    { data: 'payment_ref_no', name: 'transaction_payments.payment_ref_no' },
                    { data: 'amount', name: 'transaction_payments.amount', searchable: false },
                    { data: 'method', name: 'transaction_payments.method' },
                    { data: 'payment_for', name: 'payment_for', searchable: false, orderable: false },
                    { data: 'action', name: 'action', searchable: false, orderable: false }
                ]
            });
        });
    </script>
@endsection