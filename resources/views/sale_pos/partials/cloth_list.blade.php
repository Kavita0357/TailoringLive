@forelse($cloths as $cloth)
    <div class="col-md-3 col-xs-4 product_list no-print">
        <div class="product_box hover:tw-shadow-lg hover:tw-animate-pulse" data-cloth_id="{{ $cloth->id }}" data-is_cloth="yes"
            title="{{ $cloth->cloth_name }}@lang('lang_v1.default') - @format_currency($cloth->wages)">
            <div class="image-container"
                style="background-image: url('{{ !empty($cloth->cloth_image) ? asset('storage/' . $cloth->cloth_image) : asset('/img/default.png') }}');">
            </div>
            <div class="text_div">
                <small class="text text-muted">{{ $cloth->cloth_name }} </small>
                <small class="text text-muted">@format_currency($cloth->wages)</small>
            </div>

        </div>
    </div>
@empty
    <input type="hidden" id="no_products_found">
    <div class="col-md-12">
        <h4 class="text-center">
            @lang('lang_v1.no_cloths_to_display')
        </h4>
    </div>
@endforelse