angular.module('paperworkNotes').controller('AdminConsoleController',
    function($scope, $modalInstance) {
        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    });
