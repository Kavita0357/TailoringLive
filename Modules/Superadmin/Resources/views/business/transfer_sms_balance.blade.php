<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'transferSMSBalance']),
            'method' => 'post',
            'id' => 'superadmin_transfer_sms_balance',
        ]) !!}

        {!! Form::hidden('business_id', $id) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('messages.transfer_sms_blalance')</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('total_api_balance', __('superadmin::lang.total_api_balance') . ':') !!}
                {!! Form::text('total_api_balance', $sms_balance['balance'], [
                    'class' => 'form-control',
                    'placeholder' => __('superadmin::lang.total_api_balance'),
                    'readOnly' => true,
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('superadmin_remaining_balance', __('superadmin::lang.superadmin_remaining_balance') . ':') !!}
                {!! Form::text(
                    'superadmin_remaining_balance',
                    isset($superadmin_remaining_balance) ? $superadmin_remaining_balance : $sms_balance['balance'],
                    [
                        'class' => 'form-control',
                        'placeholder' => __('superadmin::lang.superadmin_remaining_balance'),
                        'readOnly' => true,
                    ],
                ) !!}
            </div>
            <div class="form-group">
                {!! Form::label('transfer_balance_amount', __('superadmin::lang.transfer_balance_amount') . ':') !!}
                {!! Form::text('transfer_balance_amount', null, [
                    'class' => 'form-control',
                    'placeholder' => __('superadmin::lang.transfer_balance_amount'),
                    // 'step' => '0.01',
                    // 'min' => '0',
                ]) !!}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
