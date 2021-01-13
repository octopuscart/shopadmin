
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
                {"data": "checkbox"},
              
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
        }).on('search.dt', function () {
            $timeout(function () {
                $scope.couponcodelist = angular.copy([]);
            }, 100)

        })
    }
    $scope.createDataTable();

    $scope.selectcode = {};
    $scope.formData = {"coupon_id": "", "remark": ""};
    $scope.userCoupon = function (couponid) {
        $scope.formData.coupon_id = couponid;
        $http.get(apiurl + "Api/getCouponData/" + couponid).then(function (rdata) {
            $("#couponmodal").modal("show");
            $scope.selectcode = rdata.data;



        }, function () {

        })
    }

    $scope.couponcodelist = [];

    $scope.userCouponBulk = function () {
        $scope.couponcodelist = [];
        $(".coupon_id").each(function () {
            if ($(this).attr("checked")) {
                console.log(this.value)
                $scope.couponcodelist.push(this.value);
            }
            ;
        })

    }

    $scope.bulkUseCoupon = function () {

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
            $scope.formData = angular.copy({"coupon_id": "", "remark": ""});

        }, function () {

        })
    }

    $scope.formData2 = {"coupon_id": "", "remark": ""};
    $scope.userCouponDataBulk = function () {
        $('#tableData').dataTable().fnDestroy();
        var formData = new FormData();
        for (key in $scope.formData2) {
            var value = $scope.formData2[key];
            formData.append(key, value);
        }
        for (cpn in $scope.couponcodelist) {
            var code = $scope.couponcodelist[cpn];
            formData.append("coupon_code[]", code);
        }

        $("#couponmodalbulk").modal("hide");
        $http.post(apiurl + "Api/couponUseBulk", formData).then(function (rdata) {
            $scope.createDataTable();
            $scope.formData = angular.copy({"coupon_id": "", "remark": ""});

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
    $scope.formData = {"coupon_id": "", "remark": ""};
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
            $scope.formData = angular.copy({"coupon_id": "", "remark": ""});

        }, function () {

        })
    }
})
