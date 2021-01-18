<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<style>
    input.coupon_id {
        height: 25px;
        width: 25px;
    }
    .smallfont10{
        font-size: 10px;
    }



    lable {
        margin-top: 13px;
        float: left;
        font-weight: bold;
    }
    hr{
        margin-top: 10px;
        margin-bottom: 0px;
    }
    .amounttable h3 {
        font-size: 20px;
        text-align: center;
        margin: 0;
    }

    .amounttable span{
        text-align: center;
        float: left;
        width:100%;
        color:palevioletred;
        font-size: 11px;
    }

    .amounttable {
        margin: 0px;
        padding: 0px;
    }

    .amounttable th{
        font-weight: 500;

        padding: 3px 0px!important;
    }

    .totalamount{
        font-size: 23px;
        margin: 0px;
        float: left;
    }

    .totalamountspan{
        float:left;
        width:100%;


    }
</style>


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


<!-- Main content -->
<section class="content" ng-controller="CreateBillingController">

    <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Loyalty Program Members</h3>

            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" style="margin-bottom: 30px;" data-target="#couponmodalbulk" ng-if="couponcodelist.length">
                    Reimburse Multiple Coupon(s)
                </button>
                <table id="tableData" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sn. No.</th>
                            <th style="width:250px;">Name</th>
                            <th style="width:150px;">Contact No./Email</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-inverse" data-sortable-id="index-10">
            <div class="panel-heading">
                <h4 class="panel-title">Create Billing</h4>
            </div>
            <div class="panel-body">

                <div class="row clearfix" style="    width: fit-content;">

                    <div class="p-5rounded bg-white" style="padding: 15px;">

                        <div class=" mt-4 mt-lg-0" style="margin-top: -20px;">
                            <div class="form-result"></div>
                            <form class="mb-0 row"  action="#" method="post" ng-submit="createBill()">
                                <div class="form-process"></div>
                                <div class="" >
                                    <table style="    margin-bottom: 10px;">
                                        <tr>
                                            <td rowspan="3" style="width: 50px">
                                                <span class='fa-stack fa-lg'>
                                                    <i class='fa fa-circle fa-stack-2x'></i>
                                                    <i class='fa fa-user fa-stack-1x fa-inverse'></i>
                                                </span>
                                            </td>
                                            <td>{{billing.select_memeber.member_name}}</td>
                                        </tr>
                                        <tr>

                                            <td>{{billing.select_memeber.member_contact_no}}</td>
                                        </tr>
                                        <tr>

                                            <td>{{billing.select_memeber.member_email}}</td>
                                        </tr>
                                    </table>

                                </div>

                                <div class=" row">
                                    <div class="col-sm-12 mb-3">
                                        <lable>Invoice/Order No.</lable>
                                        <input type="text"  name="order_no" value=""  ng-model="formData.order_no" class="required email form-control border-form-control" placeholder="Order No."  required="">
                                    </div>

                                </div>
                                <div ng-if="formData.reimburse_status">
                                    <div ng-if="billing.alertmessage" class='alert alert-danger' style="margin-top: 10px">
                                        {{billing.alertmessage}}

                                    </div>
                                    <div ng-if="formData.wallet_input" class='alert alert-success' style="margin-top: 10px;font-size: 15px;">
                                        {{formData.wallet_input|currency}} Will be credit on wallet

                                    </div>

                                </div>
                                <div class="form-group-lg row">
                                    <div class="col-sm-7 mb-3">
                                        <lable>Billing Amount</lable>
                                        <input type="number"  name="order_amount_act" ng-model="formData.order_amount_act" value="" class="form-control border-form-control required" placeholder="Order Amount" required="" ng-change="checkOrderAmount()">
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-sm-5 mb-3" style="padding: 17px 0px 0px;">
                                        <span class="totalamountspan">Payable Amount</span>
                                        <h3 class="totalamount">

                                            {{formData.order_amount|currency}}
                                        </h3>
                                        <span class="totalamountspan" ng-if="formData.order_amount" style="font-size: 10px;">({{formData.order_amount_act|currency}} - {{billing.reimburse_amount|currency}})</span>
                                    </div>
                                </div>
                                <hr/>
                                <table class="table amounttable">
                                    <tr>
                                        <th> <span>Total Orders Amount</span></th>
                                        <th><span>Applicable Off</span></th>
                                        <th>
                                            <span>Total Reimbursement Amount</span><br/>
                                            
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>    
                                            <h3>{{billing.total_amount| currency}}</h3>
                                        </td>
                                        <td>
                                            <h3>{{billing.slot.off_percent}}%</h3>
                                        </td>
                                        <td >
                                            <h3>{{billing.reimburse_amount| currency}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="3" style="font-size: 10px;text-align: right;">
                                            {{billing.off_amount| currency}} (Off On Order) + {{billing.wallet_amount| currency}} (Wallet)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="    padding: 0px 15px!important;">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" ng-model="formData.reimburse_status" ng-checked="checkReimbursement()">
                                                    Do you want reimbursement now?
                                                </label>
                                            </div>
                                        </th>
                                    </tr>
                                </table>

                                <div class="clear"></div>
                                <hr/>
                                <div class=" row">
                                    <div class="col-sm-7 mb-3 input-daterange travel-date-group">
                                        <lable>Order Date</lable>
                                        <input type="text"  id="datepicker-default" name="order_date" ng-model="formData.order_date"  value="" class="form-control border-form-control  required" placeholder="Select Reservation Date" min="<?php echo date('Y-m-d', strtotime('-30 days')); ?>" value="<?php echo date('Y-m-d'); ?>" required="">
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <lable>Order Time</lable>
                                        <input type="text" id="datetimepicker2"  name="order_time" ng-model="formData.order_time" value="" class="form-control border-form-control  required" placeholder="Select Reservation Date"  value="<?php echo date('H:I A'); ?>" required="">

                                    </div>
                                </div>

                                <div class=" row">
                                    <div class="col-md-12 mb-3">
                                        <lable>Order Type</lable>
                                        <select  class="custom-select form-control border-form-control" name="order_type" required="" ng-model="formData.order_type" >

                                            <option value="At Restaurant">At Restaurant</option>
                                            <option value="Pickup">Pickup</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Other">Other</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <lable>Extra Remark</lable>
                                        <textarea  name="remark" value="" class="form-control border-form-control required" placeholder="Remark" ng-model="formData.remark" ></textarea>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="col-md-12 nobottommargin" style="margin-top: 20px;" ng-if="billing.select_memeber.member_id">
                                        <button class="button button-circle btn btn-lg text-white ml-0 mt-3 colordarkgreen btn btn-primary" type="submit" name="booknow" value="submit">Book Now</button>
                                    </div>
                                    <div class="col-md-12 nobottommargin" style="margin-top: 20px;" ng-if="billing.select_memeber.member_id =="">
                                        <button class="button button-circle btn btn-lg text-white ml-0 mt-3 colordarkgreen btn btn-primary" type="button" disabled="" name="booknow" value="submit">Book Now</button>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
<!-- end col-6 -->
</div>



<script>
    var apiurl = "https://manager2.woodlandshk.com/";
//    var apiurl = "http://localhost/woodlandcoupon/index.php/";
</script>

<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-manage-default.demo.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/angular/loyaltyController.js"></script>
<?php
$this->load->view('layout/footer');
?> 
