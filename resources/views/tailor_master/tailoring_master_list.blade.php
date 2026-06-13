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
                    <table class="table table-bordered table-striped" id="users_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>@lang('tailoring.id')</th>
                                <th>@lang('tailoring.name')</th>
                                <th>@lang('tailoring.mobile')</th>
                                <th>@lang('tailoring.added_on')</th>
                                <th>@lang('tailoring.total_completed_orders')</th>
                                <th>@lang('tailoring.total_wages')</th>
                                <th>@lang('tailoring.total_wages_paid')</th>
                                <th>@lang('tailoring.total_wages_due')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tailor_masters as $tailor_master)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-info tw-w-max dropdown-toggle" 
                                                data-toggle="dropdown" aria-expanded="false">
                                                @lang('messages.actions')
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                                                        @lang('lang_v1.pay')
                                                    </a>
                                                </li>
                                                @can('user.view')
                                                    <li>
                                                        <a href="{{ action('App\Http\Controllers\ManageUserController@show', [$tailor_master->user_id]) }}">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                            @lang('messages.view')
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('user.update')
                                                    <li>
                                                        <a href="#" data-href="{{ action('App\Http\Controllers\ManageUserController@editTailorMaster', [$tailor_master->id]) }}" class="btn-modal" data-container=".user_modal">
                                                            <i class="glyphicon glyphicon-edit"></i>
                                                            @lang('messages.edit')
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('user.delete')
                                                    <li>
                                                        <a href="#" data-href="{{ action('App\Http\Controllers\ManageUserController@destroyTailorMaster', [$tailor_master->id]) }}" class="delete_user_button">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            @lang('messages.delete')
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('user.update')
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-power-off"></i>
                                                            @lang('messages.deactivate')
                                                        </a>
                                                    </li>
                                                @endcan
                                                <li class="divider"></li>
                                                @can('user.view')
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-scroll" aria-hidden="true"></i>
                                                            @lang('lang_v1.ledger')
                                                        </a>
                                                    </li>
                                                @endcan
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-cut" aria-hidden="true"></i>
                                                        @lang('tailoring.cloths_made')
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $tailor_master->contact_id ?? $tailor_master->id }}</td>
                                    <td>{{ $tailor_master->name }}</td>
                                    <td>{{ $tailor_master->mobile }}</td>
                                    <td>{{ $tailor_master->added_on }}</td>
                                    <td>{{ $tailor_master->total_completed_orders }}</td>
                                    <td>{{ $tailor_master->total_wages }}</td>
                                    <td>{{ $tailor_master->total_wages_paid }}</td>
                                    <td>{{ $tailor_master->total_wages_due }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endcan
        @endcomponent

        <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
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
        //Roles table
        $(document).ready(function() {
            var users_table = $('#users_table').DataTable({
                columnDefs: [{
                    "targets": [0],
                    "orderable": false,
                    "searchable": false
                }]
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
                            window.location.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

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
                                    window.location.reload();
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
