angular.module('paperworkNotes').controller('ProfileController',
    function($scope, $rootScope, $location, $routeParams, NotesService, $modalInstance) {
        $scope.submit = function () {
            $('#profileForm').ajaxSubmit({
                success: function () {
                    $modalInstance.dismiss();
                },
                error: function (response) {
                    var message = '';
                    for (var i in response.responseJSON.message) {
                        message += response.responseJSON.message[i].join('<br>') + '<br><br>';
                    }

                    $rootScope.modalMessageBox = {
                        'title': "Error when saving profile",
                        'content': message,
                        'buttons': [
                            {
                                'label': $rootScope.i18n.keywords.close,
                                'isDismiss': true
                            }
                        ]
                    };
                    $('#modalMessageBox').modal('show');
                }
            });
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    });
