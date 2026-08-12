@php
    $start_date_display = !empty($start_date) ? \Carbon\Carbon::parse($start_date)->format(config('constants.default_date_format', 'm/d/Y')) : \Carbon\Carbon::now()->startOfYear()->format(config('constants.default_date_format', 'm/d/Y'));
    $end_date_display = !empty($end_date) ? \Carbon\Carbon::parse($end_date)->format(config('constants.default_date_format', 'm/d/Y')) : \Carbon\Carbon::now()->endOfYear()->format(config('constants.default_date_format', 'm/d/Y'));
@endphp
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
            <b>{{ $start_date_display }} @lang('lang_v1.to') {{ $end_date_display }}</b>
            <table class="table table-condensed text-left align-left no-border" style="margin-bottom: 0;">
                <tr>
                    <td>@lang('tailoring.total_wages')</td>
                    <td class="align-right">
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $total_wages }}</span>
                    </td>
                </tr>
                <tr>
                    <td>@lang('sale.total_paid')</td>
                    <td class="align-right">
                        <span class="display_currency"
                            data-currency_symbol="true">{{ $total_wages_paid }}</span>
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
    <strong>Showing all invoices and payments between {{ $start_date_display }} and {{ $end_date_display }}</strong>
</div>

<div class="col-md-12">
    <table class="table table-bordered table-striped" id="ledger_table" style="margin-top: 10px;">
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
            @forelse($ledger_transactions as $transaction)
            <tr>
                <td>{{ \Carbon\Carbon::parse($transaction['date'])->format(session('business.date_format', 'm/d/Y') . ' H:i') }}</td>
                <td>{{ $transaction['ref_no'] }}</td>
                <td>{{ $transaction['type'] }}</td>
                <td>{{ $transaction['location'] }}</td>
                <td>
                    @if(!empty($transaction['payment_status']))
                        <span class="label @payment_status($transaction['payment_status'])">{{ __('lang_v1.' . $transaction['payment_status']) }}</span>
                    @endif
                </td>
                <td>
                    @if($transaction['debit'] != 0)
                        <span class="display_currency" data-currency_symbol="true">{{ $transaction['debit'] }}</span>
                    @endif
                </td>
                <td>
                    @if($transaction['credit'] != 0)
                        <span class="display_currency" data-currency_symbol="true">{{ $transaction['credit'] }}</span>
                    @endif
                </td>
                <td>{{ $transaction['payment_method'] }}</td>
                <td>{{ $transaction['others'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No data available in table</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
