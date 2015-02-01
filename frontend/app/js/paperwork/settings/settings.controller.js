paperworkModule.controller('SettingsController',
    ['$scope', '$location', '$routeParams', '$http', '$sce',
        function($scope, $location, $routeParams, $http, $sce) {
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
        }]);