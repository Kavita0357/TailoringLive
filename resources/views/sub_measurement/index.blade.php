@extends('layouts.app')
@section('title', __('tailoring.sub_measurements'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('tailoring.sub_measurements')
            <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang('tailoring.manage_sub_measurements')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary'])
            @slot('tool')
                <div class="box-tools">
                    <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full btn-modal"
                        data-container=".sub_measurement_modal"
                        data-href="{{ action([\App\Http\Controllers\SubMeasurementController::class, 'create']) }}">
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
                <table class="table table-bordered table-striped" id="sub_measurement_table">
                    <thead>
                        <tr>
                            <th>@lang('tailoring.sub_measurement_name')</th>
                            {{-- <th>@lang('tailoring.serial_no')</th> --}}
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent
        <div class="modal fade sub_measurement_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            //Sub measurements table
            var sub_measurement_table = $('#sub_measurement_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: '/sub-measurements',
                columnDefs: [{
                    targets: 1,
                    orderable: false,
                    searchable: false,
                }, ],
            });

            /* Start CRUD of Sub measurement */
            $(document).on('submit', 'form#sub_measurement_add_form', function(e) {
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
                            $('div.sub_measurement_modal').modal('hide');
                            toastr.success(result.msg);
                            if (typeof sub_measurement_table !== 'undefined') {
                                sub_measurement_table.ajax.reload();
                            }
                            var evt = new CustomEvent("submeasurementAdded", {
                                detail: result.data
                            });
                            window.dispatchEvent(evt);
                            //event can be listened as
                            //window.addEventListener("submeasurementAdded", function(evt) {}

                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });            

            $(document).on('click', 'button.edit_sub_measurement_button', function() {
                $('div.sub_measurement_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    $('form#sub_measurement_edit_form').submit(function(e) {
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
                                    $('div.sub_measurement_modal').modal(
                                    'hide');
                                    toastr.success(result.msg);
                                    sub_measurement_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_sub_measurement_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_sub_measurement,
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
                                    sub_measurement_table.ajax.reload();
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