@extends('layouts.app')
@section('title', __('tailoring.style'))

@section('content')

    <style type="text/css">
        .designs-col {
            display: flex;
            flex-wrap: wrap
        }

        .designs-col img {
            object-fit: cover;
            border-radius: 5px;
            margin: 5px;
            width: 80px;
            height: 50px;
        }

        .designs-col .design-data {
            display: inline-block;
            text-align: center;
            margin: 0 5px;
        }
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('tailoring.style')
            <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang('tailoring.manage_style')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary'])
            @slot('tool')
                <div class="box-tools">
                    <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full btn-modal"
                        data-container=".style_modal"
                        data-href="{{ action([\App\Http\Controllers\StyleController::class, 'create']) }}">
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
                <table class="table table-bordered table-striped" id="style_table">
                    <thead>
                        <tr>
                            <th>@lang('tailoring.style_name')</th>
                            <th>@lang('tailoring.serial_no')</th>
                            <th>@lang('tailoring.designs')</th>
                            <th>@lang('tailoring.cloths')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcomponent
        <div class="modal fade style_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            //Style table
            var style_table = $('#style_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: true,
                ajax: '/styles',
                order: [
                    [1, 'asc']
                ],
                columns: [{
                        data: 'style_name',
                        name: 'style_name'
                    },
                    {
                        data: 'serial_no',
                        name: 'serial_no',
                        visible: false
                    },
                    {
                        data: 'designs',
                        name: 'designs'
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
                    }
                ],
                columnDefs: [{
                    targets: 2,
                    className: 'designs-col'
                }]
            });


            /* Start CRUD of Style */
            $(document).on('submit', 'form#style_add_form', function(e) {
                e.preventDefault();

                var form = $(this)[0]; // Get raw form element
                var formData = new FormData(form); // Create FormData for file uploads

                $.ajax({
                    method: 'POST',
                    url: $(form).attr('action'),
                    dataType: 'json',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Let browser set it, important for multipart/form-data
                    beforeSend: function(xhr) {
                        __disable_submit_button($(form).find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('div.style_modal').modal('hide');
                            toastr.success(result.msg);
                            if (typeof style_table !== 'undefined') {
                                style_table.ajax.reload();
                            }
                            var evt = new CustomEvent("styleAdded", {
                                detail: result.data
                            });
                            window.dispatchEvent(evt);
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });


            $(document).on('click', 'button.edit_style_button', function() {
                $('div.style_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    $('form#style_edit_form').submit(function(e) {
                        e.preventDefault();

                        var form = $(this)[0]; // Get raw form element
                        var formData = new FormData(
                            form); // Create FormData for file uploads

                        $.ajax({
                            method: 'POST',
                            url: $(form).attr('action'),
                            dataType: 'json',
                            data: formData,
                            processData: false, // Don't process the data
                            contentType: false, // Let browser set it, important for multipart/form-data
                            beforeSend: function(xhr) {
                                __disable_submit_button($(form).find(
                                    'button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.style_modal').modal('hide');
                                    toastr.success(result.msg);
                                    if (typeof style_table !== 'undefined') {
                                        style_table.ajax.reload();
                                    }
                                    var evt = new CustomEvent("styleAdded", {
                                        detail: result.data
                                    });
                                    window.dispatchEvent(evt);
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_style_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_style,
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
                                    style_table.ajax.reload();
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
