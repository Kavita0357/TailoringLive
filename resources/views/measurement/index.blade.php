@extends('layouts.app')
@section('title', __('tailoring.measurements'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('tailoring.measurements')
            <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang('tailoring.manage_measurements')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary'])
            @slot('tool')
                <div class="box-tools">
                    <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full btn-modal"
                        data-container=".measurement_modal"
                        data-href="{{ action([\App\Http\Controllers\MeasurementController::class, 'create']) }}">
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
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="measurement_table">
                    <thead>
                        <tr>
                            <th>@lang('tailoring.measurement_name')</th>
                            <th>@lang('tailoring.serial_no')</th>
                            <th>@lang('tailoring.sub_measurements')</th>
                            <th>@lang('tailoring.cloths')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent
        <div class="modal fade measurement_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            //Sub measurements table
            var measurement_table = $('#measurement_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: '/measurements',
                order: [
                    [1, 'asc']
                ],
                columns: [{
                        data: 'measurement_name',
                        name: 'measurement_name'
                    },
                    {
                        data: 'serial_no',
                        name: 'serial_no',
                        visible: false
                    },
                    {
                        data: 'sub_measurements',
                        name: 'sub_measurements'
                    },
                    {
                        data: 'cloth',
                        name: 'cloth',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            /* Start CRUD of Sub measurement */
            $(document).on('submit', 'form#measurement_add_form', function(e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('div.measurement_modal').modal('hide');
                            toastr.success(result.msg);
                            if (typeof measurement_table !== 'undefined') {
                                measurement_table.ajax.reload();
                            }
                            var evt = new CustomEvent("submeasurementAdded", {
                                detail: result.data
                            });
                            window.dispatchEvent(evt);
                            //event can be listened as
                            //window.addEventListener("submeasurementAdded", function(evt) {}

                        } else {
                            toastr.error(result.msg);
                            __enable_submit_button(form.find('button[type="submit"]'));
                        }
                    },
                });
            });

            $(document).on('click', 'button.edit_measurement_button', function() {
                $('div.measurement_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    $('form#measurement_edit_form').submit(function(e) {
                        e.preventDefault();
                        var form = $(this);
                        var data = form.serialize();
                        $.ajax({
                            method: 'POST',
                            url: $(this).attr('action'),
                            dataType: 'json',
                            data: data,
                            beforeSend: function(xhr) {
                                __disable_submit_button(form.find(
                                    'button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.measurement_modal').modal(
                                        'hide');
                                    toastr.success(result.msg);
                                    measurement_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_measurement_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_measurement,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    measurement_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
