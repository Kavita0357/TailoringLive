<style>
    .col {
        width: 50%;
    }

    .order-processing-modal .modal-dialog {
        max-width: 1100px;
        width: 100%;
    }

    .order-processing-modal .assigned-qty-input,
    .order-processing-modal .assignment-tailor-select,
    .order-processing-modal .completed-input,
    .order-processing-modal .delivered-input {
        min-width: 100px;
        max-width: 170px;
        width: 100%;
    }

    .order-processing-modal .assignment-qty-row,
    .order-processing-modal .assignment-tailor-row {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .order-processing-modal .assigned-qty-container,
    .order-processing-modal .tailor-select-container {
        width: 100%;
    }

    .order-processing-modal th,
    .order-processing-modal td {
        white-space: normal;
    }
</style>
<div class="modal-dialog modal-lg order-processing-modal" role="document">
    {!! Form::open([
        'url' => action([\App\Http\Controllers\SellController::class, 'updateOrderProcessingDelivery'], [$transaction->id]),
        'method' => 'put',
        'id' => 'order_processing_delivery_form',
    ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <div class="tw-flex tw-items-start tw-justify-between tw-gap-6">
                <div class="col">
                    <h4 class="modal-title">@lang('tailoring.order_processing_delivery')</h4>
                </div>
            </div>
        </div>
        @php
            $grouped_sell_details = $sell_details->groupBy('cloth_id');
            $index = 0;
        @endphp
        <div class="modal-body">
            <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-2">@lang('tailoring.cloth')</th>
                        <th class="col-md-1">@lang('tailoring.qty')</th>
                        <th class="col-md-2">@lang('tailoring.assigned_qty')</th>
                        <th class="col-md-3">@lang('tailoring.assign_to_tailoring_master')</th>
                        <th class="col-md-1">&nbsp;</th>
                        <th class="col-md-1">@lang('tailoring.completed')</th>
                        <th class="col-md-1">@lang('tailoring.delivered')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped_sell_details as $cloth_id => $group)
                        @php
                            $first_line = $group->first();
                        @endphp
                        @if ($first_line && $first_line->cloth_name)
                            @php
                                $total_qty = $group->sum('quantity_ordered');
                                $valid_assignments = [];
                                $assigned_sum = 0;
                                foreach ($group as $sell_line) {
                                    if (!empty($sell_line->tailoring_master_id)) {
                                        $valid_assignments[] = $sell_line;
                                        $assigned_sum += intval($sell_line->assigned_quantity);
                                    }
                                }
                                $completed = $group->sum('completed_quantity');
                                $delivered = $group->sum('delivered_quantity');
                                $can_edit_delivery = $assigned_sum > 0;
                            @endphp
                            <tr data-total-qty="{{ intval($total_qty) }}" data-assigned-qty="{{ $assigned_sum }}">
                                <td>
                                    {{ $index + 1 }}
                                    <input type="hidden" name="cloths[{{ $index }}][cloth_id]"
                                        value="{{ $first_line->cloth_id }}">
                                    <input type="hidden" name="cloths[{{ $index }}][qty]"
                                        value="{{ intval($total_qty) }}">
                                    @foreach ($group as $sell_line)
                                        <input type="hidden" name="cloths[{{ $index }}][sell_line_ids][]"
                                            value="{{ $sell_line->sell_line_id }}">
                                    @endforeach
                                </td>
                                <td>{{ $first_line->cloth_name }}</td>
                                <td class="cloth-total-qty">{{ intval($total_qty) }}</td>
                                <td>
                                    <div class="assigned-qty-container" data-cloth-index="{{ $index }}">
                                        @php
                                            $row_i = 0;
                                        @endphp
                                        @if (count($valid_assignments) > 0)
                                            @foreach ($valid_assignments as $sell_line)
                                                <div class="assignment-qty-row form-group" style="margin-bottom: 10px;">
                                                    <input type="hidden"
                                                        name="cloths[{{ $index }}][assignments][{{ $row_i }}][sell_line_id]"
                                                        value="{{ $sell_line->sell_line_id }}">
                                                    <input
                                                        class="form-control input_number row_discount_amount assigned-qty-input"
                                                        name="cloths[{{ $index }}][assignments][{{ $row_i }}][assigned_qty]"
                                                        type="number" min="1"
                                                        value="{{ intval($sell_line->assigned_quantity) }}" required>
                                                </div>
                                                @php
                                                    $row_i++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <div class="assignment-qty-row form-group" style="margin-bottom: 10px;">
                                                <input type="hidden"
                                                    name="cloths[{{ $index }}][assignments][0][sell_line_id]"
                                                    value="{{ $first_line->sell_line_id }}">
                                                <input
                                                    class="form-control input_number row_discount_amount assigned-qty-input"
                                                    name="cloths[{{ $index }}][assignments][0][assigned_qty]"
                                                    type="number" min="1" value="1" required>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-danger error-msg"
                                        style="display: none; font-size: 11px; font-weight: bold; margin-top: 5px; display: block;"></span>
                                </td>
                                <td>
                                    <div class="tailor-select-container" data-cloth-index="{{ $index }}"
                                        data-total-qty="{{ intval($total_qty) }}">
                                        @php
                                            $row_i = 0;
                                        @endphp
                                        @if (count($valid_assignments) > 0)
                                            @foreach ($valid_assignments as $sell_line)
                                                <div class="assignment-tailor-row form-group"
                                                    style="margin-bottom: 10px; display: flex; align-items: center; gap: 5px;">
                                                    <div style="flex-grow: 1;">
                                                        {!! Form::select(
                                                            'cloths[' . $index . '][assignments][' . $row_i . '][tailoring_master]',
                                                            $tailor_masters,
                                                            $sell_line->tailoring_master_id,
                                                            [
                                                                'class' => 'form-control select2 assignment-tailor-select',
                                                                'placeholder' => __('tailoring.select_tailoring_master'),
                                                            ],
                                                        ) !!}
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-xs btn-danger remove-assignment-row-btn"
                                                        style="height: 30px; width: 30px;"><i class="fa fa-times"
                                                            style="font-size: 12px;"></i></button>
                                                </div>
                                                @php
                                                    $row_i++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <div class="assignment-tailor-row form-group"
                                                style="margin-bottom: 10px; display: flex; align-items: center; gap: 5px;">
                                                <div style="flex-grow: 1;">
                                                    {!! Form::select('cloths[' . $index . '][assignments][0][tailoring_master]', $tailor_masters, null, [
                                                        'class' => 'form-control select2 assignment-tailor-select',
                                                        'placeholder' => __('tailoring.select_tailoring_master'),
                                                    ]) !!}
                                                </div>
                                                <button type="button"
                                                    class="btn btn-xs btn-danger remove-assignment-row-btn"
                                                    style="height: 30px; width: 30px;"><i class="fa fa-times"
                                                        style="font-size: 12px;"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td style="vertical-align: bottom; padding-bottom: 10px;">
                                    <button type="button" class="btn btn-primary btn-sm add-assignment-row-btn"
                                        style="margin-bottom: 6px;"><i class="fa fa-plus"></i></button>
                                </td>
                                <td style="vertical-align: bottom; padding-bottom: 10px;">
                                    <input class="form-control input_number row_discount_amount completed-input"
                                        name="cloths[{{ $index }}][completed]" type="number" min="0"
                                        value="{{ intval($completed) }}" required
                                        @if (!$can_edit_delivery) readonly @endif>
                                </td>
                                <td style="vertical-align: bottom; padding-bottom: 10px;">
                                    <input class="form-control input_number row_discount_amount delivered-input"
                                        name="cloths[{{ $index }}][delivered]" type="number" min="0"
                                        value="{{ intval($delivered) }}" required
                                        @if (!$can_edit_delivery) readonly @endif>
                                </td>
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div id="order_processing_error" class="text-danger"
                style="display: none; font-weight: bold; margin-top: 10px;"></div>
            <div id="partial_delivery_error" class="text-danger" style="display: none; margin-top: 10px;"></div>
            <div id="partial_delivery_unassigned_error" class="text-danger" style="display: none; margin-top: 10px;">
                @lang('tailoring.has_unassigned')
            </div>
            <div id="partial_delivery_assigned_exceeded_error" class="text-danger"
                style="display: none; margin-top: 10px;">
                @lang('tailoring.has_assigned_exceeded')
            </div>

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
    {!! Form::close() !!}
</div>

<select id="assignment_tailor_select_template" class="d-none">
    <option value="">@lang('tailoring.select_tailoring_master')</option>
    @foreach ($tailor_masters as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>

<script>
    $(document).ready(function() {
        var $commonTailoringMaster = $('#common_tailoring_master');
        var isSyncing = false;
        var $form = $('#order_processing_delivery_form');

        function hideDeliveryErrors() {
            $('#order_processing_error, #partial_delivery_error, #partial_delivery_unassigned_error, #partial_delivery_assigned_exceeded_error')
                .hide().text('');
            $('#partial_delivery_unassigned_error, #partial_delivery_assigned_exceeded_error').each(function() {
                var original = $(this).data('original-text');
                if (original) {
                    $(this).text(original);
                }
            });
        }

        $('#partial_delivery_unassigned_error, #partial_delivery_assigned_exceeded_error').each(function() {
            $(this).data('original-text', $(this).text());
        });

        function getRowAssignedSum($row) {
            var assigned_sum = 0;
            $row.find('.assigned-qty-input').each(function() {
                var idx = $row.find('.assigned-qty-input').index(this);
                var tailorVal = $row.find('.assignment-tailor-select').eq(idx).val();
                var qty = parseInt($(this).val()) || 0;
                if (tailorVal && qty > 0) {
                    assigned_sum += qty;
                }
            });
            return assigned_sum;
        }

        function updateDeliveryFieldsState($row) {
            var assigned_sum = getRowAssignedSum($row);
            $row.attr('data-assigned-qty', assigned_sum);

            var $completed = $row.find('.completed-input');
            var $delivered = $row.find('.delivered-input');

            if (assigned_sum <= 0) {
                $completed.prop('readonly', true).val(0);
                $delivered.prop('readonly', true).val(0);
            } else {
                $completed.prop('readonly', false);
                $delivered.prop('readonly', false);
            }
        }

        function validateDeliveryQuantities($row) {
            var total_qty = parseInt($row.attr('data-total-qty')) || 0;
            var assigned_sum = getRowAssignedSum($row);
            var completed = parseInt($row.find('.completed-input').val()) || 0;
            var delivered = parseInt($row.find('.delivered-input').val()) || 0;
            var cloth_name = $row.find('td').eq(1).text().trim();
            var maxAllowed = assigned_sum > 0 && assigned_sum < total_qty ? assigned_sum : total_qty;

            if (assigned_sum <= 0 && (completed > 0 || delivered > 0)) {
                return {
                    valid: false,
                    type: 'unassigned',
                    message: null
                };
            }

            if (assigned_sum > 0 && assigned_sum < total_qty && (completed > assigned_sum || delivered >
                    assigned_sum)) {
                return {
                    valid: false,
                    type: 'assigned_exceeded',
                    message: null
                };
            }

            if (completed > maxAllowed || delivered > maxAllowed || delivered > completed) {
                return {
                    valid: false,
                    type: 'qty_exceeded',
                    message: `Invalid completed/delivered quantities for "${cloth_name}". Completed cannot exceed ${maxAllowed}, and delivered cannot exceed completed.`
                };
            }

            return {
                valid: true
            };
        }

        function updateTailoringMasterDisabledStates(isFromCommon) {
            if (isSyncing) return;
            isSyncing = true;

            var commonValue = $commonTailoringMaster.val();
            var $innerTailoringMasters = $(".assignment-tailor-select");

            if (isFromCommon) {
                if (commonValue) {
                    $innerTailoringMasters.each(function() {
                        $(this).val(commonValue).prop('disabled', true).trigger('change.select2');
                    });
                } else {
                    $innerTailoringMasters.each(function() {
                        $(this).val('').prop('disabled', false).trigger('change.select2');
                    });
                }
            } else {
                var hasIndividualAssignment = false;
                $innerTailoringMasters.each(function() {
                    if ($(this).val()) {
                        hasIndividualAssignment = true;
                        return false;
                    }
                });

                if (commonValue) {
                    $innerTailoringMasters.each(function() {
                        $(this).val(commonValue).prop('disabled', true).trigger('change.select2');
                    });
                    $commonTailoringMaster.prop('disabled', false).trigger('change.select2');
                } else {
                    if (hasIndividualAssignment) {
                        $commonTailoringMaster.prop('disabled', true).trigger('change.select2');
                    } else {
                        $commonTailoringMaster.prop('disabled', false).trigger('change.select2');
                    }
                    $innerTailoringMasters.prop('disabled', false).trigger('change.select2');
                }
            }

            isSyncing = false;
        }

        if ($commonTailoringMaster.length) {
            $commonTailoringMaster.on('change', function() {
                updateTailoringMasterDisabledStates(true);
            });

            $form.on('change', '.assignment-tailor-select', function() {
                updateTailoringMasterDisabledStates(false);
                updateDeliveryFieldsState($(this).closest('tr'));
            });
        }

        var tailor_options_html = $('#assignment_tailor_select_template').html() || "";
        if (!tailor_options_html && $commonTailoringMaster.length) {
            var $options = $commonTailoringMaster.find('option').clone();
            $options.removeAttr('selected');
            tailor_options_html = $('<div>').append($options).html();
        }
        if (!tailor_options_html) {
            var $firstAssignSelect = $(".assignment-tailor-select").first();
            if ($firstAssignSelect.length) {
                var $options = $firstAssignSelect.find('option').clone();
                $options.removeAttr('selected');
                tailor_options_html = $('<div>').append($options).html();
            }
        }

        function reindexRows($rowContainer, isQty) {
            var cloth_index = $rowContainer.attr('data-cloth-index');
            if (isQty) {
                $rowContainer.find('.assignment-qty-row').each(function(index) {
                    $(this).find('input[name*="[sell_line_id]"]').attr('name',
                        `cloths[${cloth_index}][assignments][${index}][sell_line_id]`);
                    $(this).find('input[name*="[assigned_qty]"]').attr('name',
                        `cloths[${cloth_index}][assignments][${index}][assigned_qty]`);
                });
            } else {
                $rowContainer.find('.assignment-tailor-row').each(function(index) {
                    $(this).find('select').attr('name',
                        `cloths[${cloth_index}][assignments][${index}][tailoring_master]`);
                });
            }
        }

        function updateRemoveButtonsVisibility($tailorContainer) {
            var $rows = $tailorContainer.find('.assignment-tailor-row');
            if ($rows.length <= 1) {
                $rows.find('.remove-assignment-row-btn').hide();
            } else {
                $rows.find('.remove-assignment-row-btn').show();
            }
        }

        $('.tailor-select-container').each(function() {
            updateRemoveButtonsVisibility($(this));
        });

        function initSelect2($elements) {
            var $modal = $form.closest('.modal');
            $elements.each(function() {
                $(this).removeAttr('required');

                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
                $(this).select2({
                    dropdownParent: $modal.length ? $modal : $form,
                    width: '100%'
                });
            });
        }

        initSelect2($(".assignment-tailor-select"));

        function validateAssignedQuantities() {
            $('.assigned-qty-container').each(function() {
                $(this).closest('tr').find('.error-msg').hide().text('');
            });
            $('#order_processing_error').hide().text('');
            $form.find('button[type="submit"]').prop('disabled', false);
        }

        $form.on('click', '.add-assignment-row-btn', function() {
            var $row = $(this).closest('tr');
            var $tailorContainer = $row.find('.tailor-select-container');
            var cloth_index = $tailorContainer.attr('data-cloth-index');
            var total_qty = parseInt($tailorContainer.attr('data-total-qty')) || 0;
            var $qtyContainer = $row.find('.assigned-qty-container');

            var assigned_sum = 0;
            $qtyContainer.find('.assigned-qty-input').each(function() {
                assigned_sum += parseInt($(this).val()) || 0;
            });

            if (assigned_sum >= total_qty) {
                toastr.error("Cannot add more rows. All quantities are already assigned (" +
                    assigned_sum + "/" + total_qty + ").");
                return;
            }

            var sub_index = $qtyContainer.find('.assignment-qty-row').length;
            if (sub_index >= total_qty) {
                toastr.error("Cannot add more rows than total quantity (" + total_qty + ").");
                return;
            }

            var qty_html = `
                <div class="assignment-qty-row form-group" style="margin-bottom: 10px;">
                    <input type="hidden" name="cloths[${cloth_index}][assignments][${sub_index}][sell_line_id]" value="">
                    <input class="form-control input_number row_discount_amount assigned-qty-input"
                           name="cloths[${cloth_index}][assignments][${sub_index}][assigned_qty]"
                           type="number" min="1" value="1" required>
                </div>
            `;

            var select_html = `
                <div class="assignment-tailor-row form-group" style="margin-bottom: 10px; display: flex; align-items: center; gap: 5px;">
                    <div style="flex-grow: 1;">
                        <select class="form-control assignment-tailor-select"
                                name="cloths[${cloth_index}][assignments][${sub_index}][tailoring_master]">
                            ${tailor_options_html}
                        </select>
                    </div>
                    <button type="button" class="btn btn-xs btn-danger remove-assignment-row-btn" style="height: 30px; width: 30px;">
                        <i class="fa fa-times" style="font-size: 12px;"></i>
                        </button>
                </div>
            `;

            $qtyContainer.append(qty_html);
            $tailorContainer.append(select_html);

            var $newSelect = $tailorContainer.find('.assignment-tailor-row').last().find('select');
            var commonValue = $commonTailoringMaster.val();
            if (commonValue) {
                $newSelect.val(commonValue);
            }

            initSelect2($newSelect);
            updateTailoringMasterDisabledStates(false);
            updateRemoveButtonsVisibility($tailorContainer);
            updateDeliveryFieldsState($row);
            validateAssignedQuantities();
        });

        $form.on('click', '.remove-assignment-row-btn', function() {
            var $tailorContainer = $(this).closest('.tailor-select-container');
            var cloth_index = $tailorContainer.attr('data-cloth-index');
            var $row = $tailorContainer.closest('tr');
            var $qtyContainer = $(`.assigned-qty-container[data-cloth-index="${cloth_index}"]`);

            var indexToRemove = $tailorContainer.find('.assignment-tailor-row').index($(this).closest(
                '.assignment-tailor-row'));

            $qtyContainer.find('.assignment-qty-row').eq(indexToRemove).remove();
            $(this).closest('.assignment-tailor-row').remove();

            reindexRows($qtyContainer, true);
            reindexRows($tailorContainer, false);
            updateRemoveButtonsVisibility($tailorContainer);
            updateDeliveryFieldsState($row);
            validateAssignedQuantities();
        });

        $form.on('change keyup', '.assigned-qty-input', function() {
            updateDeliveryFieldsState($(this).closest('tr'));
            validateAssignedQuantities();
        });

        $form.on('change keyup', '.completed-input, .delivered-input', function() {
            hideDeliveryErrors();
        });

        $form.on('submit', function(e) {
            $('.assignment-tailor-select').each(function() {
                if ($(this).prop('disabled')) {
                    $(this).prop('disabled', false);
                }
            });

            if ($commonTailoringMaster.length && $commonTailoringMaster.prop('disabled')) {
                $commonTailoringMaster.prop('disabled', false);
            }

            hideDeliveryErrors();
            validateAssignedQuantities();

            var isValid = true;
            var commonValue = $commonTailoringMaster.length ? $commonTailoringMaster.val() : '';

            $form.find('tbody tr').each(function() {
                var $row = $(this);
                if (!$row.find('input[name*="[cloth_id]"]').length) {
                    return;
                }

                var cloth_name = $row.find('td').eq(1).text().trim();
                var total_qty = parseInt($row.attr('data-total-qty')) || 0;
                var assigned_sum = 0;
                var missingTailor = false;

                $row.find('.assigned-qty-input').each(function(idx) {
                    var currentQty = parseInt($(this).val()) || 0;
                    assigned_sum += currentQty;

                    if (currentQty > 0) {
                        var tailorVal = $row.find('.assignment-tailor-select').eq(idx)
                            .val();
                        if (!tailorVal && !commonValue) {
                            missingTailor = true;
                        }
                    }
                });

                if (assigned_sum > total_qty) {
                    $('#order_processing_error').text(
                        `Total assigned quantity for "${cloth_name}" cannot exceed ${total_qty} (currently ${assigned_sum}).`
                    ).show();
                    isValid = false;
                    return false;
                }

                if (missingTailor) {
                    $('#order_processing_error').text(
                        `Please select a TailorMaster for "${cloth_name}".`).show();
                    isValid = false;
                    return false;
                }

                var deliveryCheck = validateDeliveryQuantities($row);
                if (!deliveryCheck.valid) {
                    isValid = false;
                    if (deliveryCheck.type === 'unassigned') {
                        $('#partial_delivery_unassigned_error').show();
                    } else if (deliveryCheck.type === 'assigned_exceeded') {
                        $('#partial_delivery_assigned_exceeded_error').show();
                    } else {
                        $('#partial_delivery_error').text(deliveryCheck.message).show();
                    }
                    return false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                $('.modal-body').scrollTop(0);
                return false;
            }
        });

        $form.find('tbody tr').each(function() {
            updateDeliveryFieldsState($(this));
        });

        if ($commonTailoringMaster.length) {
            updateTailoringMasterDisabledStates(false);
        }
        validateAssignedQuantities();

        var $modal = $form.closest('.modal');
        $modal.on('shown.bs.modal', function() {
            if ($commonTailoringMaster.length) {
                updateTailoringMasterDisabledStates(false);
            }
        });
    });
</script>
