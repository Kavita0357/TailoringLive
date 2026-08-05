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
                        @php
                            // Use assigned_quantity to determine how many items are assigned to tailor masters.
                            $assigned_qty = isset($sell_line->assigned_quantity)
                                ? intval($sell_line->assigned_quantity)
                                : 0;
                            $completed = $sell_line->completed_quantity;
                            $delivered = $sell_line->delivered_quantity;
                        @endphp
                        <tr data-assigned-qty="{{ $assigned_qty }}">
                            @if ($sell_line->cloth_name)
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sell_line->cloth_name }}</td>
                                <td>{{ intval($sell_line->quantity_ordered) }}</td>
                                <td>
                                    <input type="hidden" name="cloths[{{ $index }}][sell_line_id]"
                                        value={{ $sell_line->sell_line_id }} />
                                    <input type="hidden" name="cloths[{{ $index }}][qty]"
                                        value={{ $sell_line->quantity_ordered }} />
                                    <input class="form-control input_number row_discount_amount assigned-aware"
                                        name="cloths[{{ $index }}][completed]" type="text"
                                        value="{{ intval($completed) }}" required
                                        @if ($assigned_qty <= 0) readonly @endif>
                                </td>
                                <td>
                                    <input class="form-control input_number row_discount_amount assigned-aware"
                                        name="cloths[{{ $index }}][delivered]" type="text"
                                        value="{{ intval($delivered) }}" required
                                        @if ($assigned_qty <= 0) readonly @endif>
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

            @if (!$has_tailoring_master)
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <span style="color: #e3342f; font-weight: 600; font-size: 13px;">
                            Must assign Tailormaster before inputting partial delivery
                        </span>
                    </div>
                </div>
            @endif

            <div class="row" style="margin-top: 10px; display: none;" id="partial_delivery_error">
                <div class="col-md-12">
                    <span style="color: #e3342f; font-size: 13px;">
                        @lang('tailoring.qty_exceeded')
                    </span>
                </div>
            </div>
            <div class="row" style="margin-top: 10px; display: none;" id="partial_delivery_unassigned_error">
                <div class="col-md-12">
                    <span style="color: #e3342f; font-size: 13px;">
                        @lang('tailoring.has_unassigned')
                    </span>
                </div>
            </div>
            <div class="row" style="margin-top: 10px; display: none;" id="partial_delivery_assigned_exceeded_error">
                <div class="col-md-12">
                    <span style="color: #e3342f; font-size: 13px;">
                        @lang('tailoring.has_assigned_exceeded')
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.cancel')</button>
        </div>
    </div><!-- /.modal-content -->
    {!! Form::close() !!}
</div><!-- /.modal-dialog -->

<script>
    $(document).ready(function() {
        $('#edit_partial_delivery_form').on('submit', function(e) {
            let isValid = true;
            $(this).find('tbody tr').each(function() {
                let qtyInput = $(this).find('input[name$="[qty]"]');
                if (qtyInput.length > 0) {
                    let qty = parseFloat(qtyInput.val()) || 0;
                    let completed = parseFloat($(this).find('input[name$="[completed]"]')
                        .val()) || 0;
                    let delivered = parseFloat($(this).find('input[name$="[delivered]"]')
                        .val()) || 0;

                    // General quantity checks
                    if (completed > qty || delivered > qty || delivered > completed) {
                        isValid = false;
                        return false; // Break out of each loop
                    }

                    // Per-row assigned quantity checks
                    let assignedQty = parseFloat($(this).data('assigned-qty')) || 0;

                    // If nothing is assigned, user should not mark completed/delivered
                    if (assignedQty <= 0 && (completed > 0 || delivered > 0)) {
                        isValid = false;
                        $(this).data('unassigned-error', 1);
                        return false; // Break out of each loop
                    }

                    // If only part of the items are assigned, completed/delivered cannot exceed assignedQty
                    if (assignedQty > 0 && assignedQty < qty && (completed > assignedQty ||
                            delivered > assignedQty)) {
                        isValid = false;
                        $(this).data('assigned-exceeded-error', 1);
                        return false;
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                // If specific errors were set on any row, show corresponding messages
                let hasUnassigned = $(this).find('tbody tr').filter(function() {
                    return $(this).data('unassigned-error') == 1;
                }).length > 0;
                let hasAssignedExceeded = $(this).find('tbody tr').filter(function() {
                    return $(this).data('assigned-exceeded-error') == 1;
                }).length > 0;

                if (hasUnassigned) {
                    $('#partial_delivery_unassigned_error').show();
                    $('#partial_delivery_error').hide();
                    $('#partial_delivery_assigned_exceeded_error').hide();
                } else if (hasAssignedExceeded) {
                    $('#partial_delivery_assigned_exceeded_error').show();
                    $('#partial_delivery_error').hide();
                    $('#partial_delivery_unassigned_error').hide();
                } else {
                    $('#partial_delivery_error').show();
                    $('#partial_delivery_unassigned_error').hide();
                    $('#partial_delivery_assigned_exceeded_error').hide();
                }
                // Scroll to top of modal body to ensure message is visible
                $('.modal-body').scrollTop(0);
            } else {
                $('#partial_delivery_error').hide();
                $('#partial_delivery_unassigned_error').hide();
            }
        });
    });
</script>
