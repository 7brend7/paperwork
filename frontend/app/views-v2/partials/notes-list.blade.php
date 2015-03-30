<div class="notes-list row" ng-controller="NotesListController">

    <a class="note" ng-click="noteSelect(note.notebook_id, note.id)" ng-repeat="note in notes | orderBy:notesOrderProp:notesOrderPropReverse" href="#{{getNoteLink(notebookSelectedId, note.id)}}" ng-class="{ 'active': (note.notebook_id + '-' + note.id == getNoteSelectedId() || (editMultipleNotes && notesSelectedIds[note.id])) }" ng-drag="true" ng-drag-success="onDragSuccess($data,$event)" ng-drag-data="notebook">
        <div class="note-header">
            <i class="time" title="{{note.updated_at}}">{{ note.updated_at | timeAgo }}</i>
            <label>{{note.version.title || note.title}}</label>
        </div>

        <div class="note-content" ng-bind-html="note.version.content_preview || note.content_preview"></div>

    </a>

</div>