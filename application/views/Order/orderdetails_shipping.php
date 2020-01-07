<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<style>
    .vendororder{
        background: #fff;
        border-bottom: 2px solid #c5c5c5;
        border-top: 4px solid #000;
    }
    .vendor-text{
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
    .measurement_right_text{
        float: right;
    }
    .measurement_text{
        float: left;
    }
    .fr_value{
        font-size: 15px;
        margin-top: -7px;
        float: left;
    }
    .productStatusBlock{
        padding:10px;
        border: 1px solid #000;
        float: left;
        margin: 5px;
    }

    .payment_block{
        padding: 10px;
        padding-top: 30px;
        margin: 0px;
        margin-top: 30px;
        background: #ddd;
        border: 6px solid #ff3b3b;
    }
</style>
<div id="content" class="content">
    <section class="" style="min-height: auto;">

        <div class="row">
            <!--title row--> 
            <div class="col-md-12">



                <div class="col-md-9">


                    <div class="panel panel-default">
                        <div class="panel-heading with-border">
                            <h3 class="panel-title">Order No.: <?php echo $ordersdetails['order_data']->order_no; ?></h3>
                        </div>


                        <form role="form" action="#" method="post">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b style="color:#c0c0c0">Shipping Address</b><br/>
                                        <span style="text-transform: capitalize;margin-top: 10px;"> 
                                            <?php echo $ordersdetails['order_data']->name; ?>
                                        </span> <br/>
                                        <div style="    padding: 5px 0px;">
                                            <?php echo $ordersdetails['order_data']->address1; ?><br/>
                                            <?php echo $ordersdetails['order_data']->address2; ?><br/>
                                            <?php echo $ordersdetails['order_data']->state; ?>
                                            <?php echo $ordersdetails['order_data']->city; ?>

                                            <?php echo $ordersdetails['order_data']->country; ?> <?php echo $ordersdetails['order_data']->zipcode; ?>

                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">

                                        <b style="color:#c0c0c0">Customer ID:</b><br/>

                                        <?php echo ucwords($ordersdetails['order_data']->user_id); ?>
                                        <br/>
                                        <hr/>
                                        <b style="color:#c0c0c0">Destination Country</b><br/>

                                        <?php echo $ordersdetails['order_data']->country; ?>
                                        <br/>


                                    </div>
                                </div>

                                <input class="form-control" type="hidden" name="shipping_country" value="<?php echo $ordersdetails['order_data']->country ?>">


                                <input class="form-control" type="hidden" name="customer_id" value="<?php echo ucwords($ordersdetails['order_data']->user_id); ?>">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Total Weight</label>
                                        <input class="form-control" type="number" name="total_weight" value="" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Weight Unit</label>
                                        <select class="form-control" name="weight_unit">
                                            <option>KG</option>
                                            <option>LBS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Shipping Date</label>
                                        <input class="form-control" type="date" name="shipping_date" value="<?php echo date('Y-m-d'); ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Shipping Time</label>
                                        <input class="form-control" type="time" name="shipping_time" value="<?php echo date('H:m:s'); ?>" required="">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Shipping Company</label>
                                        <input class="form-control" type="datetime" name="shipping_company" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Shipping Contact No.</label>
                                        <input class="form-control" type="datetime" name="shippping_contact_no" value="" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Traking No.</label>
                                        <input class="form-control" type="datetime" name="shipping_tracking_no" value="" required="">
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tracking Link</label>
                                        <input type="text" class="form-control" placeholder="" name="shipping_tracking_link" required="">
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <textarea class="form-control" placeholder="Remark for order status" name="description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!--/.panel-body--> 

                            <div class="panel-footer ">
                                <div class="row form-group">
                                    <div class="col-md-4" style="">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="sendmail" checked="true">
                                                Notify to customer by mail.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary btn-lg" style="    font-size: 13px;" name="submit" value="submit">Submit</button>

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
