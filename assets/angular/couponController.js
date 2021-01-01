
Admin.controller('UseCouponController', function ($scope, $http, $timeout, $interval, $compile) {
    var couponurl = apiurl;
    $scope.createDataTable = function () {
        $('#tableData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: apiurl + "Api/getCouponDataTable/woodlandshk",
                type: 'GET'
            },
            "columns": [
                {"data": "s_n"},
                {"data": "sender"},
                {"data": "receiver"},
                {"data": "coupon_code"},
                {"data": "amount"},
                {"data": "payment_type"},
                {"data": "datetime"},
                {"data": "edit"}],
            "createdRow": function (row, data, index) {
                $compile(row)($scope); //add this to compile the DOM
            }
        })
    }
    $scope.createDataTable();

    $scope.selectcode = {};
    $scope.formData = {"coupon_id": "",  "remark": ""};
    $scope.userCoupon = function (couponid) {
        $scope.formData.coupon_id = couponid;
        $http.get(apiurl + "Api/getCouponData/" + couponid).then(function (rdata) {
            $("#couponmodal").modal("show");
            $scope.selectcode = rdata.data;



        }, function () {

        })
    }



    $scope.userCouponData = function () {
        $('#tableData').dataTable().fnDestroy();
        var formData = new FormData();
        for (key in $scope.formData) {
            var value = $scope.formData[key];
            formData.append(key, value);
        }
        $("#couponmodal").modal("hide");
        $http.post(apiurl + "Api/couponUse", formData).then(function (rdata) {
            $scope.createDataTable();
            $scope.formData = angular.copy({"coupon_id": "",  "remark": ""});

        }, function () {

        })
    }
})



Admin.controller('UseCouponControllerReport', function ($scope, $http, $timeout, $interval, $compile) {
    var couponurl = apiurl;
    $scope.createDataTable = function () {
        $('#tableData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: apiurl + "Api/getCouponDataTableReport/woodlandshk",
                type: 'GET'
            },
            "columns": [
                {"data": "s_n"},
                {"data": "used_email"},
                {"data": "remark"},
                {"data": "coupon_code"},
                {"data": "amount"},
                {"data": "payment_type"},
                {"data": "datetime"},
//                {"data": "edit"}
            ],
            "createdRow": function (row, data, index) {
                $compile(row)($scope); //add this to compile the DOM
            }
        })
    }
    $scope.createDataTable();

    $scope.selectcode = {};
    $scope.formData = {"coupon_id": "",  "remark": ""};
    $scope.userCoupon = function (couponid) {
        $scope.formData.coupon_id = couponid;
        $http.get(apiurl + "Api/getCouponData/" + couponid).then(function (rdata) {
            $("#couponmodal").modal("show");
            $scope.selectcode = rdata.data;



        }, function () {

        })
    }



    $scope.userCouponData = function () {
        $('#tableData').dataTable().fnDestroy();
        var formData = new FormData();
        for (key in $scope.formData) {
            var value = $scope.formData[key];
            formData.append(key, value);
        }
        $("#couponmodal").modal("hide");
        $http.post(apiurl + "Api/couponUse", formData).then(function (rdata) {
            $scope.createDataTable();
            $scope.formData = angular.copy({"coupon_id": "",  "remark": ""});

        }, function () {

        })
    }
})
