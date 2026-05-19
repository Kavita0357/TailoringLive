@extends('layouts.app')

@section('title', 'SMS Log')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">SMS Log</h1>
</section>
<style type="text/css">
    .view-details-label-info span {
        background-color: #075a36 !important;
        color: #fff !important;
        cursor: pointer;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="sms_log_table">
                    <thead>
                        <tr>
                            <th>@lang('messages.date')</th>
                            <th>Sender ID</th>
                            <th>Recipient Number</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>SMS Type</th>
                            <th>Total Cost</th>
                            <th>Sent/Scheduled At</th>
                            <!-- <th>Sent By</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sms_logs as $log)
                        @php
                        $has_many = strpos($log->recipient_number, ',') !== false;
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ $log->sender_id }}</td>
                            <td>
                                {{
                                $has_many
                                ? 'Many'
                                : $log->recipient_number
                                }}
                            </td>
                            <td>
                                <span title="{{ $log->message }}">
                                    {{ Str::limit($log->message, 50) }}
                                </span>
                            </td>
                            <td class="{{ $log->status == 'Sent' && $has_many ? 'view-details-label-info' : '' }}"
                                data-log-id="{{ $log->id }}">
                                <span
                                    class="label label-{{ $log->status == 'Sent' ? 'success' : (($log->status == 'Pending' || $log->status == 'Scheduled') ? 'warning' : 'default') }}">
                                    {{ ucfirst($log->status == 'Sent' && $has_many ?
                                    __('superadmin::lang.view_Details') :$log->status) }}
                                </span>
                            </td>
                            <td>{{ $log->sms_type }}</td>
                            <td>{{ $log->cost ? '৳' . number_format($log->cost, 2) : '-' }}</td>
                            <td>
                                @if($log->sent_at)
                                {{ \Carbon\Carbon::parse($log->sent_at)->format('Y-m-d H:i') }}
                                @else
                                -
                                @endif
                            </td>
                            <!-- <td>{{ $log->sender ? $log->sender->name : 'N/A' }}</td> -->
                            <!-- <td>
                                                                                <button type="button" class="btn btn-xs btn-info" onclick="showDetails({{ $log->id }})">
                                                                                    <i class="fa fa-eye"></i> @lang('messages.view')
                                                                                </button>
                                                                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $sms_logs->links() }}
            </div>
            @endcomponent
        </div>
    </div>
</section>

<!-- Modal for SMS Details -->
<div class="modal fade" id="smsDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">SMS Details</h4>
            </div>
            <div class="modal-body" id="smsDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    function showDetails(id) {
        var url = '{{ url('messaging') }}/' + id;

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    $('#smsDetailsContent').html(result.html);
                    $('#smsDetailsModal').modal('show');
                } else {
                    $('#smsDetailsContent').html('<p class="text-danger">Unable to load SMS details.</p>');
                    $('#smsDetailsModal').modal('show');
                }
            },
            error: function (xhr) {
                var message = 'An error occurred while loading SMS details.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                $('#smsDetailsContent').html('<p class="text-danger">' + message + '</p>');
                $('#smsDetailsModal').modal('show');
            }
        });
    }

    $(document).ready(function () {
        $('#sms_log_table').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 25
        });
        $('#sms_log_table').on('click', '.view-details-label-info', function () {
            var logId = $(this).data('log-id');
            showDetails(logId);
        });
    });
</script>
@endsection