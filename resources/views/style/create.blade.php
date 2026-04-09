<style type="text/css">
    .mb-2 {
        margin-bottom: 15px;
    }
</style>
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        {!! Form::open([
            'url' => action([\App\Http\Controllers\StyleController::class, 'store']),
            'method' => 'post',
            'id' => 'style_add_form',
            'files' => true,
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">@lang('tailoring.add_style')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('cloths', __('tailoring.select_cloths') . ':') !!}
                        {!! Form::select('cloths[]', $cloths, null, [
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
                        {!! Form::text('style_name', null, [
                            'class' => 'form-control w-100',
                            'placeholder' => __('tailoring.style_name'),
                            'required' => true,
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('serial_no', __('tailoring.serial_no') . ':') !!}
                        {!! Form::number('serial_no', null, [
                            'class' => 'form-control',
                            'placeholder' => __('tailoring.serial_no'),
                            'required' => false,
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-12">
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
                        <div class="row design_row mb-2">
                            <div class="col-md-4">
                                {!! Form::text('designs[0][name]', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('tailoring.design_name'),
                                    'required',
                                ]) !!}
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::number('designs[0][serial_no]', null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('tailoring.serial_no'),
                                        'required' => true,
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                {!! Form::file('designs[0][image]', ['accept' => 'image/*', 'class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove_design_row"
                                    disabled>&minus;</button>
                            </div>
                        </div>
                    </div>
                </div>

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
<script>
    $(document).ready(function() {
        console.log("text")
        let designIndex = 1;

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

        // Remove design row
        $(document).on('click', '.remove_design_row', function() {
            $(this).closest('.design_row').remove();
        });

        $(document).on('click', '.remove_design_row', function() {
            $(this).closest('.design_row').remove();
        });

        $(document).find('.select2').select2({allowClear: true,
            placeholder: "Select cloths",
            allowClear: true,
        });
    })
</script>
