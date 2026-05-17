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
        <div
            class="tw-grid tw-grid-cols-1 tw-gap-4 tw-mt-6 sm:tw-grid-cols-2 xl:tw-grid-cols-4 tw-pb-6 sm:tw-gap-5 order-summary">
            <div
                class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                <div class="tw-p-4 sm:tw-p-5">
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <div class="tw-flex-1 tw-min-w-0">
                            <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                @lang('superadmin::lang.sms_provider')
                            </p>
                            <p
                                class="total_order tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                BulkSMSBD
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                <div class="tw-p-4 sm:tw-p-5">
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <div class="tw-flex-1 tw-min-w-0">
                            <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                @lang('superadmin::lang.total_balance')
                            </p>
                            <p
                                class="total_order tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                {{ $sms_balance['balance'] ?? 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
                <div class="tw-p-4 sm:tw-p-5">
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <div class="tw-flex-1 tw-min-w-0">
                            <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
                                @lang('superadmin::lang.remaining_transferable_balance')
                            </p>
                            <p
                                class="total_order tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
                                {{ $superadmin_remaining_balance ?? 0 }}
                            </p>
                        </div>
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
                                <!-- <th>@lang('business.email')</th> -->
                                <th>@lang('superadmin::lang.available_balance')</th>
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
                    //{ data: 'owner_email', name: 'u.email' },
                    { data: 'remaining_sms_balance', name: 'business.remaining_sms_balance' },
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
                    window.location.reload();
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