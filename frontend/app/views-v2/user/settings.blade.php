
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">[[ Lang::get('keywords.settings') ]]</h4>
</div>

<div class="modal-body">
    <div class="settings-page">
        <ul class="nav nav-tabs nav-tabs-margin" role="tablist">
            <li class="active"><a href="#language" ng-click="$event.preventDefault()" role="tab" data-toggle="tab">[[ Lang::get('messages.user.settings.language_label') ]]</a></li>
            <li><a href="#client" role="tab" data-toggle="tab" ng-click="getTabContent('client'); $event.preventDefault()">[[ Lang::get('messages.user.settings.client_label') ]]</a></li>
            <li><a href="#import" ng-click="$event.preventDefault()" role="tab" data-toggle="tab">[[ Lang::get('messages.user.settings.import_slash_export') ]]</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="language">
                @include('user/settings/language', array('settings' => $settings, 'languages' => $languages))
            </div>
            <div class="tab-pane fade" id="client">
                [[--@include('user/settings/client', array())--]]
                <div ng-bind-html="tabs.client.content"></div>
                <div ng-hide="tabs.client.isLoaded"><h3>Loading...</h3></div>
            </div>
            <div class="tab-pane fade" id="import">
                @include('user/settings/import', array())
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancel()">[[ Lang::get('keywords.close') ]]</button>
</div>
