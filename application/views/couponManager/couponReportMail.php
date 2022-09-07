<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<style>
    input.coupon_id {
        height: 25px;
        width: 25px;
    }
</style>


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- Main content -->
<section class="content" ng-controller="UseCouponControllerMail">
    <div class="">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Coupon Access Mail</h3>

            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" style="margin-bottom: 30px;" data-target="#couponmodalbulk" ng-if="couponcodelist.length">
                    Reimburse Multiple Coupon(s)
                </button>
                <table id="tableData" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 50px;">S. No.</th>

                            <th style="width:250px;">Buyer</th>
                            <th style="width:150px;">Receiver</th>

                            <th style="width:100px;">Quantity</th>

                            <th style="width:150px;">Amount</th>
                            <th style="width:100px;">Payment Type</th>

                            <th style="width:10px;">Date/Time</th>

                            <th style="width: 75px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultdata as $key => $value) {
                            $coupondata = $value;
                            ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td>
                                    <table class="smalltabledetails">
                                        <tbody>
                                            <tr><td><?php echo $coupondata["name"]; ?></td></tr>
                                            <tr><td><?php echo $coupondata["contact_no"]; ?></td></tr>
                                            <tr><td><?php echo $coupondata["email"]; ?></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                                 <td>
                                    <table class="smalltabledetails">
                                        <tbody>
                                            <tr><td><?php echo $coupondata["name_receiver"]; ?></td></tr>
                                            <tr><td><?php echo $coupondata["contact_no_receiver"]; ?></td></tr>
                                            <tr><td><?php echo $coupondata["email_receiver"]; ?></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td><?php echo $coupondata["quantity"]; ?></td>
                                <td>
                                    <table class="smalltabledetails">
                                        <tbody>
                                            <tr><td>Total Amount</td><td>: <?php echo $coupondata["base_amount"]; ?></td></tr>
                                            <tr><td>Discount</td><td>: <?php echo $coupondata["percent"]; ?>%</td></tr>
                                            <tr><td>Paid Amount</td><td>: <b><?php echo $coupondata["amount"]; ?></b></td></tr>
                                        </tbody>
                                    </table>
                                </td>
                                  <td><?php echo $coupondata["payment_type"]; ?></td>
                                  <td>
                                       <table class="smalltabledetails">
                                        <tbody>
                                            <tr><td><?php echo $coupondata["date"]; ?></td></tr>
                                            <tr><td><b><?php echo $coupondata["time"]; ?></b></td></tr>
                                        </tbody>
                                    </table>
                                  </td>
                                  <td>
                                      <button class="btn btn-danger" ng-click="sendCouponMail('<?php echo $value["request_id"];?>', '<?php echo $value["remark"];?>')">Send Mail</button>
                                  </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- end col-6 -->
</div>



<script>
    var websiteurl = "<?php echo SITE_URL;?>";
//    var apiurl = "http://localhost/wocoupon/index.php/";
</script>

<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-manage-default.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/angular/couponController.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script>
    $(function () {


    }
    )

</script>