/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Admin.controller('rootController', function ($scope, $http, $timeout, $interval) {
    var notify_url = rootBaseUrl + "localApi/notificationUpdate";
    $scope.rootData = {'notifications': []};
    $http.get(notify_url).then(function (rdata) {
        $scope.rootData.notifications = rdata.data;
    }, function () {})
})

