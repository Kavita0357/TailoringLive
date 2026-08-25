@extends('layouts.app')
@section('title', __('tailoring.tailor_master_list'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('tailoring.tailor_master_list')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('tailoring.all_tailor_masters')])
            @can('user.create')
                @slot('tool')
                    <div class="box-tools">
                        <a id="open_quick_add_tailor"
                            class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full"
                            href="#" data-toggle="modal" data-target="#tailor_master_add_form">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg> @lang('messages.add')
                        </a>
                    </div>
                @endslot
            @endcan
            @can('user.view')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tailor_masters_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>@lang('tailoring.id')</th>
                                <th>@lang('tailoring.name')</th>
                                <th>@lang('tailoring.mobile')</th>
                                <th>@lang('tailoring.added_on')</th>
                                <th>@lang('tailoring.total_completed_cloths')</th>
                                <th>@lang('tailoring.total_wages')</th>
                                <th>@lang('tailoring.total_wages_paid')</th>
                                <th>@lang('tailoring.total_wages_due')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        @endcomponent

        <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <!-- Quick Add Tailor Master Modal -->
        <div id="tailor_master_add_form" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="quickAddTailorLabel">
            @include('tailor_master.create')
        </div>

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            @can('user.view')
                var tailor_masters_table = $('#tailor_masters_table').DataTable({
                    processing: true,
                    serverSide: true,
                    fixedHeader: false,
                    ajax: '/tailor-master/list',
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                        targets: [0],
                        orderable: false,
                        searchable: false
                    }],
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            data: 'added_on',
                            name: 'added_on'
                        },
                        {
                            data: 'total_completed_orders',
                            name: 'total_completed_orders'
                        },
                        {
                            data: 'total_wages',
                            name: 'total_wages'
                        },
                        {
                            data: 'total_wages_paid',
                            name: 'total_wages_paid'
                        },
                        {
                            data: 'total_wages_due',
                            name: 'total_wages_due'
                        }
                    ]
                });
            @endcan

            $(document).on('change', '#assigned_to_users', function() {
                var user_id = $(this).val();

                if (user_id != '') {
                    $.ajax({
                        url: '/user-details/' + user_id,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                $('#contact_number').val(response.mobile);
                            }
                        }
                    });
                }
            });

            $(document).on('submit', 'form#tailor_master_edit_form', function(e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();
                $.ajax({
                    method: "POST",
                    url: form.attr('action'),
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('.user_modal').modal('hide');
                            toastr.success(result.msg);
                            if (typeof tailor_masters_table !== 'undefined') {
                                tailor_masters_table.ajax.reload();
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('click', '.delete_user_button', function() {
                var delete_button = $(this);
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_user,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "DELETE",
                            url: delete_button.data('href'),
                            dataType: "json",
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    if (typeof tailor_masters_table !== 'undefined') {
                                        tailor_masters_table.ajax.reload();
                                    }
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.update_tailor_status', function(e) {
                e.preventDefault();
                var status_button = $(this);
                $.ajax({
                    method: "POST",
                    url: status_button.attr('href'),
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            if (typeof tailor_masters_table !== 'undefined') {
                                tailor_masters_table.ajax.reload();
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            $(document).on('shown.bs.modal', function(e) {
                var $modal = $(e.target);

                var $select = $modal.find('.assigned_to_users');

                if ($select.length) {
                    if ($select.data('select2')) {
                        $select.select2('destroy');
                    }

                    $select.select2({
                        width: '100%',
                        dropdownParent: $modal
                    });
                }

                var $checkbox = $modal.find('#show_work_history_edit');

                if ($checkbox.length) {
                    $checkbox.iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue'
                    });
                    $checkbox.val() == "1" ?
                        $checkbox.iCheck('check') :
                        $checkbox.iCheck('uncheck');
                }
            });

            @if ($errors->any())
                $('#tailor_master_add_form').modal('show');
            @endif
        });
    </script>
@endsection
