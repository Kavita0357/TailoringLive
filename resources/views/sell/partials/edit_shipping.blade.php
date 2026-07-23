<div class="modal-dialog" role="document">
    {!! Form::open([
        'url' => action([\App\Http\Controllers\SellController::class, 'updateShipping'], [$transaction->id]),
        'method' => 'put',
        'id' => 'edit_shipping_form',
    ]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                @if ($transaction->type == 'order')
                    @lang('tailoring.delivery_status')
                @else
                    @lang('lang_v1.edit_shipping') - @if ($transaction->type == 'purchase_order')
                        {{ $transaction->ref_no }}
                    @else
                        {{ $transaction->invoice_no }}
                    @endif
            </h4>
            @endif
        </div>
        <div class="modal-body">
            <div class="row">
                @if ($transaction->type == 'order')
                    <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px;">
                            {!! Form::label('delivery_status', __('tailoring.delivery_status') . ':') !!}
                            {!! Form::select(
                                'delivery_status',
                                $delivery_statuses,
                                !empty($transaction->delivery_status) ? $transaction->delivery_status : null,
                                ['class' => 'form-control', 'id' => 'delivery_status', 'placeholder' => __('messages.please_select')],
                                ['partially_delivered' => ['disabled' => true]]
                            ) !!}
                        </div>
                    </div>
                    <div class="col-md-4" id="deliveryPerson"
                        @if (empty($transaction->delivery_status) || $transaction->delivery_status != 'delivered') style="display: none;" @endif>
                        <div class="form-group">
                            {!! Form::label('delivery_person', __('lang_v1.delivery_person') . ':') !!}
                            <p class="form-control-static">
                                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-4" id="tailoringMaster"
                        @if (empty($transaction->delivery_status) || $transaction->delivery_status != 'preparing') style="display: none;" @endif>
                        <div class="form-group">
                            {!! Form::label('tailoring_master', __('tailoring.assign_to_tailoring_master') . ':') !!}
                            {!! Form::select(
                                'tailoring_master',
                                $tailor_masters,
                                $transaction->tailoring_master_id ?? null,
                                ['class' => 'form-control select2', 'id' => 'common_tailoring_master', 'placeholder' => __('messages.please_select')],
                            ) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p id="delivery_status_subtitle" style="color: #c9302c; font-weight: bold; margin-bottom: 10px; display: none;"></p>
                    </div>
                @else
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_details', __('sale.shipping_details') . ':*') !!}
                            {!! Form::textarea(
                                'shipping_details',
                                !empty($transaction->shipping_details) ? $transaction->shipping_details : '',
                                ['class' => 'form-control', 'placeholder' => __('sale.shipping_details'), 'required', 'rows' => '4'],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_address', __('lang_v1.shipping_address') . ':') !!}
                            {!! Form::textarea(
                                'shipping_address',
                                !empty($transaction->shipping_address) ? $transaction->shipping_address : '',
                                ['class' => 'form-control', 'placeholder' => __('lang_v1.shipping_address'), 'rows' => '4'],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_status', __('lang_v1.shipping_status') . ':') !!}
                            {!! Form::select(
                                'shipping_status',
                                $shipping_statuses,
                                !empty($transaction->shipping_status) ? $transaction->shipping_status : null,
                                ['class' => 'form-control', 'placeholder' => __('messages.please_select')],
                            ) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('delivered_to', __('lang_v1.delivered_to') . ':') !!}
                            {!! Form::text('delivered_to', !empty($transaction->delivered_to) ? $transaction->delivered_to : null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang_v1.delivered_to'),
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('delivery_person', __('lang_v1.delivery_person') . ':') !!}
                            {!! Form::select(
                                'delivery_person',
                                $users,
                                !empty($transaction->delivery_person) ? $transaction->delivery_person : null,
                                ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')],
                            ) !!}
                        </div>
                    </div>
                @endif

                @php
                    $custom_labels = json_decode(session('business.custom_labels'), true);

                    $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1'])
                        ? $custom_labels['shipping']['custom_field_1']
                        : '';

                    $is_shipping_custom_field_1_required =
                        !empty($custom_labels['shipping']['is_custom_field_1_required']) &&
                        $custom_labels['shipping']['is_custom_field_1_required'] == 1
                            ? true
                            : false;

                    $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2'])
                        ? $custom_labels['shipping']['custom_field_2']
                        : '';

                    $is_shipping_custom_field_2_required =
                        !empty($custom_labels['shipping']['is_custom_field_2_required']) &&
                        $custom_labels['shipping']['is_custom_field_2_required'] == 1
                            ? true
                            : false;

                    $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3'])
                        ? $custom_labels['shipping']['custom_field_3']
                        : '';

                    $is_shipping_custom_field_3_required =
                        !empty($custom_labels['shipping']['is_custom_field_3_required']) &&
                        $custom_labels['shipping']['is_custom_field_3_required'] == 1
                            ? true
                            : false;

                    $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4'])
                        ? $custom_labels['shipping']['custom_field_4']
                        : '';

                    $is_shipping_custom_field_4_required =
                        !empty($custom_labels['shipping']['is_custom_field_4_required']) &&
                        $custom_labels['shipping']['is_custom_field_4_required'] == 1
                            ? true
                            : false;

                    $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5'])
                        ? $custom_labels['shipping']['custom_field_5']
                        : '';

                    $is_shipping_custom_field_5_required =
                        !empty($custom_labels['shipping']['is_custom_field_5_required']) &&
                        $custom_labels['shipping']['is_custom_field_5_required'] == 1
                            ? true
                            : false;
                @endphp

                @if (!empty($shipping_custom_label_1))
                    @php
                        $label_1 = $shipping_custom_label_1 . ':';
                        if ($is_shipping_custom_field_1_required) {
                            $label_1 .= '*';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_1', $label_1) !!}
                            {!! Form::text(
                                'shipping_custom_field_1',
                                !empty($transaction->shipping_custom_field_1) ? $transaction->shipping_custom_field_1 : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => $shipping_custom_label_1,
                                    'required' => $is_shipping_custom_field_1_required,
                                ],
                            ) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_2))
                    @php
                        $label_2 = $shipping_custom_label_2 . ':';
                        if ($is_shipping_custom_field_2_required) {
                            $label_2 .= '*';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_2', $label_2) !!}
                            {!! Form::text(
                                'shipping_custom_field_2',
                                !empty($transaction->shipping_custom_field_2) ? $transaction->shipping_custom_field_2 : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => $shipping_custom_label_2,
                                    'required' => $is_shipping_custom_field_2_required,
                                ],
                            ) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_3))
                    @php
                        $label_3 = $shipping_custom_label_3 . ':';
                        if ($is_shipping_custom_field_3_required) {
                            $label_3 .= '*';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_3', $label_3) !!}
                            {!! Form::text(
                                'shipping_custom_field_3',
                                !empty($transaction->shipping_custom_field_3) ? $transaction->shipping_custom_field_3 : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => $shipping_custom_label_3,
                                    'required' => $is_shipping_custom_field_3_required,
                                ],
                            ) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_4))
                    @php
                        $label_4 = $shipping_custom_label_4 . ':';
                        if ($is_shipping_custom_field_4_required) {
                            $label_4 .= '*';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_4', $label_4) !!}
                            {!! Form::text(
                                'shipping_custom_field_4',
                                !empty($transaction->shipping_custom_field_4) ? $transaction->shipping_custom_field_4 : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => $shipping_custom_label_4,
                                    'required' => $is_shipping_custom_field_4_required,
                                ],
                            ) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_5))
                    @php
                        $label_5 = $shipping_custom_label_5 . ':';
                        if ($is_shipping_custom_field_5_required) {
                            $label_5 .= '*';
                        }
                    @endphp

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_5', $label_5) !!}
                            {!! Form::text(
                                'shipping_custom_field_5',
                                !empty($transaction->shipping_custom_field_5) ? $transaction->shipping_custom_field_5 : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => $shipping_custom_label_5,
                                    'required' => $is_shipping_custom_field_5_required,
                                ],
                            ) !!}
                        </div>
                    </div>
                @endif
                @if ($transaction->type == 'order')
                    <div id="tailorMasterAssignmentSection" class="col-md-12" @if(empty($transaction->delivery_status) || $transaction->delivery_status != 'preparing') style="display: none;" @endif>
                        @php
                            $grouped_sell_details = $sell_details->groupBy('cloth_id');
                            $index = 0;
                        @endphp
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
                                                                    type="number" min="1" max="{{ intval($total_qty) }}" value="1" required>
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
                                                                        'required' => 'required',
                                                                        'placeholder' => __('tailoring.select_tailoring_master')
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
                                                                            'required' => 'required',
                                                                            'placeholder' => __('tailoring.select_tailoring_master')
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
                                                <button type="button" class="btn btn-primary btn-sm add-assignment-row-btn" style="margin-bottom: 10px;"><i
                                                        class="fa fa-plus"></i></button>
                                            </td>
                                        </tr>
                                        @php
                                            $index++;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="clearfix"></div>
                @if ($transaction->type == 'order')
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('delivery_note', __('lang_v1.delivery_note') . ':') !!}
                            {!! Form::textarea('delivery_note', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang_v1.delivery_note'),
                                'rows' => '4',
                            ]) !!}
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('shipping_note', __('lang_v1.shipping_note') . ':') !!}
                            {!! Form::textarea('shipping_note', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang_v1.shipping_note'),
                                'rows' => '4',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fileupload">
                                @lang('lang_v1.shipping_documents'):
                            </label>
                            <div class="dropzone" id="shipping_documents_dropzone"></div>
                            {{-- params for media upload --}}
                            <input type="hidden" id="media_upload_url" value="{{ route('attach.medias.to.model') }}">
                            <input type="hidden" id="model_id" value="{{ $transaction->id }}">
                            <input type="hidden" id="model_type" value="App\Transaction">
                            <input type="hidden" id="model_media_type" value="shipping_document">
                        </div>
                    </div>
                    <div class="col-md-12">
                        @php
                            $medias = $transaction->media->where('model_media_type', 'shipping_document')->all();
                        @endphp
                        @include('sell.partials.media_table', ['medias' => $medias, 'delete' => true])
                    </div>
                @endif
            </div>
            @if (!empty($activities))
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
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $(document).ready(function() {
        var $commonTailoringMaster = $('#common_tailoring_master');

        function updateDisabledStates() {
            var commonValue = $commonTailoringMaster.val();
            var $innerTailoringMasters = $(".assignment-tailor-select");

            // Check if any individual tailor master is assigned
            var hasIndividualAssignments = false;
            $innerTailoringMasters.each(function() {
                if ($(this).val()) {
                    hasIndividualAssignments = true;
                    return false; // break
                }
            });

            // If top-level is assigned, disable all individual ones
            if (commonValue) {
                $innerTailoringMasters.each(function() {
                    $(this).prop('disabled', true).trigger('change.select2');
                });
                // Also set all individual values to the common value
                $innerTailoringMasters.each(function() {
                    $(this).val(commonValue).trigger('change');
                });
            } else {
                // If any individual assignment exists, disable top-level
                if (hasIndividualAssignments) {
                    $commonTailoringMaster.prop('disabled', true).trigger('change.select2');
                    $innerTailoringMasters.prop('disabled', false).trigger('change.select2');
                } else {
                    // Both can be enabled
                    $commonTailoringMaster.prop('disabled', false).trigger('change.select2');
                    $innerTailoringMasters.prop('disabled', false).trigger('change.select2');
                }
            }
        }

        function toggleTailoringMasters() {
            updateDisabledStates();
        }

        $commonTailoringMaster.on('change', function() {
            // Clear all individual selections if top-level is being assigned
            var commonValue = $commonTailoringMaster.val();
            if (commonValue) {
                var $innerTailoringMasters = $(".assignment-tailor-select");
                $innerTailoringMasters.each(function() {
                    $(this).val(commonValue).trigger('change');
                });
            }
            updateDisabledStates();
        });

        // Listen to changes on individual tailor selects
        $(document).on('change', '.assignment-tailor-select', function() {
            updateDisabledStates();
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
            var $modal = $('#edit_shipping_form').closest('.modal');
            $elements.each(function() {
                $(this).removeAttr('required');

                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
                $(this).select2({
                    dropdownParent: $modal.length ? $modal : $('#edit_shipping_form'),
                    width: '100%'
                });
            });
        }

        initSelect2($(".assignment-tailor-select"));
        updateDisabledStates();

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
            toggleTailoringMasters();
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
            updateDisabledStates();
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

            var $submitBtn = $('#edit_shipping_form').find('button[type="submit"]');
            $submitBtn.prop('disabled', false);
        }

        $(document).on('change keyup', '.assigned-qty-input', function() {
            validateAssignedQuantities();
        });

        $('#edit_shipping_form').on('submit', function(e) {
            var status = $('#edit_shipping_form #delivery_status').val();
            if (status !== 'preparing' && status !== 'ready_to_deliver') {
                return true;
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

                if (status === 'ready_to_deliver' && assigned_sum < total_qty) {
                    toastr.error(
                        `Total assigned quantity for "${cloth_name}" must be equal to ${total_qty} for Ready to Deliver.`
                    );
                    isValid = false;
                    return false;
                }

                if (!commonValue) {
                    var $tailorContainer = $(
                        `.tailor-select-container[data-cloth-index="${cloth_index}"]`);
                    $tailorContainer.find('.assignment-tailor-select').each(function() {
                        if (!$(this).val()) {
                            toastr.error(
                                `Please select a Tailor Master for "${cloth_name}".`
                            );
                            isValid = false;
                            return false;
                        }
                    });
                }

                if (!isValid) return false;
            });

            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });

        // toggleTailoringMasters();
        validateAssignedQuantities();

        var statusSubtitles = {
            'received': "{{ __('tailoring.received_subtitle') }}",
            'preparing': "{{ __('tailoring.preparing_subtitle') }}",
            'partially_delivered': "{{ __('tailoring.partially_delivered_subtitle') }}",
            'ready_to_deliver': "{{ __('tailoring.ready_to_deliver_subtitle') }}",
            'delivered': "{{ __('tailoring.delivered_subtitle') }}"
        };

        function updateSubtitle() {
            var status = $('#edit_shipping_form #delivery_status').val();
            var subtitleText = statusSubtitles[status] || '';
            if (subtitleText) {
                $('#delivery_status_subtitle').text(subtitleText).show();
            } else {
                $('#delivery_status_subtitle').hide();
            }
        }

        updateSubtitle();

        var previous_delivery_status = $('#edit_shipping_form #delivery_status').val();
        $(document).on('focus click', '#edit_shipping_form #delivery_status', function() {
            previous_delivery_status = $(this).val();
        });

        $(document).on('change', '#edit_shipping_form #delivery_status', function() {
            var status = $(this).val();
            
            if (status === 'ready_to_deliver') {
                var allAssigned = true;
                var commonValue = $('#common_tailoring_master').val();
                
                $('.assigned-qty-container').each(function() {
                    var cloth_index = $(this).attr('data-cloth-index');
                    var $row = $(this).closest('tr');
                    var total_qty = parseInt($row.find('td').eq(2).text().trim()) || 0;
                    
                    var assigned_sum = 0;
                    $(this).find('.assigned-qty-input').each(function() {
                        assigned_sum += parseInt($(this).val()) || 0;
                    });
                    
                    if (assigned_sum < total_qty) {
                        allAssigned = false;
                        return false;
                    }
                    
                    if (!commonValue) {
                        var $tailorContainer = $(`.tailor-select-container[data-cloth-index="${cloth_index}"]`);
                        $tailorContainer.find('.assignment-tailor-select').each(function() {
                            if (!$(this).val()) {
                                allAssigned = false;
                                return false;
                            }
                        });
                    }
                });

                if (!allAssigned) {
                    toastr.error("Cannot select 'Ready to Deliver' until all quantities are assigned to a Tailor Master.");
                    $(this).val(previous_delivery_status || 'preparing');
                    status = $(this).val(); // update status so subtitle and UI updates correctly
                }
            }

            previous_delivery_status = status;
            updateSubtitle();

            if (status === 'delivered') {
                $('#deliveryPerson').show();
                $('#tailoringMaster').hide();
                $('#tailorMasterAssignmentSection').hide();
            } else if (status === 'preparing') {
                $('#deliveryPerson').hide();
                $('#tailoringMaster').show();
                $('#tailorMasterAssignmentSection').show();
                initSelect2($(".assignment-tailor-select"));
                initSelect2($("#common_tailoring_master"));
                updateDisabledStates();
            } else {
                $('#deliveryPerson').hide();
                $('#tailoringMaster').hide();
                $('#tailorMasterAssignmentSection').hide();
            }
        });
    });
</script>
