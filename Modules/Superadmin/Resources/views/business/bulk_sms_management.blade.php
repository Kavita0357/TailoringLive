@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.bulk_sms_management'))

@section('content')
    @include('superadmin::layouts.nav')

    <section class="content-header">
        <h1>@lang('superadmin::lang.bulk_sms_management')
            <small>@lang('superadmin::lang.manage_business_bulk_sms')</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-white">
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('superadmin::lang.sms_provider')</span>
                        <span class="info-box-number">BulkSMSBD</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-white">
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('superadmin::lang.total_balance')</span>
                        <span class="info-box-number">{{ $sms_balance['balance'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-white">
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('superadmin::lang.remaining_transferable_balance')</span>
                        <span class="info-box-number">{{ $superadmin_remaining_balance ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="bulk_sms_management_table">
                        <thead>
                            <tr>
                                <th>@lang('superadmin::lang.registered_on')</th>
                                <th>@lang('superadmin::lang.business_name')</th>
                                <th>@lang('business.owner')</th>
                                <th>@lang('business.email')</th>
                                <!-- <th>@lang('superadmin::lang.owner_number')</th> -->
                                <th>@lang('superadmin::lang.business_contact_number')</th>
                                <!-- <th>@lang('business.address')</th> -->
                                <th>@lang('sale.status')</th>
                                <!-- <th>@lang('superadmin::lang.current_subscription')</th> -->
                                <th>@lang('business.created_by')</th>
                                <th>@lang('superadmin::lang.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            bulk_sms_management_table = $('#bulk_sms_management_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']) }}",
                    data: function (d) {
                        d.bulk_sms_page = 1;
                    },
                },
                aaSorting: [[0, 'desc']],
                columns: [
                    { data: 'created_at', name: 'business.created_at' },
                    { data: 'name', name: 'business.name' },
                    { data: 'owner_name', name: 'owner_name', searchable: false },
                    { data: 'owner_email', name: 'u.email' },
                    // { data: 'contact_number', name: 'u.contact_number' },
                    { data: 'business_contact_number', name: 'business_contact_number' },
                    // { data: 'address', name: 'address' },
                    { data: 'is_active', name: 'is_active', searchable: false },
                    // { data: 'current_subscription', name: 'p.name' },
                    { data: 'biz_creator', name: 'biz_creator', searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });

        $(document).on('submit', '#superadmin_transfer_sms_balance', function (e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let formData = form.serialize();

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function (response) {
                    alert('SMS balance transferred successfully');
                    $('.modal').modal('hide');
                    bulk_sms_management_table.ajax.reload();
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        let msg = '';
                        $.each(errors, function (key, value) {
                            msg += value[0] + '\n';
                        });
                        alert(msg);
                    } else {
                        alert('Something went wrong');
                    }
                }
            });
        });
    </script>
@endsection