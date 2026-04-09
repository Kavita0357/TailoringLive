@extends('layouts.app')

@section('title', __('tailoring.messaging'))

@section('content')

    <section class="content-header">
        <h1>
            @lang('tailoring.messaging')
            <small>@lang('tailoring.send_sms')</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-md-8">

                <div class="box box-solid">
                    <div class="box-body">

                        <form method="POST" id="smsForm"
                            action="{{ action([\App\Http\Controllers\MessagingController::class, 'sendSms']) }}">
                            @csrf

                            <!-- Sender ID -->
                            <div class="form-group">
                                <label>@lang('tailoring.sender_id')</label>
                                <input type="text" name="sender_id" class="form-control" value="8809617624366">
                            </div>

                            <!-- Duplicate Check -->
                            <div class="form-group">
                                <label>@lang('tailoring.duplicate_check')</label><br>
                                <input type="checkbox" checked>
                            </div>

                            <!-- Recipients -->
                            <div class="form-group">
                                <label>@lang('tailoring.recipients')</label>
                                {!! Form::select(
                                    'recipients[]',
                                    [
                                        'all_customers' => 'All Customers',
                                        'all_suppliers' => 'All Suppliers',
                                    ] +
                                        $customers->toArray() +
                                        $suppliers->toArray(),
                                    null,
                                    [
                                        'class' => 'form-control mousetrap select2',
                                        'id' => 'recipients',
                                        'required',
                                        'multiple',
                                    ],
                                ) !!}
                            </div>

                            <!-- Message + Stats -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>@lang('tailoring.message')</label>
                                        <textarea id="message" name="message" rows="6" class="form-control"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4">
                                    <div class="well">
                                        <p><strong>@lang('tailoring.encoding'):</strong> GSM_7BIT_EX</p>
                                        <p>@lang('tailoring.character_count'): <span id="char_count">0</span></p>
                                        <p>@lang('tailoring.sms_parts'): <span id="sms_parts">0</span></p>
                                        <p>@lang('tailoring.remaining'): <span id="remaining">160</span></p>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Buttons -->
                            <div class="form-group">
                                <button type="button" class="btn btn-info">
                                    <i class="fa fa-save"></i> @lang('tailoring.save_draft')
                                </button>

                                <button type="button" class="btn btn-warning">
                                    <i class="fa fa-trash"></i> @lang('tailoring.delete')
                                </button>
                            </div>

                            <!-- Schedule -->
                            <div class="form-group">
                                <label>@lang('tailoring.schedule_sms')</label><br>

                                <label>
                                    <input type="radio" name="schedule_type" value="now" checked>
                                    @lang('tailoring.send_now')
                                </label>

                                <label style="margin-left:20px;">
                                    <input type="radio" name="schedule_type" value="later">
                                    @lang('tailoring.send_later')
                                </label>
                            </div>

                            <div class="form-group">
                                <label>@lang('tailoring.schedule_time')</label>
                                <input type="datetime-local" name="schedule_time" class="form-control">
                            </div>

                            <!-- Footer Buttons -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('tailoring.send_sms')</button>
                                <button type="reset" class="btn btn-danger">@lang('tailoring.cancel')</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-4">
                @if (isset($sms_balance['balance']))
                    <div class="box box-solid">
                        <div class="box-header">
                            <h4>@lang('tailoring.my_account')</h4>
                        </div>
                        <div class="box-body">
                            <p>
                                <strong>@lang('tailoring.acc_balance'):</strong> {{ $sms_balance['balance'] }}
                            </p>
                            {{-- <p>
                            <strong>@lang('tailoring.balance_validity'):</strong> 18-Oct-2026
                        </p> --}}
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </section>

@endsection


@section('javascript')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#smsForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let url = form.attr('action');
                let btn = form.find('button[type="submit"]');
                btn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),

                    success: function(response) {
                        if (response.success) {
                            form[0].reset();
                            $('#recipients').val(null).trigger('change');
                            toastr.success(response?.msg);
                        } else {
                            toastr.error(response?.msg);
                            // alert('Something went wrong ❌');
                        }
                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';

                            $.each(errors, function(key, value) {
                                msg += value[0] + "\n";
                            });

                            alert(msg);
                        } else {
                            alert('Server error ❌');
                        }
                    },

                    complete: function() {
                        btn.prop('disabled', false).text('Send SMS');
                    }
                });
            });

        });
        document.getElementById('message').addEventListener('input', function() {
            let text = this.value.length;

            document.getElementById('char_count').innerText = text;
            document.getElementById('remaining').innerText = 160 - text;

            let parts = Math.ceil(text / 160);
            document.getElementById('sms_parts').innerText = parts;
        });
    </script>

@endsection
