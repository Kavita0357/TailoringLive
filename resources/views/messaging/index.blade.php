@extends('layouts.app')

@section('title', 'SMS Log')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">SMS Log</h1>
    </section>

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
                                <th>Cost</th>
                                <th>Sent At</th>
                                <!-- <th>Sent By</th> -->
                                <!-- <th>@lang('messages.action')</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sms_logs as $log)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>
                                    <td>{{ $log->sender_id }}</td>
                                    <td>{{ $log->recipient_number }}</td>
                                    <td>
                                        <span title="{{ $log->message }}">
                                            {{ Str::limit($log->message, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="label label-{{ $log->status == 'sent' ? 'success' : ($log->status == 'pending' ? 'warning' : 'default') }}">
                                            {{ ucfirst($log->status) }}
                                        </span>
                                    </td>
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
            // For now, just show a simple alert. In a real implementation, you might fetch details via AJAX
            alert('SMS Log ID: ' + id + '\n\nFeature to show full details can be implemented later.');
        }

        $(document).ready(function () {
            $('#sms_log_table').DataTable({
                "order": [[0, "desc"]],
                "pageLength": 25
            });
        });
    </script>
@endsection