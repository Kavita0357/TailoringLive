<style type="text/css">
    .mb-1 {
        margin-bottom: 5px;
    }

    .mb-2 {
        margin-bottom: 15px;
    }

    .input-col {
        padding: 20px;
        margin: 10px 0;
    }

    .tw-bg-gray-200 {
        background-color: #f7f7f7;
    }

    .tw-bg-primary-400 {
        background-color: #3b78f0ff;
    }

    .style-card {
        border: 1px solid #3b78f0ff;
        margin: 10px 0
    }

    .style-card-title {
        padding: 10px;
    }

    .style-card-body {
        padding: 10px;
    }

    .design-img img {
        max-width: 80px;
        margin-bottom: 15px;
    }

    .style-card-body .form-group {
        border: 1px solid #b5b2b2;
        padding: 10px 10px;
        border-radius: 5px;
        text-align: center;
    }

    .customer-measuremnt-content {
        padding: 20px;
    }
</style>
<div class="@if ($view_only == true) customer-measuremnt-wrapper @else modal-dialog modal-dialog-centered modal-lg @endif"
    role="document">
    <div class="@if ($view_only) customer-measuremnt-content @else modal-content @endif">
        {!! Form::model($cloth, [
            'url' => route('cloth-customizations.storeOrUpdate'),
            'method' => 'POST',
            'id' => 'add_style_measurement_form',
        ]) !!}

        <input type="hidden" name="cloth_id" value="{{ $cloth->id }}">
        <input type="hidden" name="contact_id" value="{{ $contact_id }}">

        <div class="@if ($view_only) customer-measuremnt-header @else modal-header @endif">
            @if (!$view_only)
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endif
            <h4 class="modal-title">{{ $cloth->cloth_name }}</h4>
        </div>

        <div class="@if ($view_only) customer-measuremnt-body @else modal-body @endif">
            <div class="contianer">
                {{-- <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::select('current_cloth', $all_cloths, $cloth->id, [
                                'class' => 'form-control',
                                'id' => 'current_cloth',
                            ]) !!}
                        </div>
                    </div>
                </div> --}}
                <div class="row tw-flex items-tw-items-strech tw-flex-wrap">
                    {{-- Measurement Repeater --}}
                    @if ($cloth->measurements->isNotEmpty())
                        @foreach ($cloth->measurements as $index => $m)
                            <div class="@if ($view_only) col-md-3 @else col-md-4 @endif">
                                <div class="tw-bg-gray-200 tw-rounded-md input-col">
                                    <div class="form-group">
                                        <label
                                            for="measurements[{{ $index }}][value]">{{ $m->measurement_name }}</label>
                                        <input type="hidden" name="measurements[{{ $index }}][id]"
                                            value="{{ $m->id }}">
                                        <input type="hidden" name="measurements[{{ $index }}][measurement_name]"
                                            value="{{ $m->measurement_name }}">
                                        <input type="text" class="form-control"
                                            @if ($view_only) readonly @endif
                                            name="measurements[{{ $index }}][value]"
                                            id="measurements[{{ $index }}][value]"
                                            value="{{ $cloth_customization['measurements'][$index]['value'] ?? '' }}">
                                    </div>
                                    @if ($m->subMeasurements->isNotEmpty())
                                        @foreach ($m->subMeasurements as $sub_index => $sub)
                                            <div class="form-group">
                                                <label
                                                    for="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][value]">{{ $sub->sub_measurement_name }}</label>
                                                <input type="hidden"
                                                    name="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][id]"
                                                    value="{{ $sub->id }}">
                                                <input type="hidden"
                                                    name="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][sub_measurement_name]"
                                                    value="{{ $sub->sub_measurement_name }}">
                                                <input type="text" class="form-control"
                                                    @if ($view_only) readonly @endif
                                                    name="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][value]"
                                                    id="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][value]"
                                                    value="{{ $cloth_customization['measurements'][$index]['sub_measurements'][$sub_index]['value'] ?? '' }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="cloth_customization_note"
                                value="{{ $cloth_customization->note ?? '' }}" placeholder="@lang('tailoring.note')" />
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
                </div>
                <div class="row tw-flex items-tw-items-strech tw-flex-wrap">
                    @if ($cloth->styles->isNotEmpty())
                        <div class="col-md-12">
                            @foreach ($cloth->styles as $index => $s)
                                <div class="style-card tw-rounded-md">
                                    <div class="tw-bg-primary-400 style-card-title">
                                        <p class="tw-text-white tw-text-base tw-font-bold">{{ $s->style_name }}</p>
                                        <input type="hidden" name="styles[{{ $index }}][id]"
                                            value="{{ $s->id }}">
                                        <input type="hidden" name="styles[{{ $index }}][name]"
                                            value="{{ $s->style_name }}">
                                    </div>
                                    <div class="style-card-body tw-flex items-tw-items-strech tw-flex-wrap">
                                        @if ($s->designs->isNotEmpty())
                                            @php
                                                $designCount = $s->designs->count();
                                            @endphp
                                            @foreach ($s->designs as $sub_index => $sub)
                                                <div
                                                    class="@if ($view_only) col-md-3 @else col-md-4 @endif">
                                                    <div class="form-group">
                                                        <div
                                                            class="design-img tw-flex tw-items-center tw-justify-center">
                                                            <img
                                                                src="{{ $sub->design_image ? asset('storage/' . $sub->design_image) : asset('/img/default.png') }}" />
                                                        </div>
                                                        <div class="input-wrap">
                                                            <input type="checkbox" class="row-select"
                                                                @if ($view_only) disabled @endif
                                                                name="styles[{{ $index }}][designs][{{ $sub_index }}][id]"
                                                                id="styles[{{ $index }}][designs][{{ $sub_index }}][value]"
                                                                value="{{ $sub->id }}"
                                                                @if (isset($cloth_customization['styles'][$index]['designs'][$sub_index]['id']) &&
                                                                        $cloth_customization['styles'][$index]['designs'][$sub_index]['id'] == $sub->id) checked @endif>
                                                            <label
                                                                for="styles[{{ $index }}][designs][{{ $sub_index }}][value]">{{ $sub->design_name }}</label>
                                                            <input class="form-control design-value" type="text"
                                                                @if ($view_only) readonly @endif
                                                                id="styles[{{ $index }}][designs][{{ $sub_index }}][design_value]"
                                                                name="styles[{{ $index }}][designs][{{ $sub_index }}][design_value]"
                                                                value="{{ $cloth_customization['styles'][$index]['designs'][$sub_index]['design_value'] ?? '' }}">

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
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
                </div>
            </div>

            @include('layouts.partials.module_form_part')
        </div>

        @if (!$view_only)
            <div class="modal-footer">
                <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
                <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">
                    @lang('messages.close')
                </button>
            </div>
        @endif

        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    $(document).ready(function() {
        $(document).on('click', '.style-card-body .row-select', function() {
            const $row = $(this).closest('.style-card-body');
            if ($(this).is(':checked')) {
                // $row.find('.design-value').removeAttr('required');
                // $(this).closest('.input-wrap').find('.design-value').attr('required', 'required');
                $row.find('.row-select').not(this).prop('checked', false);
            }
        });

        $(document)
            .off('submit', 'form#add_style_measurement_form')
            .on('submit', 'form#add_style_measurement_form', function(e) {
                e.preventDefault();
                let form = $(this);
                let obj = {};
                let formData = new FormData(this);
                for (let [fullKey, value] of formData.entries()) {
                    const keys = fullKey.replace(/\]/g, '').split(
                        '['); // Convert a[b][c] -> ['a', 'b', 'c']
                    let current = obj;

                    keys.forEach((key, index) => {
                        const isLast = index === keys.length - 1;

                        // If key is a number string, make it an integer
                        const cleanKey = /^\d+$/.test(key) ? parseInt(key) : key;

                        if (isLast) {
                            if (Array.isArray(current)) {
                                current[cleanKey] = value;
                            } else {
                                // If already exists, convert to array
                                if (current[cleanKey] !== undefined) {
                                    if (!Array.isArray(current[cleanKey])) {
                                        current[cleanKey] = [current[cleanKey]];
                                    }
                                    current[cleanKey].push(value);
                                } else {
                                    current[cleanKey] = value;
                                }
                            }
                        } else {
                            if (current[cleanKey] === undefined) {
                                current[cleanKey] = /^\d+$/.test(keys[index + 1]) ? [] : {};
                            }
                            current = current[cleanKey];
                        }
                    });
                }
                $.ajax({
                    method: 'POST',
                    url: form.attr('action'),
                    data: JSON.stringify(obj),
                    contentType: 'application/json',
                    dataType: 'json',
                    beforeSend: function() {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            $('div.style_measurement_modal').modal('hide');
                            form.find('button[type="submit"]').removeAttr('disabled');
                        } else {
                            toastr.error(result.msg);
                            form.find('button[type="submit"]').removeAttr('disabled');
                        }
                    },
                });
            });

        $(document).on('change', '#current_cloth', function() {
            const cloth_id = $(this).val();
            const contact_id = $('form#add_style_measurement_form input[name="contact_id"]').val();
            if (cloth_id && contact_id) {
                $.ajax({
                    url: `/cloths/all-details/${cloth_id}?contact_id=${contact_id}`,
                    type: 'GET',
                    success: function(response) {
                        $('.modal-content').html($(response).find('.modal-content').html());
                    },
                    error: function() {
                        toastr.error("Something went wrong while loading cloth data.");
                    }
                });
            }
        });


    });
</script>
