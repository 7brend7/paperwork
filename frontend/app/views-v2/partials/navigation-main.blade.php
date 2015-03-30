<div class="dropdown user-menu">
	<button class="btn btn-default dropdown-toggle" type="button" id="userMenuDropdown" data-toggle="dropdown" aria-expanded="true">
		[[ $username ]]
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="userMenuDropdown" ng-controller="UserMenuController">
		[[--<li><a href="[[ URL::route("/") ]]"><i class="fa fa-book"></i> [[Lang::get('keywords.library')]]</a></li>--]]
		<li><a ng-click="showModal('profile', 'ProfileController')"><i class="fa fa-user"></i> [[Lang::get('keywords.profile')]]</a></li>
		<li><a ng-click="showModal('settings', 'UserSettingsController')"><i class="fa fa-cog"></i> [[Lang::get('keywords.settings')]]</a></li>
		@if (Auth::user() && Auth::user()->isAdmin())
			<li><a ng-click="showModal('admin', 'AdminConsoleController', 'lg')"><i class="fa fa-star"></i> [[Lang::get('keywords.admin_area')]]</a></li>
		@endif

		<li><a ng-click="showModal('help', 'HelpController')"><i class="fa fa-question"></i> [[Lang::get('keywords.help')]]</a></li>
		<li><a href="[[ URL::route("user/logout") ]]"><i class="fa fa-sign-out"></i> [[Lang::get('keywords.sign_out')]]</a></li>
	</ul>
</div>