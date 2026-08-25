<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        {!! Form::open([
            'url' => action([\App\Http\Controllers\ManageUserController::class, 'updateTailorMaster'], [$tailor->id]),
            'method' => 'put',
            'id' => 'tailor_master_edit_form',
        ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang('lang_v1.edit_tailor_master')</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('contact_id', __('lang_v1.contact_id') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-id-badge"></i>
                            </span>
                            {!! Form::text('contact_id', $tailor->contact_id, [
                                'class' => 'form-control',
                                'placeholder' => __('lang_v1.contact_id'),
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('assigned_to_users', __('lang_v1.assigned_user') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('assigned_to_users_disabled', $users, $tailor->user_id, [
                                'class' => 'form-control assigned_to_users',
                                'id' => 'assigned_to_users_edit',
                                'style' => 'width: 100%;',
                                'disabled' => 'disabled',
                            ]) !!}
                            {!! Form::hidden('assigned_to_users', $tailor->user_id) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('show_work_history', 1, !empty($tailor->show_work_history), [
                                    'class' => 'input-icheck',
                                    'id' => 'show_work_history_edit',
                                ]) !!} @lang('lang_v1.show_work_history')
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('first_name', __('tailoring.name') . ':*') !!}
                        {!! Form::text('first_name', $tailor->name, [
                            'class' => 'form-control',
                            'id' => 'first_name_edit',
                            'required',
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('contact_number', __('contact.mobile') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </span>
                            {!! Form::text('contact_number', $tailor->mobile, [
                                'class' => 'form-control',
                                'id' => 'contact_number_edit',
                                'required',
                                'maxlength' => 11,
                                'pattern' => '[0-9]{11}',
                                'placeholder' => __('contact.mobile'),
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('messages.update')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.close')</button>
        </div>

        {!! Form::close() !!}

    </div>
</div>
