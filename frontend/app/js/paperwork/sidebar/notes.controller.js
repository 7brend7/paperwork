angular.module('paperworkNotes').controller('SidebarNotesController',
  function($scope, $rootScope, $location, $timeout, $routeParams, NotebooksService, NotesService, ngDraggable, StatusNotifications, paperworkDbAllId) {
    $scope.isVisible = function() {
      return !$rootScope.expandedNoteLayout;
    };

    $rootScope.getNoteSelectedId = function(asObject) {
      if(asObject === true) {
        return $rootScope.noteSelectedId;
      }
      return $rootScope.noteSelectedId.notebookId + "-" + $rootScope.noteSelectedId.noteId;
    };

    $rootScope.setNoteSelectedId = function(notebookId, noteId) {
      $rootScope.noteSelectedId.notebookId = notebookId;
      $rootScope.noteSelectedId.noteId = noteId;
    };

    $rootScope.getNoteByIdLocal = function(noteId) {
      var i = 0, l = $rootScope.notes.length;
      for(i = 0; i < l; i++) {
        if($rootScope.notes[i].id == noteId) {
          return $rootScope.notes[i];
        }
      }
      return null;
    };

    $scope.newNote = function(notebookId) {
      /*if($rootScope.menuItemNotebookClass() === 'disabled') {
        return false;
      }*/
      if(typeof notebookId == "undefined" || notebookId == paperworkDbAllId) {
        $rootScope.modalMessageBox = {
          'title': 'Error',
          'content': 'Please select notebook first',
          'buttons': [
            {
              'label': $rootScope.i18n.keywords.close,
              'isDismiss': true
            }
          ]
        };
        $('#modalMessageBox').modal('show');
        return false;
      }

      var data = {
        'title':           $rootScope.i18n.keywords.untitled || 'Untitled',
        'content':         '',
        'content_preview': ''
      };

      var callback = (function(_notebookId) {
        return function(status, data) {
          switch(status) {
            case 200:
              $rootScope.templateNoteEdit = {};
              $location.path("/n/" + _notebookId + "/" + data.response.id + "/edit");
              StatusNotifications.sendStatusFeedback("success", "note_created_successfully");
              break;
            case 400:
              StatusNotifications.sendStatusFeedback("error", "note_create_fail");
              break;
            default:
              StatusNotifications.sendStatusFeedback("error", "note_create_fail");
              break;
          }
        };
      })(notebookId);

      NotesService.createNote(notebookId, data, callback);
    };

    $scope.editNote = function(notebookId, noteId) {
      if($rootScope.menuItemNoteClass('single') === 'disabled') {
        return false;
      }
      $location.path("/n/" + notebookId + "/" + noteId + "/edit");
    };

    $scope.editNotes = function(notebookId, noteId) {
      if($rootScope.menuItemNoteClass('multiple') === 'disabled') {
        return false;
      }

      if($rootScope.editMultipleNotes == true) {
        $rootScope.editMultipleNotes = false;
      } else {
        $rootScope.editMultipleNotes = true;
      }
    };

    $rootScope.updateNote = function() {
      // if(typeof $rootScope.templateNoteEdit == "undefined" || $rootScope.templateNoteEdit == null) {
      //   $rootScope.templateNoteEdit = {};
      // }

      $rootScope.templateNoteEdit.version.content = CKEDITOR.instances.content.getData();

      var data = {
        'title':   $rootScope.templateNoteEdit.version.title,
        'content': $rootScope.templateNoteEdit.version.content,
        'tags':    $('input#tags').tagsinput('items')
      };

      var callback = (function() {
        return function(status, data) {
          switch(status) {
            case 200:
              $rootScope.errors = {};
              $rootScope.templateNoteEdit.modified = false;
              // Temporary until related issue is closed
              StatusNotifications.sendStatusFeedback("success", "note_saved_successfully");

              $rootScope.editNoteMode = false;
              $location.path("/n/" + $rootScope.notebookSelectedId + "/" + $rootScope.note.id);
              break;
            case 400:
              $rootScope.errors = data.errors;
              $rootScope.messageBox({
                'title':   $rootScope.i18n.messages.error_message,
                'content': data.errors,
                'buttons': [
                  {
                    // We don't need an id for the dismiss button.
                    // 'id': 'button-no',
                    'label':     $rootScope.i18n.keywords.damn,
                    'isDismiss': true
                  }
                ]
              });
              break;
            default:
              StatusNotifications.sendStatusFeedback("error", "note_save_failed");
              break;
          }
        };
      })();

      NotesService.updateNote($rootScope.note.id, data, callback);
    };

    $scope.closeNote = function() {
      var closeNoteCallback = function() {
        var currentNote = $rootScope.getNoteSelectedId(true);
        $location.path("/n/" + $rootScope.getNotebookSelectedId() + "/" + currentNote.noteId);
        CKEDITOR.instances.content.destroy();
        $rootScope.templateNoteEdit = {};
        NotebooksService.getTags();
        return true;
      };

      if($rootScope.templateNoteEdit && $rootScope.templateNoteEdit.modified) {
        $rootScope.messageBox({
          'title':   $rootScope.i18n.keywords.close_without_saving_question,
          'content': $rootScope.i18n.keywords.close_without_saving_message,
          'buttons': [
            {
              // We don't need an id for the dismiss button.
              // 'id': 'button-no',
              'label':     $rootScope.i18n.keywords.cancel,
              'isDismiss': true
            },
            {
              'id':    'button-yes',
              'label': $rootScope.i18n.keywords.yes,
              'class': 'btn-warning',
              'click': function() {
                return closeNoteCallback();
              }
            }
          ]
        });
      } else {
        return closeNoteCallback();
      }
    };

    $scope.modalDeleteNote = function(notebookId, noteId) {
      if($rootScope.menuItemNoteClass('multiple') === 'disabled') {
        return false;
      }
      var callback = (function() {
        return function(status, data) {
          switch(status) {
            case 200:
              $location.path("/n/" + notebookId);
              break;
            case 400:
              // TODO: Show some kind of error
              break;
          }
        };
      })();

      $rootScope.messageBox({
        'title':   ($rootScope.editMultipleNotes ? $rootScope.i18n.keywords.delete_notes_question : $rootScope.i18n.keywords.delete_note_question),
        'content': ($rootScope.editMultipleNotes ? $rootScope.i18n.keywords.delete_notes_message : $rootScope.i18n.keywords.delete_note_message),
        'buttons': [
          {
            // We don't need an id for the dismiss button.
            // 'id': 'button-no',
            'label':     $rootScope.i18n.keywords.cancel,
            'isDismiss': true
          },
          {
            'id':    'button-yes',
            'label': $rootScope.i18n.keywords.yes,
            'class': 'btn-warning',
            'click': function() {
              if($rootScope.editMultipleNotes) {
                noteId = [];
                angular.forEach($rootScope.notesSelectedIds, function(isChecked, checkedNoteId) {
                  if(isChecked) {
                    noteId.push(checkedNoteId);
                  }
                });
              }
              NotesService.deleteNote(noteId, callback, function() {
                $location.path("/n/" + notebookId);
              });
              return true;
            }
          }
        ]
      });
    };

    $scope.modalMoveNote = function(notebookId, noteId) {

      if($rootScope.menuItemNoteClass('multiple') === 'disabled') {
        return false;
      }

      $rootScope.modalNotebookSelect({
        'notebookId':  notebookId,
        'noteId':      noteId,
        'theCallback': function(notebookId, noteId, toNotebookId) {
          if($rootScope.editMultipleNotes) {
            noteId = [];
            angular.forEach($rootScope.notesSelectedIds, function(isChecked, checkedNoteId) {
              if(isChecked) {
                noteId.push(checkedNoteId);
              }
            });
          }
          NotesService.moveNote(notebookId, noteId, toNotebookId, function(_notebookId, _noteId, _toNotebookId) {
            $('#modalNotebookSelect').modal('hide');
            $location.path("/n/" + (_toNotebookId));
          });
          return true;
        }
      });
    };

    $scope.submitSearch = function() {
      if($scope.search == "") {
        $location.path("/");
      } else {
        $location.path("/s/" + encodeURIComponent($scope.search));
      }
    };

    $scope.onDragSuccess = function(data, event) {
      //u
    };
    $scope.openNote=function(notebookId, noteId){
      $rootScope.noteSelectedId.notebookId = notebookId;
      $rootScope.noteSelectedId.noteId = noteId;
	  $location.path("/n/" + (notebookId)+"/"+(noteId));
     };

    $scope.sortNotes = function(item, reverse) {
      $rootScope.notesOrderProp = item;
      $rootScope.notesOrderPropReverse = reverse;
    };

    $rootScope.editNoteMode = false;
  });
