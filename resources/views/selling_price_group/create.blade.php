<style type="text/css">
    .checkbox label {
        padding-left: 0;
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action([\App\Http\Controllers\SellingPriceGroupController::class, 'store']),
            'method' => 'post',
            'id' => 'selling_price_group_form',
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('lang_v1.add_selling_price_group')</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __('lang_v1.name') . ':*') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.name')]) !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('auto_price_group', 1, false, ['class' => 'input-icheck', 'id' => 'auto_price_group']) !!} {{ __('tailoring.auto_price_group') }}
                    </label>
                </div>
            </div>

            <div class="form-group auto-price hide">
                {!! Form::label('selling_col', __('tailoring.select_selling_col') . ':*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select(
                        'selling_col',
                        [
                            'default_selling_price' => __('tailoring.default_selling_price'),
                            'default_purchase_price' => __('tailoring.default_purchase_price'),
                        ],
                        null,
                        [
                            'class' => 'form-control',
                            'placeholder' => __('messages.please_select'),
                            'data-default' => 'default_purchase_price',
                        ],
                    ) !!}
                </div>
            </div>

            <div class="form-group auto-price hide">
                {!! Form::label('selling_col_type', __('tailoring.select_selling_col_type') . ':*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select(
                        'selling_col_type',
                        [
                            'add' => __('tailoring.add'),
                            'deduct' => __('tailoring.deduct'),
                        ],
                        null,
                        [
                            'class' => 'form-control',
                            'placeholder' => __('messages.please_select'),
                            'data-default' => 'add',
                        ],
                    ) !!}
                </div>
            </div>

            <div class="form-group auto-price hide">
                {!! Form::label('discount_type', __('sale.discount_type') . ':*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::select(
                        'discount_type',
                        ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')],
                        null,
                        [
                            'class' => 'form-control',
                            'placeholder' => __('messages.please_select'),
                            'data-default' => 'percentage',
                        ],
                    ) !!}
                </div>
            </div>
            @php
                $sales_discount = 0;
                $max_discount = 100;
            @endphp
            <div class="form-group auto-price hide">
                {!! Form::label('discount_amount', __('sale.discount_amount') . ':*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::text('discount_amount', @num_format($sales_discount), [
                        'class' => 'form-control input_number',
                        'data-default' => $sales_discount,
                        'data-max-discount' => $max_discount,
                        'data-max-discount-error_msg' => __('lang_v1.max_discount_error_msg', [
                            'discount' => $max_discount != '' ? @num_format($max_discount) : '',
                        ]),
                    ]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', __('lang_v1.description') . ':') !!}
                {!! Form::textarea('description', null, [
                    'class' => 'form-control',
                    'placeholder' => __('lang_v1.description'),
                    'rows' => 3,
                ]) !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.save')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).find('input[type="checkbox"].input-icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
        });
        $('#auto_price_group').on('ifChecked', function() {
            $('.auto-price').removeClass('hide');
            $('.auto-price input, .auto-price select').prop('required', true);
        }).on('ifUnchecked', function() {
            $('.auto-price').addClass('hide');
            $('.auto-price input, .auto-price select').prop('required', false);
        });

    });
</script>
