<div class="single-note-header row">

    <div class="dropdown select-notebook">
        <button class="btn btn-default dropdown-toggle" type="button" id="selectNotebookDropDown" data-toggle="dropdown" aria-expanded="true">
            {{note.notebook.title}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="selectNotebookDropDown" ng-controller="SidebarNotebooksController">
            <li ng-repeat="notebook in notebooks | filter:{id:'!00000000-0000-0000-0000-000000000000'} | orderBy:'title'">
                <a href="#" ng-click="moveNote(note.notebook_id, note.id, notebook.id)">{{notebook.title}}</a>
            </li>
        </ul>
    </div>

    <ul class="list-unstyled notebook-controls" ng-controller="SidebarNotesController">
        <li>
            <button type="button" id="attachmentsBtn" data-placement="bottom" title="Attachments">
                <i class="fa fa-files-o"></i>
            </button>
        </li>
        <li>
            <button data-toggle="freqselector" data-target="#wayback-machine" type="button" data-placement="bottom" title="[[Lang::get('keywords.note_history')]]">
                <i class="fa fa-history"></i>
            </button>
        </li>
        <li ng-hide="editNoteMode">
            <button ng-click="editNote(note.notebook_id, note.id)" type="button" data-placement="bottom" title="[[Lang::get('keywords.edit_note')]]">
                <i class="fa fa-pencil"></i>
            </button>
        </li>
        <li ng-show="editNoteMode" class="ng-hide">
            <button ng-click="updateNote()" type="button" data-placement="bottom" title="[[Lang::get('keywords.save')]]">
                <i class="fa fa-floppy-o"></i>
            </button>
        </li>
        [[--
        <li>
            <button type="button" data-placement="bottom" title="Share"><i class="fa fa-share-alt"></i></button>
        </li>
        --]]
        <li>
            <button ng-click="modalDeleteNote(getNotebookSelectedId(), (getNoteSelectedId(true)).noteId)" type="button" data-placement="bottom" title="[[Lang::get('keywords.delete_note')]]">
                <i class="fa fa-trash-o"></i>
            </button>
        </li>
    </ul>

</div>