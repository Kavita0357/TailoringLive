<style>
    .col {
        width: 50%;
    }
</style>
<div class="modal-dialog" role="document">
    {!! Form::open([
        'url' => action([\App\Http\Controllers\SellController::class, 'updateAssignedTailoringMaster'], [$transaction->id]),
        'method' => 'put',
        'id' => 'assign_tailoring_master_form',
    ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;
                </span></button> --}}
            <div class="tw-flex tw-items-start tw-justify-between tw-gap-6">
                <div class="col">
                    <h4 class="modal-title">@lang('tailoring.assign_to_tailoring_master') </h4>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::select('tailoring_master', $tailor_masters, $transaction->tailoring_master_id ?? null, [
                            'id' => 'common_tailoring_master',
                            'class' => 'form-control select2',
                            'placeholder' => __('tailoring.select_tailoring_master'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>@php
            $index = 0;
        @endphp <div class="modal-body">
            <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                <thead>
                    <tr>
                        <th class="col-md-2">#</th>
                        <th class="col-md-3">@lang('tailoring.cloth') </th>
                        <th class="col-md-2">@lang('tailoring.qty') </th>
                        <th class="col-md-2">@lang('tailoring.assigned_qty') </th>
                        <th class="col-md-3">@lang('tailoring.assign_to_tailoring_master') </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sell_details as $sell_line)
                        <tr>
                            @if ($sell_line->cloth_name)
                                @php
                                    $assigned_qty = isset($sell_line->assigned_quantity)
                                        ? $sell_line->assigned_quantity
                                        : 0;
                                @endphp
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sell_line->cloth_name }}</td>
                                <td>{{ intval($sell_line->quantity_ordered) }}</td>
                                <td><input type="hidden" name="cloths[{{ $index }}][sell_line_id]"
                                        value={{ $sell_line->sell_line_id }} /><input type="hidden"
                                        name="cloths[{{ $index }}][qty]"
                                        value={{ $sell_line->quantity_ordered }} /><input
                                        class="form-control input_number row_discount_amount"
                                        name="cloths[{{ $index }}][assigned_qty]" type="text"
                                        value="{{ intval($assigned_qty) }}" required></td>
                                <td>
                                    <div class="form-group">
                                        {!! Form::select(
                                            'cloths[' . $index . '][tailoring_master]',
                                            $tailor_masters,
                                            $sell_line->tailoring_master_id ?? null,
                                            [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('tailoring.select'),
                                            ],
                                        ) !!}
                                    </div>
                                </td>
                                @php
                                    $index++;
                                @endphp
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (isset($activities) && !empty($activities))
                <div class="row">
                    <div class="col-md-12">
                        <strong>{{ __('lang_v1.activities') }}:</strong><br>@includeIf('activity_log.activities', ['activity_type' => 'sell'])
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.cancel')</button>
        </div>
    </div>
    <!-- /.modal-content -->{!! Form::close() !!}
</div>
<!-- /.modal-dialog -->
<script>
    $(document).ready(function() {

        var $commonTailoringMaster = $('#common_tailoring_master');
        var $innerTailoringMasters = $("select[name*='[tailoring_master]']")
            .not('#common_tailoring_master');

        function toggleTailoringMasters() {
            var commonValue = $commonTailoringMaster.val();

            if (commonValue) {
                $innerTailoringMasters.each(function() {
                    $(this)
                        .val(commonValue)
                        .trigger('change');
                });
                $innerTailoringMasters.prop('disabled', true);

            } else {
                $innerTailoringMasters.prop('disabled', false);
            }
            $innerTailoringMasters.trigger('change.select2');
        }
        $commonTailoringMaster.on('change', function() {
            toggleTailoringMasters();
        });
        toggleTailoringMasters();
    });
</script>
