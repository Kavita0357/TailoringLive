<div id="cloth-pos-workspace" class="row">
    {!! Form::hidden('location_id', $transaction->location_id ?? ($default_location->id ?? null), [
        'id' => 'location_id',
        'data-receipt_printer_type' => !empty($transaction->location->receipt_printer_type)
            ? $transaction->location->receipt_printer_type
            : (!empty($default_location->receipt_printer_type)
                ? $default_location->receipt_printer_type
                : 'browser'),
        'data-default_payment_accounts' => $transaction->location->default_payment_accounts ?? ($default_location->default_payment_accounts ?? ''),
    ]) !!}
    {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
    {!! Form::hidden('delivery_date', $default_datetime ?? @format_datetime($transaction->delivery_date ?? 'now'), ['id' => 'hidden_delivery_date']) !!}
    <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">

    @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
        <aside class="cloth-pos-sidebar">
            @include('sale_pos.partials.pos_sidebar')
        </aside>
    @endif

    <main class="cloth-pos-order-panel">
        <div class="cloth-pos-card">
            <div class="cloth-pos-toolbar row">
                @php
                    $col_class = !empty($pos_settings['enable_transaction_date']) ? 'col-md-3' : 'col-md-4';
                @endphp
                <div class="{{ $col_class }}">
                    <div class="cloth-custom-input-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input type="hidden" id="default_customer_id" value="{{ $transaction->contact->id ?? ($walk_in_customer['id'] ?? '') }}">
                        <input type="hidden" id="default_customer_name" value="{{ $transaction->contact->name ?? ($walk_in_customer['name'] ?? '') }}">
                        <input type="hidden" id="default_customer_balance"
                            value="{{ $transaction->contact->balance ?? ($walk_in_customer['balance'] ?? '') }}">
                        <input type="hidden" id="default_customer_address"
                            value="{{ $transaction->contact->shipping_address ?? ($walk_in_customer['shipping_address'] ?? '') }}">
                        {!! Form::select('contact_id', [], null, [
                            'class' => 'form-control mousetrap',
                            'id' => 'customer_id',
                            'placeholder' => __('lang_v1.walk_in_customer'),
                            'required',
                        ]) !!}
                        <button type="button" class="add_new_customer add-btn"
                            @if (!auth()->user()->can('customer.create')) disabled @endif title="@lang('lang_v1.add_new_customer')">
                            +
                        </button>
                    </div>
                </div>
                @if (!empty($pos_settings['enable_transaction_date']))
                    <div class="{{ $col_class }}">
                        <div class="cloth-custom-input-group">
                            <span class="input-icon"><i class="fa fa-calendar"></i></span>
                            {!! Form::text('transaction_date', $default_datetime ?? @format_datetime($transaction->transaction_date ?? now()), [
                                'class' => 'form-control',
                                'required',
                                'id' => 'transaction_date',
                                'placeholder' => __('sale.sale_date'),
                                'style' => 'font-size:12px; font-weight: 500',
                            ]) !!}
                        </div>
                    </div>
                @else
                    {!! Form::hidden('transaction_date', $default_datetime ?? @format_datetime($transaction->transaction_date ?? now()), ['id' => 'transaction_date']) !!}
                @endif
                <div class="{{ $col_class }}">
                    <div class="cloth-custom-input-group">
                        {!! Form::select('search_cloth', $cloths, null, [
                            'id' => 'search_cloth',
                            'class' => 'form-control select2',
                            'placeholder' => __('tailoring.select_cloths'),
                        ]) !!}
                    </div>
                </div>
                <div class="{{ $col_class }}">
                    <div class="cloth-custom-input-group">
                        <span class="input-icon"><i class="fa fa-search"></i></span>
                        {!! Form::text('search_product', null, [
                            'class' => 'form-control',
                            'id' => 'search_product',
                            'placeholder' => __('lang_v1.search_product_placeholder'),
                            'disabled' => !isset($transaction) && is_null($default_location),
                            'autofocus' => isset($transaction) || !is_null($default_location),
                            'style' => 'font-size:12px; font-weight: 500',
                        ]) !!}
                        <button type="button" class="add_new_customer add-btn"
                            data-href="{{ action([\App\Http\Controllers\ProductController::class, 'quickAdd']) }}"
                            data-container=".quick_add_product_modal">
                            +
                        </button>
                    </div>
                </div>
            </div>

            <div class="cloth-pos-table-wrap">
                <table class="table" id="pos_header_table" style="margin-bottom: 0;">
                    <thead style="font-size:12px;">
                        <tr>
                            <th style="width:204px">@lang('tailoring.cloth_product')</th>
                            <th class="text-center" style="width:114px">@lang('sale.qty')</th>
                            <th class="text-center" style="width:122px">@lang('tailoring.making_charge')</th>
                            <th class="text-center" style="width:139px">@lang('sale.subtotal')</th>
                            <th class="text-center" style="width:188px">@lang('tailoring.assign_to_tailoring_master')</th>
                            <th class="text-center" style="height:30px;  vertical-align:middle;"><i class="fas fa-times"
                                    style="font-size:12px"></i></th>
                        </tr>
                    </thead>
                </table>
                
                <div class="combined-table-container">
                    <table class="table" id="pos_cloth_table" style="margin-bottom: 0;">
                        <tbody>
                            @if (isset($edit) && $edit && !empty($sell_details))
                                @foreach ($sell_details as $sell_line)
                                    @if (!empty($sell_line->cloth_id))
                                        @include('sale_pos.product_row', [
                                            'product' => $sell_line,
                                            'row_count' => $loop->index,
                                            'tax_dropdown' => $taxes,
                                            'sub_units' => !empty($sell_line->unit_details)
                                                ? $sell_line->unit_details
                                                : [],
                                            'action' => 'edit',
                                            'line_type' => 'cloth',
                                        ])
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <input type="hidden" id="cloth_row_count"
                        value="{{ isset($edit) && $edit && !empty($sell_details) ? $sell_details->whereNotNull('cloth_id')->count() : 0 }}">

                    <table class="table" id="pos_table" style="margin-bottom: 0;">
                        <thead>
                            <tr>
                                <th>@lang('tailoring.cloth_product')</th>
                                <th class="text-center">@lang('sale.qty')</th>
                                <th class="text-center">@lang('tailoring.making_charge')</th>
                                <th class="text-center">@lang('sale.subtotal')</th>
                                <th class="text-center">@lang('tailoring.assign_to_tailoring_master')</th>
                                <th class="text-center"><i class="fas fa-times"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($edit) && $edit && !empty($sell_details))
                                @foreach ($sell_details as $sell_line)
                                    @if (empty($sell_line->cloth_id))
                                        @include('sale_pos.product_row', [
                                            'product' => $sell_line,
                                            'row_count' => $loop->index,
                                            'tax_dropdown' => $taxes,
                                            'sub_units' => !empty($sell_line->unit_details)
                                                ? $sell_line->unit_details
                                                : [],
                                            'action' => 'edit',
                                        ])
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <input type="hidden" id="product_row_count"
                        value="{{ isset($edit) && $edit && !empty($sell_details) ? $sell_details->whereNull('cloth_id')->count() : 0 }}">
                </div>
                
                <input type="hidden" name="sell_price_tax" id="sell_price_tax"
                    value="{{ $business_details->sell_price_tax }}">
            </div>

            <div class="cloth-pos-summary">

                @include('sale_pos.partials.pos_form_totals', ['edit' => isset($edit) && $edit])
            </div>
        </div>
    </main>
</div>
