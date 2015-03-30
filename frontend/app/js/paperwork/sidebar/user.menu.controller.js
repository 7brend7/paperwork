angular.module('paperworkNotes').controller('UserMenuController',
    function($scope, $rootScope, $location, $routeParams, NotesService, NetService, $modal) {
        $scope.showModal = function(templateUrl, controller, size) {
            size = size || '';
            var modalInstance = $modal.open({
                templateUrl: templateUrl,
                controller: controller,
                size: size
            });
        };
    });
