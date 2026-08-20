<style type="text/css">
    .mt-3 {
        margin-top: 30px;
    }

    .input-col {
        padding: 12px;
        width:100%;
    }

    .tw-bg-gray-200 {
        background-color: #f8f9fa;
    }

    .tw-bg-primary-400 {
        background-color: #4285f4;
    }

    .style-card-title {
        padding: 10px;
    }

    .style-card-body {
        padding: 10px;
    }

    .style-card-body .form-group {
        border: 1px solid #b5b2b2;
        padding: 10px 10px;
        border-radius: 5px;
        text-align: center;
    }

    .measurement-card {
        display: flex;
        width: 100%;
        margin-bottom: 15px;
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        border: 1px solid oklch(92.8% 0.006 264.531);
        box-shadow:
            0 1px 3px 0 rgba(0, 0, 0, 0.1),
            0 1px 2px -1px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        align-self: flex-start
    }

    .customer-measuremnt-content {
        padding: 20px;
    }

    .custom-layout {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .custom-layout label,
    .custom-layout .form-control {
        font-size: 12px;
    }

    .style-card p {
        font-size: 14px;
    }

    .measurement-section {
        flex: 1;
        min-width: 0;
    }

    /* Masonry-like layout using CSS columns for measurements */
    .measurement-grid {
        display: flex;
        column-gap: 15px;
    }

    @media (max-width: 992px) {
        .measurement-grid {
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .measurement-grid {
            column-count: 1;
        }
    }

    .style-section {
        width: 50%;
        /* min-width: 380px; */
        /* max-width: 520px; */
        display: grid;
        grid-template-columns: 1fr 110px;
        gap: 10px;
        flex-shrink: 0;
    }

    .style-col {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .design-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .design-img {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .style-card {
        box-shadow:
            0 1px 3px 0 rgba(0, 0, 0, 0.1),
            0 1px 2px -1px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        overflow: hidden;
        margin: 0;
        border: 1px solid oklch(92.8% 0.006 264.531);
    }

    .style-card-title {
        padding: 10px;
    }

    .style-card-body {
        padding: 10px;
        max-height: 1000px;
        opacity: 1;
        overflow: hidden;
        transition: max-height 0.35s ease, opacity 0.35s ease, padding 0.35s ease;
    }

    .style-card.collapsed .style-card-body {
        max-height: 0;
        opacity: 0;
        padding-top: 0;
        padding-bottom: 0;
    }

    .style-measurement-modal {
        width: 100%;
        max-width: 1200px;
    }

    .style-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .toggle-icon {
        color: #fff;
        font-size: 12px;
        transition: 0.3s;
    }

    .style-card.collapsed .toggle-icon {
        transform: rotate(-180deg);
    }

    .style-card.collapsed .style-card-body {
        display: none;
    }

    .style-no-design-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
    }

    .style-no-design-name {
        font-size: 14px;
        font-weight: 600;
        color: oklch(44.6% 0.03 256.802);
    }

    .style-checkbox {
        width: 22px;
        height: 22px;
        accent-color: #3b78f0;
        cursor: pointer;
        flex-shrink: 0;
    }

    .design-item .form-group {
        border: 1px solid #d6d6d6;
        border-radius: 6px;
        padding: 10px;
        background: #fff;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 0;
    }

    .design-left {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .design-top {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        margin-bottom: 10px;
    }

    .design-top label {
        font-size: 12px;
        font-weight: 600;
        line-height: 18px;
        margin: 0;
    }

    .design-value {
        margin-top: auto;
        width: 100%;
    }

    .design-right {
        width: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .design-img img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        background: #f5f5f5;
        border-radius: 4px;
    }

    .row-select {
        appearance: none;
        -webkit-appearance: none;
        width: 14px;
        height: 14px;
        min-width: 14px;
        border: 1px solid #cfcfcf;
        border-radius: 4px;
        background: #fff;
        cursor: pointer;
        position: relative;
        transition: 0.2s;
        margin-top: 2px;
    }

    .style-no-design-item .row-select {
        width: 16px;
        height: 16px;
        min-width: 16px;
    }

    .row-select:hover {
        border-color: #4285f4;
    }

    .row-select:checked {
        background: #4285f4;
        border-color: #4285f4;
    }

    .row-select:checked::after {
        content: '';
        position: absolute;
        left: 4px;
        top: 1px;
        width: 5px;
        height: 8px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    input[type="text"],
    textarea {
        border-radius: 4px !important;
        border-color: oklch(92.8% 0.006 264.531);
    }

    textarea.form-control {
        overflow-y: auto;
        resize: none;
        background-color: oklch(98.5% 0.002 247.839);
    }

    .empty-assignment-box {
        width: 100%;
    }

    .empty-assignment-content h4 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #1f2937;
    }

    .empty-assignment-card {
        width: 100%;
        min-height: 250px;
        background: #eef2f7;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .empty-assignment-card p {
        font-size: 18px;
        font-weight: 700;
        color: #4b5563;
        margin: 0;
    }
</style>
<div class="@if ($view_only == true) customer-measuremnt-wrapper @else modal-dialog modal-dialog-centered style-measurement-modal @endif"
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
            <div class="container">

                <div class="custom-layout">
                    <div class="measurement-section">
                        @if ($cloth->measurements->isNotEmpty())

                            <div class="measurement-grid">

                                @foreach ($cloth->measurements as $index => $m)
                                    <div class="measurement-card">

                                        <div class="tw-bg-gray-200 tw-rounded-md input-col">

                                            <div class="form-group">
                                                <label>{{ $m->measurement_name }}</label>

                                                <input type="hidden" name="measurements[{{ $index }}][id]"
                                                    value="{{ $m->id }}">

                                                <input type="hidden"
                                                    name="measurements[{{ $index }}][measurement_name]"
                                                    value="{{ $m->measurement_name }}">

                                                <input type="text" class="form-control"
                                                    @if ($view_only) readonly @endif
                                                    name="measurements[{{ $index }}][value]"
                                                    value="{{ $cloth_customization['measurements'][$index]['value'] ?? '' }}">
                                            </div>

                                            @if ($m->subMeasurements->isNotEmpty())
                                                @foreach ($m->subMeasurements as $sub_index => $sub)
                                                    <div class="form-group">

                                                        <label>{{ $sub->sub_measurement_name }}</label>

                                                        <input type="text" class="form-control"
                                                            @if ($view_only) readonly @endif
                                                            name="measurements[{{ $index }}][sub_measurements][{{ $sub_index }}][value]"
                                                            value="{{ $cloth_customization['measurements'][$index]['sub_measurements'][$sub_index]['value'] ?? '' }}">
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div class="empty-assignment-box">

                                <div class="empty-assignment-content">

                                    <h4>@lang('tailoring.measurements')</h4>

                                    <div class="empty-assignment-card">
                                        <p class="tw-text-gray-600 tw-text-base tw-font-bold">@lang('tailoring.need_to_assign')</p>
                                    </div>

                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="style-section">
                        @if ($cloth->styles->isNotEmpty())

                            @if ($cloth->styles->filter(fn($s) => $s->designs->isNotEmpty())->count())
                                <div class="style-col">
                                    @foreach ($cloth->styles->filter(fn($s) => $s->designs->isNotEmpty()) as $index => $s)
                                        <div
                                            class="style-card tw-rounded-md @if (!$loop->first) collapsed @endif">

                                            <div class="tw-bg-primary-400 style-card-title style-toggle">

                                                <p class="tw-text-white tw-text-base tw-font-bold">
                                                    {{ $s->style_name }}
                                                </p>

                                                <span class="toggle-icon">▲</span>

                                                <input type="hidden" name="styles[{{ $index }}][id]"
                                                    value="{{ $s->id }}">
                                                <input type="hidden" name="styles[{{ $index }}][name]"
                                                    value="{{ $s->style_name }}">

                                            </div>

                                            <div class="style-card-body">

                                                <div class="design-grid">

                                                    @foreach ($s->designs as $sub_index => $sub)
                                                        <div class="design-item">

                                                            <div class="form-group">

                                                                <div class="design-left">

                                                                    <div class="design-top">

                                                                        <input type="checkbox" class="row-select"
                                                                            id="styles[{{ $index }}][designs][{{ $sub_index }}][value]"
                                                                            name="styles[{{ $index }}][designs][{{ $sub_index }}][id]"
                                                                            value="{{ $sub->id }}"
                                                                            @if ($view_only) disabled @endif
                                                                            @if (isset($cloth_customization['styles'][$index]['designs'][$sub_index]['id']) &&
                                                                                    $cloth_customization['styles'][$index]['designs'][$sub_index]['id'] == $sub->id) checked @endif>

                                                                        <label
                                                                            for="styles[{{ $index }}][designs][{{ $sub_index }}][value]">
                                                                            {{ $sub->design_name }}
                                                                        </label>

                                                                    </div>

                                                                    <input class="form-control design-value"
                                                                        type="text"
                                                                        @if ($view_only) readonly @endif
                                                                        name="styles[{{ $index }}][designs][{{ $sub_index }}][design_value]"
                                                                        id="styles[{{ $index }}][designs][{{ $sub_index }}][design_value]"
                                                                        value="{{ $cloth_customization['styles'][$index]['designs'][$sub_index]['design_value'] ?? '' }}">

                                                                </div>

                                                                <div class="design-right">

                                                                    <div class="design-img">
                                                                        <img
                                                                            src="{{ $sub->design_image ? asset('storage/' . $sub->design_image) : asset('/img/default.png') }}">
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    @endforeach

                                                </div>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($cloth->styles->filter(fn($s) => $s->designs->isEmpty())->count())
                                <div class="style-col">
                                    @foreach ($cloth->styles->filter(fn($s) => $s->designs->isEmpty()) as $index => $s)
                                        <div class="style-no-design-item">
                                            <input type="checkbox" class="row-select" {{-- @if ($view_only) disabled @endif --}} disabled
                                                name="styles[{{ $index }}][id]" value="{{ $s->id }}"
                                                @if (isset($cloth_customization['styles'][$index]['id']) && $cloth_customization['styles'][$index]['id'] == $s->id) checked @endif>
                                            <span class="style-no-design-name">
                                                {{ $s->style_name }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="empty-assignment-box">
                                <div class="empty-assignment-content">
                                    <h4>@lang('tailoring.style')</h4>
                                    <div class="empty-assignment-card">
                                        <p class="tw-text-gray-600 tw-text-base tw-font-bold">@lang('tailoring.need_to_assign')</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>@lang('tailoring.note')</label>
                            <textarea class="form-control" name="cloth_customization_note" rows="2" placeholder="@lang('tailoring.note')">{{ $cloth_customization->note ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.module_form_part')
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

        $('body')
            .off('click', '.style-toggle')
            .on('click', '.style-toggle', function(e) {

                e.preventDefault();
                e.stopPropagation();

                const $card = $(this).closest('.style-card');

                $('.style-card').not($card).addClass('collapsed');
                $card.toggleClass('collapsed');

                if (!$card.hasClass('collapsed')) {
                    $card[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                        inline: 'nearest'
                    });
                }

            });

        $(document).on('click', '.style-card-body .row-select', function() {
            const $row = $(this).closest('.style-card-body');
            if ($(this).is(':checked')) {
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
