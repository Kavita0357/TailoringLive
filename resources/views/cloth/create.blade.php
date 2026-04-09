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
        {!! Form::open([
            'url' => action([\App\Http\Controllers\ClothController::class, 'store']),
            'method' => 'post',
            'id' => 'cloth_add_form',
            'files' => true,
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@lang('tailoring.add_cloth')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                {{-- Cloth Name --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloth_name', __('tailoring.cloth_name') . ':') !!}
                        {!! Form::text('cloth_name', null, [
                            'class' => 'form-control w-100',
                            'required' => true,
                            'placeholder' => __('tailoring.cloth_name'),
                        ]) !!}
                    </div>
                </div>

                {{-- Serial Number --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::number('serial_no', null, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => __('tailoring.serial_no'),
                        ]) !!}
                    </div>
                </div>

                {{-- Wages --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('wages', __('tailoring.wages') . ':') !!}
                        {!! Form::number('wages', null, [
                            'class' => 'form-control',
                            'step' => '0.01',
                            'required' => true,
                            'placeholder' => __('tailoring.wages'),
                        ]) !!}
                    </div>
                </div>

                {{-- Measurements --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <p class="text text-bold">@lang('tailoring.measurements'):</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="tw-bg-gray-200 tw-rounded-md tw-flex tw-items-center tw-justify-center"
                                    style="min-height: 200px;">
                                    <p class="tw-text-gray-600 tw-text-base tw-font-bold">@lang('tailoring.need_to_assign')</p>
                                </div>
                            </div>
                            {{-- <div class="col-md-10">
                                {!! Form::select('measurement_select', $measurements, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'measurement_select',
                                    'style' => 'width: 100%',
                                    'placeholder' => __('tailoring.select_measurements'),
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary mt-2"
                                    id="add_selected_measurement">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div> --}}
                        </div>
                        {{-- <div id="measurement_repeater_wrapper"></div> --}}
                    </div>
                </div>

                {{-- Styles with Serial No --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <p class="text text-bold">@lang('tailoring.style'):</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="tw-bg-gray-200 tw-rounded-md tw-flex tw-items-center tw-justify-center"
                                    style="min-height: 200px;">
                                    <p class="tw-text-gray-600 tw-text-base tw-font-bold">@lang('tailoring.need_to_assign')</p>
                                </div>
                            </div>
                            {{-- <div class="col-md-10">
                                {!! Form::select('style_select', $styles, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'style_select',
                                    'style' => 'width: 100%',
                                    'placeholder' => __('tailoring.select_styles'),
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_selected_style">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div> --}}
                        </div>
                        {{-- <div id="style_repeater_wrapper"></div> --}}
                    </div>
                </div>


                {{-- Cloth Image --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloth_image', __('tailoring.cloth_image') . ':') !!}
                        {!! Form::file('cloth_image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            @include('layouts.partials.module_form_part')
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">
                @lang('messages.save')
            </button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">
                @lang('messages.close')
            </button>
        </div>

        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $(document).ready(function() {
        let measurementIndex = 0;
        let styleIndex = 0;

        $('#add_selected_measurement').on('click', function() {
            const selectedOption = $('#measurement_select option:selected');
            const measurementId = selectedOption.val();
            const measurementName = selectedOption.text();

            if (!measurementId) return;

            // Check if already added
            if ($('#measurement_repeater_wrapper').find(`[data-id="${measurementId}"]`).length > 0) {
                alert('Already added!');
                return;
            }

            const newRow = `
                <div class="row mb-2 measurement_row" data-id="${measurementId}">
                    <div class="col-md-6">
                        <input type="hidden" name="measurements[${measurementIndex}][id]" value="${measurementId}">
                        <input type="text" class="form-control" value="${measurementName}" disabled>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="measurements[${measurementIndex}][serial_no]" class="form-control" placeholder="{{ __('tailoring.serial_no') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_measurement_row">&minus;</button>
                    </div>
                </div>`;

            $('#measurement_repeater_wrapper').append(newRow);
            measurementIndex++;
        });

        $(document).on('click', '.remove_measurement_row', function() {
            $(this).closest('.measurement_row').remove();
        });

        $('#add_selected_style').on('click', function() {
            const selectedOption = $('#style_select option:selected');
            const styleId = selectedOption.val();
            const styleName = selectedOption.text();

            if (!styleId) return;

            if ($('#style_repeater_wrapper').find(`[data-id="${styleId}"]`).length > 0) {
                alert('Already added!');
                return;
            }

            const newRow = `
                <div class="row mb-2 style_row" data-id="${styleId}">
                    <div class="col-md-6">
                        <input type="hidden" name="styles[${styleIndex}][id]" value="${styleId}">
                        <input type="text" class="form-control" value="${styleName}" disabled>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="styles[${styleIndex}][serial_no]" class="form-control" placeholder="{{ __('tailoring.serial_no') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_style_row">&minus;</button>
                    </div>
                </div>`;

            $('#style_repeater_wrapper').append(newRow);
            styleIndex++;
        });

        $(document).on('click', '.remove_style_row', function() {
            $(this).closest('.style_row').remove();
        });
    });
</script>
