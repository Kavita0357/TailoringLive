<div class="sms-details-summary">
    <p><strong>Message:</strong> {!! nl2br(e($sms_log->message)) !!}</p>
    <p><strong>Sender ID:</strong> {{ $sms_log->sender_id }}</p>
    <p><strong>SMS Type:</strong> {{ $sms_log->sms_type }}</p>
    <p><strong>Status:</strong> {{ $sms_log->status }}</p>
    <p><strong>Total Cost:</strong> {{ $sms_log->cost ? '৳' . number_format($sms_log->cost, 2) : '-' }}</p>
    <p><strong>Sent At:</strong> {{ $sms_log->sent_at ? $sms_log->sent_at->format('Y-m-d H:i') : '-' }}</p>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Recipient Number</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sms_log->bulkSmsLogs as $bulk_log)
            <tr>
                <td>{{ $bulk_log->recipient_number }}</td>
                <td>{{ ucfirst($bulk_log->status) }}</td>
                <td>{{ $bulk_log->cost ? '৳' . number_format($bulk_log->cost, 2) : '-' }}</td>
                <td>{{ $bulk_log->sent_at ? $bulk_log->sent_at->format('Y-m-d H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No bulk SMS log records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>