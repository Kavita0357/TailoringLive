<style type="text/css">
    .mb-2 {
        margin-bottom: 15px;
    }

    .design-preview {
        max-width: 60px;
    }
</style>

<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        {!! Form::model($style, [
            'url' => action([\App\Http\Controllers\StyleController::class, 'update'], [$style->id]),
            'method' => 'PUT',
            'id' => 'style_edit_form',
            'files' => true,
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('tailoring.edit_style')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloths', __('tailoring.select_cloths') . ':') !!}
                        {!! Form::select('cloths[]', $cloths, optional($style->cloths)->pluck('id')->toArray(), [
                            'class' => 'form-control select select2',
                            'multiple' => true,
                            // 'required' => true,
                            'style' => 'width: 100%',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('style_name', __('tailoring.style_name') . ':') !!}
                        {!! Form::text('style_name', $style->style_name, [
                            'class' => 'form-control',
                            'placeholder' => __('tailoring.style_name'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::number('serial_no', $style->serial_no, [
                            'class' => 'form-control',
                            'placeholder' => __('tailoring.serial_no'),
                            'required'=>false,
                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-10">
                    <p class="text text-bold">@lang('tailoring.designs'):</p>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add_design_row">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <div id="design_repeater_wrapper">
                @foreach ($style->designs as $index => $design)
                    <div class="row design_row mb-2">
                        {!! Form::hidden("designs[$index][id]", $design->id) !!}
                        <div class="col-md-4">
                            {!! Form::text("designs[$index][name]", $design->design_name, [
                                'class' => 'form-control',
                                'placeholder' => __('tailoring.design_name'),
                                'required',
                            ]) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::number("designs[$index][serial_no]", $design->serial_no, [
                                'class' => 'form-control',
                                'placeholder' => __('tailoring.serial_no'),
                                'required',
                            ]) !!}
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($design->design_image)
                                        <img src="{{ asset('storage/' . $design->design_image) }}"
                                            class="design-preview">
                                    @else
                                        <img src="/img/default.png">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    {!! Form::file("designs[$index][image]", ['class' => 'form-control', 'accept' => 'image/*']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove_design_row">&minus;</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

<script>
    $(document).ready(function() {
        let designIndex = {{ $style->designs->count() }};

        $('#add_design_row').on('click', function() {
            let newRow = `
                <div class="row design_row mb-2">
                    <div class="col-md-4">
                        <input type="text" name="designs[${designIndex}][name]" class="form-control" placeholder="Design Name" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="designs[${designIndex}][serial_no]" class="form-control" placeholder="Serial No" required>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="designs[${designIndex}][image]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove_design_row">&minus;</button>
                    </div>
                </div>
            `;
            $('#design_repeater_wrapper').append(newRow);
            designIndex++;
        });

        $(document).on('click', '.remove_design_row', function() {
            $(this).closest('.design_row').remove();
        });

        $(document).find('.select2').select2({allowClear: true,
            placeholder: "Select cloths",
            allowClear: true,
        });

    });
</script>
