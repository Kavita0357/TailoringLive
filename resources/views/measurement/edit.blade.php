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
                                <p class="text text-bold">@lang('tailoring.sub_measurements'):</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-10">
                                {!! Form::select('sub_measurement_select', $sub_measurements, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'sub_measurement_select',
                                    'style' => 'width: 100%',
                                    'placeholder' => __('tailoring.select_sub_measurements'),
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary mt-2"
                                    id="add_selected_sub_measurement">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="sub_measurement_repeater_wrapper">
                            @foreach ($measurement->subMeasurements as $index => $sub)
                                <div class="row mb-2 sub_measurement_row" data-id="{{ $sub->id }}">
                                    <div class="col-md-6">
                                        <input type="hidden" name="sub_measurements[{{ $index }}][id]"
                                            value="{{ $sub->id }}">
                                        <input type="text" class="form-control"
                                            value="{{ $sub->sub_measurement_name }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="sub_measurements[{{ $index }}][serial_no]"
                                            class="form-control" value="{{ $sub->pivot->serial_no }}"
                                            placeholder="{{ __('tailoring.serial_no') }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button"
                                            class="btn btn-danger remove_sub_measurement_row">&minus;</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('sub_measurements', __('tailoring.select_sub_measurements') . ':') !!}
                        {!! Form::select('sub_measurements[]', $sub_measurements, $selected_sub_measurements, [
                            'class' => 'form-control select2',
                            'multiple' => true,
                            'style' => 'width: 100%',
                        ]) !!}
                    </div>
                </div> --}}
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

        $(document).find('.select2').select2({allowClear: true,
            placeholder: "Select cloths",
            allowClear: true,
        });

        $('#add_selected_sub_measurement').on('click', function() {
            const selectedOption = $('#sub_measurement_select option:selected');
            const subMeasurementId = selectedOption.val();
            const subMeasurementName = selectedOption.text();

            if (!subMeasurementId) return;

            // Check if already added
            if ($('#sub_measurement_repeater_wrapper').find(`[data-id="${subMeasurementId}"]`).length >
                0) {
                alert('Already added!');
                return;
            }

            const newRow = `
                <div class="row mb-2 sub_measurement_row" data-id="${subMeasurementId}">
                    <div class="col-md-6">
                        <input type="hidden" name="sub_measurements[${subMeasurementIndex}][id]" value="${subMeasurementId}">
                        <input type="text" class="form-control" value="${subMeasurementName}" disabled>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="sub_measurements[${subMeasurementIndex}][serial_no]" class="form-control" placeholder="{{ __('tailoring.serial_no') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_sub_measurement_row">&minus;</button>
                    </div>
                </div>`;

            $('#sub_measurement_repeater_wrapper').append(newRow);
            subMeasurementIndex++;
        });

        $(document).on('click', '.remove_sub_measurement_row', function() {
            $(this).closest('.sub_measurement_row').remove();
        });
    });
</script>
