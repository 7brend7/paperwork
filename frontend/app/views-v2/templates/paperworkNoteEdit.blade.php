<h3 class="note-header">
	<input id="headerEditInput" ng-blur="headerChange()" type="text" class="form-control input-lg" id="title" placeholder="[[Lang::get('keywords.note_title')]]" ng-model="templateNoteEdit.version.title">
</h3>

<div class="note-tags editable">
	<input type="text" class="form-control input-lg" id="tags" placeholder="[[Lang::get('keywords.tags_separated')]]">
</div>

<div class="note-content">
	<textarea id="content" class="form-control" rows="16" ng-model="templateNoteEdit.version.content"></textarea>
</div>