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
                        @if ($tailor->is_active == 'active')
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
                                        {!! Form::select('ledger_location', $business_locations, null, ['class' => 'form-control select2', 'id' => 'ledger_location', 'placeholder' => __('tailoring.all_locations')]) !!}
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <button class="btn btn-default btn-xs" id="print_ledger_pdf"><i class="fas fa-file-pdf"></i></button>
                                    <button type="button" class="btn btn-default btn-xs" id="send_ledger"><i class="fas fa-envelope"></i></button>
                                </div>
                            </div>
                            <div id="tailor_ledger_div"></div>
                        </div>
                    </div>

                        <div class="tab-pane" id="work_list_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped" id="tailor_work_list_table"
                                        style="width: 100%;">
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
                                <table class="table table-bordered table-striped" id="tailor_payments_table"
                                    style="width: 100%;">
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

            $('#ledger_date_range').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#ledger_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                }
            );
            $('#ledger_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#ledger_date_range').val('');
                get_tailor_ledger();
            });
            $('#ledger_date_range, #ledger_location, input[name="ledger_format"]').change(function() {
                get_tailor_ledger();
            });
            get_tailor_ledger();

            function get_tailor_ledger() {
                var start_date = '';
                var end_date = '';
                var location_id = $('#ledger_location').val();
                if ($('#ledger_date_range').val()) {
                    start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
                var format = $('input[name="ledger_format"]:checked').val();
                
                $.ajax({
                    url: '/tailor-master/ledger?tailor_id={{ $tailor->id }}',
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        location_id: location_id,
                        format: format
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('#tailor_ledger_div').html(result);
                        __currency_convert_recursively($('#tailor_ledger_div'));
                        $('#ledger_table').DataTable({
                            searching: false,
                            ordering: false,
                            paging: false,
                            fixedHeader: false,
                            dom: 't'
                        });
                    },
                });
            }

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
                    data: function(d) {
                        d.is_dashboard = 'true';
                        d.tailoring_master_id = "{{ $tailor->user_id }}";
                    }
                },
                order: [
                    [0, 'desc']
                ],
                columns: [{
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
                    data: function(d) {
                        d.is_dashboard = 'true';
                    }
                },
                columns: [{
                        data: 'paid_on',
                        name: 'transaction_payments.paid_on'
                    },
                    {
                        data: 'payment_ref_no',
                        name: 'transaction_payments.payment_ref_no'
                    },
                    {
                        data: 'amount',
                        name: 'transaction_payments.amount',
                        searchable: false
                    },
                    {
                        data: 'method',
                        name: 'transaction_payments.method'
                    },
                    {
                        data: 'payment_for',
                        name: 'payment_for',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endsection
