<?php
echo PDF_HEADER;
?>

<table class="detailstable" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;margin-top:20px;">
    <tr>
        <td style="width: 50%" >
            <div style="float:left;width: 300px;height: 250px">
                <b style="width: 100%;height: 50px;float: left;">Shipping Address</b><br/>

                <table class="gn_table" style="border-top: 1px solid;margin-top: 5px; ">
                    <tr>
                        <td colspan="2">
                            <span style="text-transform: capitalize;margin-top: 10px;"> 
                                <?php echo $order_data->name; ?>
                            </span> <br/>
                            <div style="    padding: 5px 0px;font-size: 10px;">
                                <?php echo $order_data->address1; ?><br/>
                                <?php echo $order_data->address2; ?><br/>
                                <?php echo $order_data->state; ?>
                                <?php echo $order_data->city; ?>

                                <?php echo $order_data->country; ?> <?php echo $order_data->zipcode; ?>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Email</th>
                        <td>:  <?php echo $order_data->email; ?> </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;    width: 95px;">Contact No.</th>
                        <td>:  <?php echo $order_data->contact_no; ?> </td>
                    </tr>
                </table>
            </div>

        </td>
        <td style="width: 30%" >
            <div style="float:right;width: 300px;height: 250px">
                <b style="width: 100%;height: 50px;float: left;">Order Information</b><br/>
                <table class="gn_table" style="border-top: 1px solid;margin-top: 5px; ">
                    <tr>
                        <th style="text-align: left;">Order No.</th>
                        <td>:  <?php echo $order_data->order_no; ?> </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Date/Time</th>
                        <td>:  <?php echo $order_data->order_date; ?> <?php echo $order_data->order_time; ?>  </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Payment Mode</th>
                        <td>:  <?php echo $order_data->payment_mode; ?> </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Txn No.</th>
                        <td>:  
                            <?php echo $payment_details['txn_id'] ? $payment_details['txn_id'] : '---'; ?> 
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Status</th>
                        <td>:  <?php
                            if ($order_status) {
                                echo end($order_status)->status;
                            } else {
                                echo "Pending";
                            }
                            ?>  </td>
                    </tr>
                </table>

            </div>
        </td>
    </tr>
</table>
<table class="carttable"   align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;">


    <tr style="font-weight: bold">
        <td colspan="6"  style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;background: rgb(225, 225, 225);">
            <h3>Order Description</h3>

        </td>

    </tr>
    <tr style="font-weight: bold">
        <td style="width: 20px;text-align: right;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">S.No.</td>
        <td colspan="2"  style="text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Product(s)</td>

        <td style="text-align: right;width: 100px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Price</td>
        <td style="text-align: right;width: 60px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Qnty.</td>
        <td style="text-align: right;width: 150px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Total</td>
    </tr>
    <!--cart details-->
    <?php
    foreach ($cart_data as $key => $product) {
        ?>
        <tr style="border: 1px solid #000">
            <td style="padding: 0px 10px;text-align: right;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
                <?php echo $key + 1; ?>
            </td>

            <td style="width: 50px;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <center> 
            <img src=" <?php echo $product->file_name; ?>" style="height: 50px;">
        </center>
    </td>

    <td style="width: 200px;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <?php echo $product->title; ?><br/>
        <small style="font-size: 10px;">(<?php echo $product->sku; ?>)</small>


    </td>

    <td style="text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <?php echo $product->price; ?>
    </td>

    <td style="text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <?php echo $product->quantity; ?>
    </td>

    <td style="text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <?php
        echo GLOBAL_CURRENCY . " " . number_format($product->total_price, 2, '.', '');
        ?>



    </td>
    </tr>
   
    <?php
}
?>


<!--end of cart details-->
<tr style="" >
    <td rowspan="5" colspan="3" style="text-align: left;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">
        <b>Amount in Words:</b><br/>
        <?php
        echo  ucwords($order_data->amount_in_word);
        ?>


    </td>

</tr>


<tr style="">
    <td colspan="2" style="text-align: right;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">Sub Total</td>
    <td style="text-align: right;width: 60px;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;"><?php echo GLOBAL_CURRENCY . " " . number_format($order_data->sub_total_price, 2, '.', ''); ?> </td>
</tr>
<tr style="">
    <td colspan="2" style="text-align: right;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">Shipping Amount</td>
    <td style="text-align: right;width: 60px;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;"><?php echo GLOBAL_CURRENCY . " " . number_format($order_data->shipping_price, 2, '.', ''); ?> </td>
</tr>
<tr style="">
    <td colspan="2" style="text-align: right;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">Coupon Discount</td>
    <td style="text-align: right;width: 60px;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;"><?php echo GLOBAL_CURRENCY . " " . number_format($order_data->credit_price, 2, '.', ''); ?> </td>
</tr>
<tr style="">
    <td colspan="2" style="text-align: right;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">Toal Amount</td>
    <td style="text-align: right;width: 60px;text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;"><?php echo GLOBAL_CURRENCY . " " . number_format($order_data->total_price, 2, '.', ''); ?> </td>
</tr>

<tr style="" >
    <td colspan="6" style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;font-size: 10px;">
        Note:<br/>
        1. Received the above merchandise in fine condition & correct quantity.<br/>
        2. Goods once sold can not be returned.<br/>
        3. This is computer generated receipt, bear no CHOP.

    </td>

</tr>



</table>

