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
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;
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
            $grouped_sell_details = $sell_details->groupBy('cloth_id');
            $index = 0;
        @endphp <div class="modal-body">
            <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-3">@lang('tailoring.cloth') </th>
                        <th class="col-md-1">@lang('tailoring.qty') </th>
                        <th class="col-md-2">@lang('tailoring.assigned_qty') </th>
                        <th class="col-md-4">@lang('tailoring.assign_to_tailoring_master') </th>
                        <th class="col-md-1">&nbsp;</th>
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
                                $remaining_qty = intval($total_qty) - $assigned_sum;
                            @endphp
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                    <input type="hidden" name="cloths[{{ $index }}][cloth_id]"
                                        value="{{ $first_line->cloth_id }}">
                                    <input type="hidden" name="cloths[{{ $index }}][qty]"
                                        value="{{ intval($total_qty) }}">
                                </td>
                                <td>{{ $first_line->cloth_name }}</td>
                                <td>{{ intval($total_qty) }}</td>
                                <td>
                                    <div class="assigned-qty-container" data-cloth-index="{{ $index }}">
                                        @php
                                            $row_i = 0;
                                        @endphp
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
                                        @if ($assigned_sum == 0)
                                            @for ($r = 0; $r < $remaining_qty; $r++)
                                                <div class="assignment-qty-row form-group" style="margin-bottom: 10px;">
                                                    <input type="hidden"
                                                        name="cloths[{{ $index }}][assignments][{{ $row_i }}][sell_line_id]"
                                                        value="{{ $row_i == 0 ? $first_line->sell_line_id : '' }}">
                                                    <input
                                                        class="form-control input_number row_discount_amount assigned-qty-input"
                                                        name="cloths[{{ $index }}][assignments][{{ $row_i }}][assigned_qty]"
                                                        type="number" min="1" max="{{ intval($total_qty) }}"
                                                        value="1" required>
                                                </div>
                                                @php
                                                    $row_i++;
                                                @endphp
                                            @endfor
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
                                                    style="height: 34px;"><i class="fa fa-times"></i></button>
                                            </div>
                                            @php
                                                $row_i++;
                                            @endphp
                                        @endforeach
                                        @if ($assigned_sum == 0)
                                            @for ($r = 0; $r < $remaining_qty; $r++)
                                                <div class="assignment-tailor-row form-group"
                                                    style="margin-bottom: 10px; display: flex; align-items: center; gap: 5px;">
                                                    <div style="flex-grow: 1;">
                                                        {!! Form::select(
                                                            'cloths[' . $index . '][assignments][' . $row_i . '][tailoring_master]',
                                                            $tailor_masters,
                                                            null,
                                                            [
                                                                'class' => 'form-control select2 assignment-tailor-select',
                                                                'placeholder' => __('tailoring.select_tailoring_master'),
                                                            ],
                                                        ) !!}
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-xs btn-danger remove-assignment-row-btn"
                                                        style="height: 34px;"><i class="fa fa-times"></i></button>
                                                </div>
                                                @php
                                                    $row_i++;
                                                @endphp
                                            @endfor
                                        @endif
                                    </div>
                                </td>
                                <td style="vertical-align: bottom; padding-bottom: 10px;">
                                    <button type="button" class="btn btn-primary btn-sm add-assignment-row-btn"
                                        style="margin-bottom: 10px;"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                            @php
                                $index++;
                            @endphp
                        @endif
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

        function updateTailoringMasterDisabledStates() {
            var commonValue = $commonTailoringMaster.val();
            var $innerTailoringMasters = $(".assignment-tailor-select");

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

        $commonTailoringMaster.on('change', function() {
            updateTailoringMasterDisabledStates();
        });

        $(document).on('change', '.assignment-tailor-select', function() {
            updateTailoringMasterDisabledStates();
        });

        var tailor_options_html = "";
        if ($commonTailoringMaster.length) {
            var $options = $commonTailoringMaster.find('option').clone();
            $options.removeAttr('selected');
            var tempDiv = $('<div>').append($options);
            tailor_options_html = tempDiv.html();
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
            var $modal = $('#assign_tailoring_master_form').closest('.modal');
            $elements.each(function() {
                $(this).removeAttr('required');

                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
                $(this).select2({
                    dropdownParent: $modal.length ? $modal : $('#assign_tailoring_master_form'),
                    width: '100%'
                });
            });
        }

        initSelect2($(".assignment-tailor-select"));

        $(document).on('click', '.add-assignment-row-btn', function() {
            var $row = $(this).closest('tr');
            var $tailorContainer = $row.find('.tailor-select-container');
            var cloth_index = $tailorContainer.attr('data-cloth-index');
            var total_qty = parseInt($tailorContainer.attr('data-total-qty')) || 0;
            var $qtyContainer = $row.find('.assigned-qty-container');

            var assigned_sum = 0;
            $qtyContainer.find('.assigned-qty-input').each(function() {
                assigned_sum += parseInt($(this).val()) || 0;
            });

            if (assigned_sum > total_qty) {
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
                           type="number" 
                           min="1"
                           value="1" 
                           required>
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
                    <button type="button" class="btn btn-xs btn-danger remove-assignment-row-btn" style="height: 34px;"><i class="fa fa-times"></i></button>
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
            updateTailoringMasterDisabledStates();
            updateRemoveButtonsVisibility($tailorContainer);
            validateAssignedQuantities();
        });
        $(document).on('click', '.remove-assignment-row-btn', function() {
            var $tailorContainer = $(this).closest('.tailor-select-container');
            var cloth_index = $tailorContainer.attr('data-cloth-index');
            var $qtyContainer = $(`.assigned-qty-container[data-cloth-index="${cloth_index}"]`);

            var indexToRemove = $tailorContainer.find('.assignment-tailor-row').index($(this).closest(
                '.assignment-tailor-row'));

            $qtyContainer.find('.assignment-qty-row').eq(indexToRemove).remove();
            $(this).closest('.assignment-tailor-row').remove();

            reindexRows($qtyContainer, true);
            reindexRows($tailorContainer, false);
            updateRemoveButtonsVisibility($tailorContainer);
            validateAssignedQuantities();
        });

        function validateAssignedQuantities() {
            $('.assigned-qty-container').each(function() {
                var $container = $(this);
                var $row = $container.closest('tr');
                var $errorMsg = $row.find('.error-msg');

                $errorMsg.hide().text('');
            });

            var $submitBtn = $('#assign_tailoring_master_form').find('button[type="submit"]');
            $submitBtn.prop('disabled', false);
        }

        $(document).on('change keyup', '.assigned-qty-input', function() {
            validateAssignedQuantities();
        });

        $('#assign_tailoring_master_form').on('submit', function(e) {
            // Ensure any disabled selects (populated by common selector) are enabled
            // so their values are included in the POST payload.
            $('.assignment-tailor-select').each(function() {
                if ($(this).prop('disabled')) {
                    $(this).prop('disabled', false);
                }
            });

            // Also ensure common select enabled so its value is available server-side
            if ($commonTailoringMaster.prop('disabled')) {
                $commonTailoringMaster.prop('disabled', false);
            }

            validateAssignedQuantities();

            var isValid = true;
            var commonValue = $commonTailoringMaster.val();

            $('.assigned-qty-container').each(function() {
                var cloth_index = $(this).attr('data-cloth-index');
                var $row = $(this).closest('tr');
                var cloth_name = $row.find('td').eq(1).text().trim();
                var total_qty = parseInt($row.find('td').eq(2).text().trim()) || 0;

                var assigned_sum = 0;
                $(this).find('.assigned-qty-input').each(function() {
                    assigned_sum += parseInt($(this).val()) || 0;
                });

                if (assigned_sum > total_qty) {
                    toastr.error(
                        `Total assigned quantity for "${cloth_name}" cannot exceed ${total_qty} (currently ${assigned_sum}).`
                    );
                    isValid = false;
                    return false;
                }

                if (!isValid) return false;
            });

            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });

        // Initial state check
        updateTailoringMasterDisabledStates();
        validateAssignedQuantities();

        var $assignTailoringMasterModal = $('#assign_tailoring_master_form').closest('.modal');
        $assignTailoringMasterModal.on('shown.bs.modal', function() {
            updateTailoringMasterDisabledStates();
        });
    });
</script>
