
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">[[ Lang::get('keywords.profile') ]]: [[ $user->username ]]</h4>
</div>

<div class="modal-body">

    <div class="profile-page">
        [[ Form::open(array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'profileForm')) ]]

        <div class="form-group [[ $errors->first('firstname') ? 'has-error' : '' ]]">
            <label for="firstname" class="col-sm-3 control-label">[[ Lang::get('keywords.first_name') ]]</label>

            <div class="col-sm-9">
                [[ Form::text("firstname", $user->firstname, array('id' => 'firstname', 'class' => 'form-control', 'placeholder' => Lang::get('keywords.first_name'), 'required')) ]]
            </div>
        </div>
        <div class="form-group [[ $errors->first('lastname') ? 'has-error' : '' ]]">
            <label for="lastname" class="col-sm-3 control-label">[[ Lang::get('keywords.last_name') ]]</label>

            <div class="col-sm-9">
                [[ Form::text("lastname", $user->lastname, array('id' => 'lastname', 'class' => 'form-control',
                'placeholder' => Lang::get('keywords.last_name'), 'required')) ]]
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <div>
                    [[ Lang::get('users.profile_change_password_info') ]]
                </div>
            </div>
        </div>

        <div class="form-group [[ $errors->first('password') ? 'has-error' : '' ]]">
            <label for="password" class="col-sm-3 control-label">[[ Lang::get('keywords.password') ]]</label>

            <div class="col-sm-9">
                [[ Form::password("password", array('id' => 'password', 'class' => 'form-control', 'placeholder' => Lang::get('keywords.password'))) ]]
            </div>
        </div>
        <div class="form-group [[ $errors->first('password_confirmation') ? 'has-error' : '' ]]">
            <label for="password_confirmation" class="col-sm-3 control-label">[[ Lang::get('keywords.confirm')
                ]]</label>

            <div class="col-sm-9">
                [[ Form::password("password_confirmation", array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => Lang::get('keywords.confirm'))) ]]
            </div>
        </div>
        [[ Form::close() ]]
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn btn-primary" data-dismiss="modal" ng-click="submit()">[[ Lang::get('keywords.save') ]]</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancel()">[[ Lang::get('keywords.cancel') ]]</button>
</div>
