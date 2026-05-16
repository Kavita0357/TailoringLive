<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('superadmin::lang.balance_history') - {{ $business->name }}</h4>
        </div>

        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>@lang('account.from')</th>
                            <th>@lang('account.to')</th>
                            <th>@lang('sale.amount')</th>
                            <th>@lang('superadmin::lang.is_reversed')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $record)
                            <tr>
                                <td>{{ @format_datetime($record->created_at) }}</td>
                                <td>TailorDesk SMS</td>
                                <td>{{ trim(optional($record->transferredToUser)->surname . ' ' . optional($record->transferredToUser)->first_name . ' ' . optional($record->transferredToUser)->last_name) ?: '-' }}
                                </td>
                                <td class="{{ $record->is_reversed ? 'text-danger' : '' }}">{{ $record->amount }}</td>
                                <td>{{ $record->is_reversed ? 'Yes' : 'No' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">@lang('superadmin::lang.no_history_found')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            @if($history->isNotEmpty())
                <button type="button" id="reverse_transfer" class="btn btn-danger" data-business-id="{{ $business->id }}"
                    data-url="{{ action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'reverseSMSBalanceTransfer']) }}"
                    @if(!empty($disable_reverse)) disabled @endif>@lang('messages.reverse_transfer')</button>
            @endif
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->