<div class="modal-dialog" role="document">
    {!! Form::open([
        'url' => action([\App\Http\Controllers\SellController::class, 'updatePartialDelivery'], [$transaction->id]),
        'method' => 'put',
        'id' => 'edit_partial_delivery_form',
    ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                @lang('tailoring.partial_delivery')
            </h4>
        </div>
        @php
            $index = 0;
        @endphp
        <div class="modal-body">
            <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                <thead>
                    <tr>
                        <th class="col-md-2">
                            #
                        </th>
                        <th class="col-md-3">
                            @lang('tailoring.cloth')
                        </th>
                        <th class="col-md-3">
                            @lang('tailoring.order_qty')
                        </th>
                        <th class="col-md-2">
                            @lang('tailoring.completed')
                        </th>
                        <th class="col-md-2">
                            @lang('tailoring.delivered')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sell_details as $sell_line)
                        <tr>
                            @if($sell_line->cloth_name)
                                @php
                                    $completed = $sell_line->completed_quantity;
                                    $delivered = $sell_line->delivered_quantity;
                                    /* if ($transaction['delivery_status'] == 'ready_to_deliver') {
                                        $completed = $sell_line->quantity_ordered;
                                        // $delivered = $sell_line->delivered_quantity;
                                    }else if ($transaction['delivery_status'] == 'delivered') {
                                        $completed = $sell_line->quantity_ordered;
                                        $delivered = $sell_line->quantity_ordered;
                                    } */
                                @endphp
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sell_line->cloth_name }}</td>
                                <td>{{ intval($sell_line->quantity_ordered) }}</td>
                                <td>
                                    <input type="hidden" name="cloths[{{ $index }}][sell_line_id]"
                                        value={{ $sell_line->sell_line_id }} />
                                    <input type="hidden" name="cloths[{{ $index }}][qty]"
                                        value={{ $sell_line->quantity_ordered }} />
                                    <input class="form-control input_number row_discount_amount"
                                        name="cloths[{{ $index }}][completed]" type="text"
                                        value="{{ intval($completed) }}" required>
                                </td>
                                <td>
                                    <input class="form-control input_number row_discount_amount"
                                        name="cloths[{{ $index }}][delivered]" type="text"
                                        value="{{ intval($delivered) }}" required>
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
                        <strong>{{ __('lang_v1.activities') }}:</strong><br>
                        @includeIf('activity_log.activities', ['activity_type' => 'sell'])
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.cancel')</button>
        </div>
    </div><!-- /.modal-content -->
    {!! Form::close() !!}
</div><!-- /.modal-dialog -->
