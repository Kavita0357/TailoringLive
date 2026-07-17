<div class="row mb-12">
    <div class="col-md-12 tw-pt-0 tw-mb-14">
        <div class="row tw-flex lg:tw-flex-row md:tw-flex-col sm:tw-flex-col tw-flex-col tw-items-start md:tw-gap-4">
            <div class="tw-px-3 tw-w-full lg:tw-px-0 lg:tw-pr-0 @if (empty($pos_settings['hide_product_suggestion'])) lg:tw-w-[60%] @else lg:tw-w-[100%] @endif">
                <div class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-mb-2 md:tw-mb-8 tw-p-2">
                    <div class="box-body pb-0">
                        {!! Form::hidden('location_id', $default_location->id ?? null, [
                            'id' => 'location_id',
                            'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser',
                            'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
                        ]) !!}
                        {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                        <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">
                        @include('sale_pos.partials.pos_form')
                        @include('sale_pos.partials.pos_form_totals')
                    </div>
                </div>
            </div>
            @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                <div class="md:tw-no-padding tw-w-full lg:tw-w-[40%] tw-px-5">
                    @include('sale_pos.partials.pos_sidebar')
                </div>
            @endif
        </div>
    </div>
</div>
