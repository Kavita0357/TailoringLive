@extends('layouts.app')
@section('title', __('tailoring.cloths'))

@section('content')
    <style type="text/css">
        .img-col img {
            object-fit: cover;
            border-radius: 5px;
            margin: 2px;
            max-width: 100px;
            height: 100px;
        }
    </style>

    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('tailoring.cloths')
            <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang('tailoring.manage_cloths')</small>
        </h1>
    </section>

    <section class="content">
        @component('components.widget', ['class' => 'box-primary'])
            @slot('tool')
                <div class="box-tools">
                    <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full btn-modal"
                        data-container=".cloth_modal"
                        data-href="{{ action([\App\Http\Controllers\ClothController::class, 'create']) }}">
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
                <table class="table table-bordered table-striped" id="cloth_table">
                    <thead>
                        <tr>
                            <th>@lang('tailoring.cloth_name')</th>
                            <th>@lang('tailoring.cloth_image')</th>
                            <th>@lang('tailoring.serial_no')</th>
                            <th>@lang('tailoring.wages')</th>
                            <th>@lang('tailoring.measurements')</th>
                            <th>@lang('tailoring.style')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent

        <div class="modal fade cloth_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    </section>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            var cloth_table = $('#cloth_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: '/cloths',
                order: [
                    [2, 'asc']
                ],
                columns: [{
                        data: 'cloth_name',
                        name: 'cloth_name'
                    },
                    {
                        data: 'cloth_image',
                        name: 'cloth_image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'serial_no',
                        name: 'serial_no'
                    },
                    {
                        data: 'wages',
                        name: 'wages'
                    },
                    {
                        data: 'measurements',
                        name: 'measurements'
                    },
                    {
                        data: 'styles',
                        name: 'styles'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: 1, // image column
                    className: 'img-col'
                }]
            });

            $(document).on('click', '.btn-modal', function(e) {
                e.preventDefault();

                var container = $(this).data('container');
                var url = $(this).data('href');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(result) {
                        if (typeof result === 'object' && result.success === false) {
                            $(container).modal('hide');
                            toastr.error(result.msg);
                            return;
                        }
                        $(container).html(result).modal('show');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            toastr.error(xhr.responseJSON.msg);
                        } else {
                            toastr.error('Something went wrong');
                        }
                    }
                });
            });

            // ADD
            $(document).on('submit', 'form#cloth_add_form', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $.ajax({
                    method: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success) {
                            $('div.cloth_modal').modal('hide');
                            toastr.success(result.msg);
                            cloth_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                            form.find('button[type="submit"]').removeAttr('disabled');
                        }
                    },
                });
            });

            // EDIT
            $(document).on('click', 'button.edit_cloth_button', function() {
                $('div.cloth_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    $('form#cloth_edit_form').submit(function(e) {
                        e.preventDefault();
                        let form = $(this);
                        let formData = new FormData(this);
                        $.ajax({
                            method: 'POST',
                            url: form.attr('action'),
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                __disable_submit_button(form.find(
                                    'button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.success) {
                                    $('div.cloth_modal').modal('hide');
                                    toastr.success(result.msg);
                                    cloth_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                    form.find('button[type="submit"]')
                                        .removeAttr('disabled');
                                }
                            },
                        });
                    });
                });
            });

            // DELETE
            $(document).on('click', 'button.delete_cloth_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_cloth ??
                        "Are you sure you want to delete this cloth?",
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        $.ajax({
                            method: 'DELETE',
                            url: $(this).data('href'),
                            dataType: 'json',
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);
                                    cloth_table.ajax.reload();
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
