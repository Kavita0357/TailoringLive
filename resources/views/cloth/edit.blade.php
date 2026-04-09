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
        {!! Form::model($cloth, [
            'url' => action([\App\Http\Controllers\ClothController::class, 'update'], [$cloth->id]),
            'method' => 'PUT',
            'id' => 'cloth_edit_form',
            'files' => true,
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@lang('tailoring.edit_cloth')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                {{-- Cloth Name --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloth_name', __('tailoring.cloth_name') . ':') !!}
                        {!! Form::text('cloth_name', $cloth->cloth_name, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => __('tailoring.cloth_name'),
                        ]) !!}
                    </div>
                </div>

                {{-- Serial No --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::text('serial_no', $cloth->serial_no, [
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
                        {!! Form::number('wages', $cloth->wages, [
                            'class' => 'form-control',
                            'step' => '0.01',
                            'placeholder' => __('tailoring.wages'),
                        ]) !!}
                    </div>
                </div>

                {{-- Measurement Repeater --}}
                @if ($selected_measurements->isNotEmpty())
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('tailoring.measurements') }}:</label>
                            {{-- <div class="row mb-2">
                            <div class="col-md-10">
                                {!! Form::select('measurement_select', $measurements, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'measurement_select',
                                    'placeholder' => __('tailoring.select_measurements'),
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary mt-2"
                                    id="add_selected_measurement">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> --}}
                            <div id="measurement_repeater_wrapper">
                                @foreach ($selected_measurements as $index => $m)
                                    <div class="row mb-2 measurement_row" data-id="{{ $m->id }}">
                                        <div class="col-md-6">
                                            <input type="hidden" name="measurements[{{ $index }}][id]"
                                                value="{{ $m->id }}">
                                            <input type="text" class="form-control"
                                                value="{{ $m->measurement_name }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="measurements[{{ $index }}][serial_no]"
                                                class="form-control" value="{{ $m->serial_no }}"
                                                placeholder="{{ __('tailoring.serial_no') }}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="btn btn-danger remove_measurement_row">&minus;</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
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
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Style Repeater --}}
                @if ($selected_styles->isNotEmpty())
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('tailoring.style') }}:</label>
                            {{-- <div class="row mb-2">
                            <div class="col-md-10">
                                {!! Form::select('style_select', $styles, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'style_select',
                                    'placeholder' => __('tailoring.select_styles'),
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="add_selected_style">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div> --}}
                            <div id="style_repeater_wrapper">
                                @foreach ($selected_styles as $index => $style)
                                    <div class="row mb-2 style_row" data-id="{{ $style->id }}">
                                        <div class="col-md-6">
                                            <input type="hidden" name="styles[{{ $index }}][id]"
                                                value="{{ $style->id }}">
                                            <input type="text" class="form-control" value="{{ $style->style_name }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="styles[{{ $index }}][serial_no]"
                                                class="form-control" value="{{ $style->serial_no }}"
                                                placeholder="{{ __('tailoring.serial_no') }}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="btn btn-danger remove_style_row">&minus;</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
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
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Cloth Image --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloth_image', __('tailoring.cloth_image') . ':') !!}
                        {!! Form::file('cloth_image', ['class' => 'form-control']) !!}
                        @if (!empty($cloth->cloth_image))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $cloth->cloth_image) }}" width="100"
                                    alt="Cloth Image" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @include('layouts.partials.module_form_part')
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">
                @lang('messages.close')
            </button>
        </div>

        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $(document).ready(function() {
        let measurementIndex = {{ $cloth->measurements->count() }};
        let styleIndex = {{ $cloth->styles->count() }};

        $('#add_selected_measurement').on('click', function() {
            const selected = $('#measurement_select option:selected');
            const id = selected.val();
            const name = selected.text();

            if (!id || $('#measurement_repeater_wrapper').find(`[data-id="${id}"]`).length) return;

            $('#measurement_repeater_wrapper').append(`
                <div class="row mb-2 measurement_row" data-id="${id}">
                    <div class="col-md-6">
                        <input type="hidden" name="measurements[${measurementIndex}][id]" value="${id}">
                        <input type="text" class="form-control" value="${name}" disabled>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="measurements[${measurementIndex}][serial_no]" class="form-control" placeholder="Serial No" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_measurement_row">&minus;</button>
                    </div>
                </div>
            `);

            measurementIndex++;
        });

        $('#add_selected_style').on('click', function() {
            const selected = $('#style_select option:selected');
            const id = selected.val();
            const name = selected.text();

            if (!id || $('#style_repeater_wrapper').find(`[data-id="${id}"]`).length) return;

            $('#style_repeater_wrapper').append(`
                <div class="row mb-2 style_row" data-id="${id}">
                    <div class="col-md-6">
                        <input type="hidden" name="styles[${styleIndex}][id]" value="${id}">
                        <input type="text" class="form-control" value="${name}" disabled>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="styles[${styleIndex}][serial_no]" class="form-control" placeholder="Serial No" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_style_row">&minus;</button>
                    </div>
                </div>
            `);

            styleIndex++;
        });

        $(document).on('click', '.remove_measurement_row', function() {
            $(this).closest('.measurement_row').remove();
        });

        $(document).on('click', '.remove_style_row', function() {
            $(this).closest('.style_row').remove();
        });
    });
</script>
