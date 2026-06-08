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
                            href="#" data-toggle="modal" data-target="#quick_add_tailor_modal">
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
                    <table class="table table-bordered table-striped" id="users_table">
                        <thead>
                            <tr>
                                <th>@lang('tailoring.id')</th>
                                <th>@lang('tailoring.name')</th>
                                <th>@lang('tailoring.mobile')</th>
                                <th>@lang('tailoring.added_on')</th>
                                <th>@lang('tailoring.total_completed_orders')</th>
                                <th>@lang('tailoring.total_wages')</th>
                                <th>@lang('tailoring.total_wages_paid')</th>
                                <th>@lang('tailoring.total_wages_due')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        @endcomponent

        <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

        <!-- Quick Add Tailor Master Modal -->
        <div id="quick_add_tailor_modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="quickAddTailorLabel">
            @include('tailor_master.create')
        </div>

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        //Roles table
        $(document).ready(function() {
            /* var users_table = $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: '/tailor-master/list',
                columnDefs: [{
                    "targets": [4],
                    "orderable": false,
                    "searchable": false
                }],
                "columns": [{
                        "data": "username"
                    },
                    {
                        "data": "full_name"
                    },
                    {
                        "data": "role"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "action"
                    }
                ]
            }); */
            $(document).on('click', 'button.delete_user_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_user,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();
                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    // users_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
