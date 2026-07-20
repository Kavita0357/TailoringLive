<div id="cloth-pos-workspace" class="row">
    {!! Form::hidden('location_id', $default_location->id ?? null, [
        'id' => 'location_id',
        'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser',
        'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
    ]) !!}
    {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
    <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">

    @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
        <aside class="cloth-pos-sidebar">
            @include('sale_pos.partials.pos_sidebar')
        </aside>
    @endif

    <main class="cloth-pos-order-panel">
        <div class="cloth-pos-card">
            <div class="cloth-pos-toolbar row">
                <div class="col-md-4">
                    <div class="cloth-custom-input-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] ?? '' }}">
                        <input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] ?? '' }}">
                        <input type="hidden" id="default_customer_balance" value="{{ $walk_in_customer['balance'] ?? '' }}">
                        <input type="hidden" id="default_customer_address" value="{{ $walk_in_customer['shipping_address'] ?? '' }}">
                        {!! Form::select('contact_id', [], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => __('lang_v1.walk_in_customer'), 'required']) !!}
                        <button type="button" class="add_new_customer add-btn" @if (!auth()->user()->can('customer.create')) disabled @endif title="@lang('lang_v1.add_new_customer')">
                            +
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cloth-custom-input-group">
                        {!! Form::select('search_cloth', $cloths, null, ['id' => 'search_cloth', 'class' => 'form-control select2', 'placeholder' => __('tailoring.select_cloths')]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cloth-custom-input-group">
                        <span class="input-icon"><i class="fa fa-search"></i></span>
                        {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location), 'autofocus' => !is_null($default_location), 
                         'style' => 'font-size:12px; font-weight: 500',
                        ]) !!}
                        <button type="button" class="add_new_customer add-btn" data-href="{{ action([\App\Http\Controllers\ProductController::class, 'quickAdd']) }}" data-container=".quick_add_product_modal">
                            +
                     </button>
                    </div>
                </div>
            </div>

            <div class="cloth-pos-table-wrap">
                    <table class="table" id="pos_cloth_table">
                    <thead style="font-size:12px;">
        <tr>
            <th>@lang('tailoring.cloth_product')</th>
            <th class="text-center">@lang('sale.qty')</th>
            <th class="text-center">@lang('tailoring.making_charge')</th>
            <th class="text-center">@lang('sale.subtotal')</th>
            <th class="text-center">@lang('tailoring.assign_to_tailoring_master')</th>
            <th class="text-center" style="height:30px;  vertical-align:middle;"><i class="fas fa-times" style="font-size:12px"></i></th>
        </tr>
    </thead>
                        <tbody></tbody>
                    </table>
                <input type="hidden" id="cloth_row_count" value="0">

                <table class="table" id="pos_table">
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
                    <tbody></tbody>
                </table>
                <input type="hidden" id="product_row_count" value="0">
                <input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{ $business_details->sell_price_tax }}">
            </div>

            <div class="cloth-pos-summary">

                @include('sale_pos.partials.pos_form_totals')
            </div>
        </div>
    </main>
</div>
