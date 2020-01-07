<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<style>
    .vendororder {
        background: #fff;
        border-bottom: 2px solid #c5c5c5;
        border-top: 4px solid #000;
    }

    .vendor-text {
        float: left;
        height: 39px;
        /* vertical-align: middle; */
        line-height: 37px;
        font-size: 21px;
        padding-right: 15px;
        border-right: 1px solid #c5c5c5;
        margin-right: 12px;
    }
</style>
<style>
    .measurement_right_text {
        float: right;
    }

    .measurement_text {
        float: left;
    }

    .fr_value {
        font-size: 15px;
        margin-top: -7px;
        float: left;
    }

    .productStatusBlock {
        padding: 10px;
        border: 1px solid #000;
        float: left;
        margin: 5px;
    }

    .payment_block {
        padding: 10px;
        padding-top: 30px;
        margin: 0px;
        margin-top: 30px;
        background: #ddd;
        border: 6px solid #ff3b3b;
    }
</style>
<!-- begin #content -->
<div id="content" class="content">
    <section class="" style="min-height: auto;">
        <div class="row">
            <!--title row-->
            <div class="col-md-12">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading with-border">
                            <h3 class="panel-title" style="width: 100%"><i class=" fa fa-money"></i> Payment
                                Confirmation
                                <span style="float: right"> Order No.:
                                    <?php echo $ordersdetails['order_data']->order_no; ?></span>
                            </h3>
                        </div>
                        <form role="form" action="#" method="post">
                            <div class="panel-body">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Payment Date</label>
                                        <input class="form-control" type="date" name="c_date"
                                               value="<?php echo date('Y-m-d'); ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Payment Time</label>
                                        <input class="form-control" type="time" name="c_time"
                                               value="<?php echo date('H:m:s'); ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Payment Mode</label>
                                        <input class="form-control" name="payment_mode"
                                               value="<?php echo $ordersdetails['order_data']->payment_mode; ?>"
                                               required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Transection ID</label>
                                        <input type="text" class="form-control" placeholder="" name="txn_no"
                                               required="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remark <small>(It will be subject of email.)</small></label>
                                        <input type="text" class="form-control" placeholder="Remark for order status"
                                               name="remark" required="" value="Your payment has been received. Thanks.">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <small>(It will be message body of email.)</small></label>
                                        <textarea class="form-control" placeholder="Enter Message"
                                                  name="description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/.panel-body-->

                            <div class="panel-footer ">
                                <div class="row form-group">
                                    <div class="col-md-4" style="   ">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="sendmail" checked="true">
                                                Notify to customer by mail.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary btn-lg"
                                                style="    font-size: 13px;" name="submit" value="submit">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php
                    $this->load->view('Order/orderstatusside');
                    ?>
                </div>
            </div>
    </section>





    <?php
    $this->load->view('Order/orderinfocomman');
    ?>
    <div class="clearfix"></div>


</div>



<?php
$this->load->view('layout/footer');
?>