angular.module('paperworkNotes').controller('HelpController',
    function($scope, $modalInstance) {
        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    });
