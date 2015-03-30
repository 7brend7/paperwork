[[ Form::open(array('id' => 'form-import', 'class' => 'form', 'role' => 'form', 'files' => true)) ]]
	<div class="form-group">
		<label for="exampleInputFile">[[ Lang::get('messages.user.settings.import.evernotexml') ]]</label>
		[[--[[ Form::file('enex'); ]]--]]
		<input type="file" class="filestyle" data-buttontext="Find file" id="enex" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">

		<div class="input-group">
			<input type="text" class="form-control " disabled="" id="enexPlaceholder">
			<span class="input-group-btn" tabindex="0">
				<label for="enex" class="btn btn-default ">
					<span class="fa fa-folder-open"></span> Find file
				</label>
				<button type="button" id="submit-import" class="btn btn-primary" ng-click="submitImport()">[[ Lang::get('keywords.import') ]]</button>
			</span>
		</div>
		<p class="help-block">[[ Lang::get('messages.user.settings.import.upload_evernotexml') ]]</p>
	</div>
[[ Form::close() ]]
	<hr>
[[ Form::open(array('id' => 'form-export', 'class' => 'form', 'role' => 'form', 'action' => 'UserController@export'))]]
    <div class="form-group">
        <label class="control-label">
            [[ Lang::get('messages.user.settings.export.evernotexml') ]] ([[ Lang::get('keywords.experimental') ]])
        </label>
        <p class="help-block">[[ Lang::get('messages.user.settings.export.download_evernotexml') ]]</p>
		[[ Form::submit(Lang::get('keywords.export'), array('id' => 'submit-export', 'class' => 'btn btn-primary')) ]]
    </div>
[[ Form::close() ]]