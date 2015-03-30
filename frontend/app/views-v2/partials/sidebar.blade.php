<ul class="list-unstyled">
    <li>
        <div class="title">
            <i class="sprite icon-shortcuts"></i>
            <b>[[Lang::get('keywords.shortcuts')]]</b>
        </div>
        <ul class="list-unstyled sub-items">
            <li ng-repeat="shortcut in shortcuts | orderBy:'sortkey'">
                <div ng-click="openNotebook(shortcut.id, shortcut.type, notebook.id)" class="list-item" ng-class="{ 'active': notebook.id == getNotebookSelectedId() }">{{shortcut.title}}</div>
            </li>
        </ul>
    </li>
    <li>
        <div class="title">
            <i class="sprite icon-notebooks"></i>
            <b>[[Lang::get('keywords.notebooks')]]</b>
            <i class="manage-item fa fa-pencil" ng-click="modalManageNotebooks();" title="[[Lang::get('keywords.manage_notebooks')]]"></i>
        </div>
        <ul class="list-unstyled sub-items">
            <li ng-repeat="notebook in notebooks | orderBy:'title'" ng-click="openNotebook(notebook.id, notebook.type, notebook.id)" ng-class="{ 'active': notebook.id == getNotebookSelectedId() }" ng-drop="true" ng-drop-success="onDropSuccess($data,$event)">
                <div class="list-item">{{notebook.title}}<i class="num">{{notebook.notes_count}}</i></div>
            </li>
        </ul>
    </li>
    <li>
        <div class="title">
            <i class="sprite icon-tags"></i>
            <b>[[Lang::get('keywords.tags')]]</b>
            <i class="manage-item fa fa-pencil" ng-click="modalManageTags();"></i>
        </div>
        <ul class="list-unstyled sub-items">
            <li ng-repeat="tag in tags | orderBy:'title':reverse" ng-click="openTag(tag.id)" ng-class="{ 'active': tag.id == tagsSelectedId }" ng-drop="true" ng-drop-success="onDropToTag($data, $event)">
                <div class="list-item">{{tag.title}}</div>
            </li>
        </ul>
    </li>
    <li>
        <div class="title">
            <i class="sprite icon-calendar"></i>
            <b>Calendar</b>
        </div>
        <ul class="list-unstyled row">
            <datepicker pw-datepicker-refresh="sidebarCalendarPromise" id="sidebarCalendar" date-disabled="sidebarCalendarIsDisabled(date, mode)" ng-change="openDate(sidebarCalendar)" ng-model="sidebarCalendar" show-weeks="false" ></datepicker>
        </ul>
    </li>
</ul>