<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">[[Lang::get('keywords.users')]]</h4>
</div>

<div class="modal-body">

	<table class="table">
		<tr>
			<th>[[Lang::get('keywords.id')]]</th>
			<th>[[Lang::get('keywords.email_address')]]</th>
			<th>[[Lang::get('keywords.first_name')]]</th>
			<th>[[Lang::get('keywords.last_name')]]</th>
			<th>[[Lang::get('keywords.admin_status')]]</th>
			<th>[[Lang::get('keywords.created_at')]]</th>
			<th>[[Lang::get('keywords.updated_at')]]</th>
			<th>[[Lang::get('keywords.deleted_at')]]</th>
		</tr>
		@foreach($users as $user)
			<tr>
				<td>[[$user->id]]</td>
				<td>[[$user->username]]</td>
				<td>[[$user->firstname]]</td>
				<td>[[$user->lastname]]</td>
				<td class="text-center">
					@if ($user->is_admin)
						<i class="fa fa-check"></i>
					@endif
				</td>
				<td>[[$user->created_at]]</td>
				<td>[[$user->updated_at]]</td>
				<td>[[$user->deleted_at]]</td>
			</tr>
		@endforeach
	</table>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancel()">[[ Lang::get('keywords.close') ]]</button>
</div>