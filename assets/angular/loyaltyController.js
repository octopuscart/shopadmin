
Admin.controller('CreateBillingController', function ($scope, $http, $timeout, $interval, $compile) {
    var couponurl = apiurl;
    $('#datepicker-default').datepicker({
        todayHighlight: true,
        dateFormat: "yyyy-mm-dd"
    });

    $('#datetimepicker2').timepicker({

    });
    $scope.createDataTable = function () {
        $('#tableData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: apiurl + "Api/getLoyaltyMemberDataTable",
                type: 'GET'
            },
            "columns": [
                {"data": "s_n"},
                {"data": "member"},
                {"data": "contact"},
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

    $scope.formData = {
        "prefix": "WL", "member_id": "", "email": "", "contact_no": "",
        "order_no": "", "order_date": moment().format("YYYY-MM-DD"), "order_from": "Woodland", "order_amount": "",
        "order_amount_act": "", "order_time": moment().format("hh:mm A"), "order_type": "Offline Restaurant", "order_status": "active",
        "remark": "", "slot_id": "", "slot_title": "", "reimburse_id": "", "reimburse_amount": "", "reimburse_status": false,
    };
    $scope.formDataReset = {
        "prefix": "WL", "member_id": "", "email": "", "contact_no": "",
        "order_no": "", "order_date": moment().format("YYYY-MM-DD"), "order_from": "Woodland", "order_amount": "",
        "order_amount_act": "", "order_time": moment().format("hh:mm A"), "order_type": "Offline Restaurant", "order_status": "active",
        "remark": "", "slot_id": "", "slot_title": "", "reimburse_id": "", "reimburse_amount": "", "reimburse_status": false,
    };

    $scope.billing = {"select_memeber": {
            "member_name": "", "member_email": "", "member_contact_no": "",
            "member_id": ""}, "slot": {}, "reimburse_amount": "0",
        "total_amount": "0", "alertmessage": ""};

    $scope.checkReimbursement = function () {
        if ($scope.formData.reimburse_status) {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'] - $scope.billing.reimburse_amount;
            $scope.formData['reimburse_amount'] = $scope.billing.reimburse_amount;
            $scope.formData['slot_id'] = $scope.billing.slot.id;
            $scope.formData['slot_title'] = $scope.billing.slot.title;
            if ($scope.formData['order_amount_act'] > $scope.billing.reimburse_amount) {
                $scope.billing.alertmessage = "";
            } else {
                $scope.billing.alertmessage = "Billing amount should be grater then reimbursement amount, please enter order amount first.";
                $scope.formData['order_amount_act'] = "";
            }
        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
            $scope.formData['reimburse_amount'] = 0;
            $scope.formData['slot_id'] = "";
            $scope.formData['slot_title'] = "";
        }
    }


    $scope.checkOrderAmount = function () {
        if ($scope.formData.reimburse_status) {
            if ($scope.formData['order_amount_act'] > $scope.billing.reimburse_amount) {
                $scope.billing.alertmessage = "";
            } else {
                $scope.billing.alertmessage = "Billing amount should be grater then reimbursement amount, please enter order amount first.";
                $scope.formData['order_amount_act'] = "";
            }

        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
            $scope.formData['reimburse_amount'] = 0;
            $scope.formData['slot_id'] = "";
            $scope.formData['slot_title'] = "";
        }
    }

    $scope.selectCustomer = function (customer_id) {
        $scope.billing.select_memeber.member_id = customer_id;
        var selectobj = "#selectmemeber" + customer_id;
        $scope.formData.member_id = customer_id;
        $scope.billing.select_memeber.member_name = $(selectobj).parents("tr").find(".memeber_name").text();
        $scope.billing.select_memeber.member_email = $(selectobj).parents("tr").find(".memeber_email").text();
        $scope.billing.select_memeber.member_contact_no = $(selectobj).parents("tr").find(".memeber_contact_no").text();
        $scope.formData.email = $scope.billing.select_memeber.member_email;
        $scope.formData.contact_no = $scope.billing.select_memeber.member_contact_no;
        $http.get(apiurl + "Api/getMemeberCalculationData/" + customer_id).then(function (rdata) {
            var resultdata = rdata.data;
            $scope.billing.slot = resultdata.slot;
            $scope.billing.reimburse_amount = resultdata.cal_amount;
            $scope.billing.total_amount = resultdata.total_amount;
        }, function () {

        })
    }


    $scope.createBill = function () {
        if ($scope.formData.reimburse_status) {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'] - $scope.billing.reimburse_amount;
        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
        }
        var formData = new FormData();
        for (key in $scope.formData) {
            var value = $scope.formData[key];
            formData.append(key, value);
        }
        $http.post(apiurl + "Api/createLoyaltiBilling", formData).then(function (rdata) {
            $scope.formData = angular.copy($scope.formDataReset);
        }, function () {
        })
    }


})



Admin.controller('MemberListController', function ($scope, $http, $timeout, $interval, $compile) {
    var couponurl = apiurl;
    $('#datepicker-default').datepicker({
        todayHighlight: true,
        dateFormat: "yyyy-mm-dd"
    });

    $('#datetimepicker2').timepicker({

    });
    $scope.createDataTable = function () {
        $('#tableData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: apiurl + "Api/getLoyaltyMemberDataTableReport",
                type: 'GET'
            },
            "columns": [
                {"data": "s_n"},
                {"data": "member"},
                {"data": "contact_no"},
                {"data": "email"},
                {"data": "total_order_amount"},
                {"data": "offer"},
                {"data": "applicableamount"},
            ],
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

    $scope.formData = {
        "prefix": "WL", "member_id": "", "email": "", "contact_no": "",
        "order_no": "", "order_date": moment().format("YYYY-MM-DD"), "order_from": "Woodland", "order_amount": "",
        "order_amount_act": "", "order_time": moment().format("hh:mm A"), "order_type": "Offline Restaurant", "order_status": "active",
        "remark": "", "slot_id": "", "slot_title": "", "reimburse_id": "", "reimburse_amount": "", "reimburse_status": false,
    };
    $scope.formDataReset = {
        "prefix": "WL", "member_id": "", "email": "", "contact_no": "",
        "order_no": "", "order_date": moment().format("YYYY-MM-DD"), "order_from": "Woodland", "order_amount": "",
        "order_amount_act": "", "order_time": moment().format("hh:mm A"), "order_type": "Offline Restaurant", "order_status": "active",
        "remark": "", "slot_id": "", "slot_title": "", "reimburse_id": "", "reimburse_amount": "", "reimburse_status": false,
    };

    $scope.billing = {"select_memeber": {
            "member_name": "", "member_email": "", "member_contact_no": "",
            "member_id": ""}, "slot": {}, "reimburse_amount": "0",
        "total_amount": "0", "alertmessage": ""};

    $scope.checkReimbursement = function () {
        if ($scope.formData.reimburse_status) {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'] - $scope.billing.reimburse_amount;
            $scope.formData['reimburse_amount'] = $scope.billing.reimburse_amount;
            $scope.formData['slot_id'] = $scope.billing.slot.id;
            $scope.formData['slot_title'] = $scope.billing.slot.title;
            if ($scope.formData['order_amount_act'] > $scope.billing.reimburse_amount) {
                $scope.billing.alertmessage = "";
            } else {
                $scope.billing.alertmessage = "Billing amount should be grater then reimbursement amount, please enter order amount first.";
                $scope.formData['order_amount_act'] = "";
            }
        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
            $scope.formData['reimburse_amount'] = 0;
            $scope.formData['slot_id'] = "";
            $scope.formData['slot_title'] = "";
        }
    }


    $scope.checkOrderAmount = function () {
        if ($scope.formData.reimburse_status) {
            if ($scope.formData['order_amount_act'] > $scope.billing.reimburse_amount) {
                $scope.billing.alertmessage = "";
            } else {
                $scope.billing.alertmessage = "Billing amount should be grater then reimbursement amount, please enter order amount first.";
                $scope.formData['order_amount_act'] = "";
            }

        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
            $scope.formData['reimburse_amount'] = 0;
            $scope.formData['slot_id'] = "";
            $scope.formData['slot_title'] = "";
        }
    }

    $scope.selectCustomer = function (customer_id) {
        $scope.billing.select_memeber.member_id = customer_id;
        var selectobj = "#selectmemeber" + customer_id;
        $scope.formData.member_id = customer_id;
        $scope.billing.select_memeber.member_name = $(selectobj).parents("tr").find(".memeber_name").text();
        $scope.billing.select_memeber.member_email = $(selectobj).parents("tr").find(".memeber_email").text();
        $scope.billing.select_memeber.member_contact_no = $(selectobj).parents("tr").find(".memeber_contact_no").text();
        $scope.formData.email = $scope.billing.select_memeber.member_email;
        $scope.formData.contact_no = $scope.billing.select_memeber.member_contact_no;
        $http.get(apiurl + "Api/getMemeberCalculationData/" + customer_id).then(function (rdata) {
            var resultdata = rdata.data;
            $scope.billing.slot = resultdata.slot;
            $scope.billing.reimburse_amount = resultdata.cal_amount;
            $scope.billing.total_amount = resultdata.total_amount;
        }, function () {

        })
    }


    $scope.createBill = function () {
        if ($scope.formData.reimburse_status) {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'] - $scope.billing.reimburse_amount;
        } else {
            $scope.formData['order_amount'] = $scope.formData['order_amount_act'];
        }
        var formData = new FormData();
        for (key in $scope.formData) {
            var value = $scope.formData[key];
            formData.append(key, value);
        }
        $http.post(apiurl + "Api/createLoyaltiBilling", formData).then(function (rdata) {
            $scope.formData = angular.copy($scope.formDataReset);
        }, function () {
        })
    }


})

