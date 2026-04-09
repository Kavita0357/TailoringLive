<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        {!! Form::open([
            'url' => action([\App\Http\Controllers\SubMeasurementController::class, 'store']),
            'method' => 'post',
            'id' => 'sub_measurement_add_form',
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">@lang('tailoring.add_sub_measurement')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('sub_measurement_name', __('tailoring.sub_measurement_name') . ':') !!}
                        {!! Form::text('sub_measurement_name', null, [
                            'class' => 'form-control w-100',
                            'placeholder' => __('tailoring.sub_measurement_name'),
                            'required' => true,
                        ]) !!}
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::number('serial_no', null, [
                            'class' => 'form-control',
                            'placeholder' => __('tailoring.serial_no'),
                            'required' => true,
                        ]) !!}
                    </div>
                </div> --}}
            </div>
            @include('layouts.partials.module_form_part')
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.save')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
