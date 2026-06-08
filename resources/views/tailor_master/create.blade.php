<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        @php
            $form_id = 'quick_add_tailor_form';
            $business_id = session('user.business_id');
            $tailor_master_role_id = \Spatie\Permission\Models\Role::where(
                'name',
                'Tailor Master#' . $business_id,
            )->value('id');
            $users = \App\User::forDropdown($business_id, true);
        @endphp
        {!! Form::open([
            'url' => action([\App\Http\Controllers\ManageUserController::class, 'store']),
            'method' => 'post',
            'id' => $form_id,
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('lang_v1.add_tailor_master')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('contact_id', __('lang_v1.contact_id') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-id-badge"></i>
                            </span>
                            {!! Form::text('contact_id', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.contact_id')]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('assigned_to_users', __('lang_v1.assigned_user') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('assigned_to_users[]', $users, null, [
                                'class' => 'form-control select2',
                                'id' => 'assigned_to_users',
                                'multiple',
                                'style' => 'width: 100%;',
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('first_name', __('tailoring.name') . ':*') !!}
                        {!! Form::text('first_name', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('tailoring.name'),
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('contact_number', __('contact.mobile') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </span>
                            {!! Form::text('contact_number', null, [
                                'class' => 'form-control',
                                'required',
                                'maxlength' => 11,
                                'pattern' => '[0-9]{11}',
                                'placeholder' => __('contact.mobile'),
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::hidden('role', $tailor_master_role_id) !!}
            {!! Form::hidden('user_type', 'user') !!}
            {!! Form::hidden('allow_login', 0) !!}
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.save')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div>
</div>
