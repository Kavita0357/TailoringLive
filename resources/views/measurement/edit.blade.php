<style type="text/css">
    .mb-1 {
        margin-bottom: 5px;
    }

    .mb-2 {
        margin-bottom: 15px;
    }
</style>
<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        {!! Form::model($measurement, [
            'url' => action([\App\Http\Controllers\MeasurementController::class, 'update'], [$measurement->id]),
            'method' => 'PUT',
            'id' => 'measurement_edit_form',
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">@lang('tailoring.edit_measurement')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloths', __('tailoring.select_cloths') . ':') !!}
                        {!! Form::select('cloths[]', $cloths, optional($measurement->cloths)->pluck('id')->toArray(), [
                            'class' => 'form-control select select2',
                            'multiple' => true,
                            // 'required' => true,
                            'style' => 'width: 100%',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::number('serial_no', $measurement->serial_no, [
                            'class' => 'form-control',
                            'placeholder' => __('tailoring.serial_no'),
                            'required' => false,
                        ]) !!}
                        <div class="input-group">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('measurement_name', __('tailoring.measurement_name') . ':') !!}
                        {!! Form::text('measurement_name', $measurement->measurement_name, [
                            'class' => 'form-control w-100',
                            'required' => true,
                            'placeholder' => __('tailoring.measurement_name'),
                        ]) !!}
                        <div class="input-group">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <p class="text text-bold">
                                    @lang('tailoring.sub_measurements'):
                                </p>
                            </div>
                        </div>

                        <div id="sub_measurement_repeater_wrapper">
                            @foreach ($measurement->subMeasurements as $index => $sub)
                                <div class="row mb-2 sub_measurement_row" data-id="{{ $sub->id }}">

                                    <input type="hidden" name="sub_measurements[{{ $index }}][id]"
                                        value="{{ $sub->id }}">

                                    <div class="col-md-5">
                                        <input type="text" name="sub_measurements[{{ $index }}][name]"
                                            class="form-control" value="{{ $sub->sub_measurement_name }}"
                                            placeholder="Sub-measurement name" required>
                                    </div>

                                    <div class="col-md-5">
                                        <input type="number" name="sub_measurements[{{ $index }}][serial_no]"
                                            class="form-control" value="{{ $sub->pivot->serial_no }}"
                                            placeholder="@lang('tailoring.serial_no')" min="1" required>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove_sub_measurement_row">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-sm btn-primary" id="add_sub_measurement_row">
                            <i class="fa fa-plus"></i>
                            @lang('tailoring.add_sub_measurement')
                        </button>
                    </div>
                </div>

            </div>
            @include('layouts.partials.module_form_part')
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $(document).ready(function() {
        let subMeasurementIndex = {{ $measurement->subMeasurements->count() }};

        const $wrapper = $('#sub_measurement_repeater_wrapper');

        // Add a new sub-measurement without selecting a pre-existing record.
        $('#add_sub_measurement_row').on('click', function() {
            const newRow = `
            <div class="row mb-2 sub_measurement_row" data-id="">
                <input type="hidden"
                       name="sub_measurements[${subMeasurementIndex}][id]"
                       value="">

                <div class="col-md-5">
                    <input type="text"
                           name="sub_measurements[${subMeasurementIndex}][name]"
                           class="form-control"
                           placeholder="Sub-measurement name"
                           required>
                </div>

                <div class="col-md-5">
                    <input type="number"
                           name="sub_measurements[${subMeasurementIndex}][serial_no]"
                           class="form-control"
                           placeholder="@lang('tailoring.serial_no')"
                           min="1"
                           required>
                </div>

                <div class="col-md-2">
                    <button type="button"
                            class="btn btn-danger remove_sub_measurement_row">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        `;

            $wrapper.append(newRow);
            subMeasurementIndex++;
        });

        // Remove existing or newly added rows from the submitted form.
        $wrapper.on('click', '.remove_sub_measurement_row', function() {
            $(this).closest('.sub_measurement_row').remove();
        });
    });
</script>
