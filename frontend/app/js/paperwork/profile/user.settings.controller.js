angular.module('paperworkNotes').controller('UserSettingsController',
    function($scope, $rootScope, $location, $routeParams, NotesService, $modalInstance, $http, $sce) {
        $scope.tabs = {
            'client': {
                isLoaded: false,
                    content: ''
                }
        };

        $scope.getTabContent = function (tabName) {
            if(typeof $scope.tabs[tabName] == 'undefined' || $scope.tabs[tabName].isLoaded){
                return
            }
            var $opts = {method: 'GET', url: 'templates/' + tabName};
            $http($opts).
                success(function (data, status, headers, config) {
                    $scope.tabs[tabName].content = $sce.trustAsHtml(data);
                    $scope.tabs[tabName].isLoaded = true;
                }).
                error(function (data, status, headers, config) {
                });
        };

        $scope.submitImport = function () {
            $('#form-import').ajaxSubmit();
        };

        $scope.submitLanguages = function () {
            $('#language form').ajaxSubmit({
                error: function (response) {
                    var message = '';
                    for (var i in response.responseJSON.message) {
                        message += response.responseJSON.message[i].join('<br>') + '<br><br>';
                    }

                    $rootScope.modalMessageBox = {
                        'title': "Error when saving language settings",
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

        $(document).off('change.enex').on('change.enex', '#enex', function() {
            $('#enexPlaceholder').val($(this).val());
        });
    });
