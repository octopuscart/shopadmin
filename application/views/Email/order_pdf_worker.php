<?php
$lng_array = array(
    'Profile' => '',
    'Gender' => '性別',
    'Height' => '高度',
    'Weight' => '重量',
    'Age' => '年齡',
    'Neck' => '領',
    'Chest' => '上圍',
    'Full Shoulder Width' => '肩',
    'Right Sleeve' => '右袖',
    'Left Sleeve' => '左袖',
    'Bicep' => '上臂',
    'Abdomen' => '肚',
    'Wrist' => '手腕',
    'Hips / Seat' => '下圍',
    'Front Shirt Length' => '衫長',
    'Front Jacket Length' => '衫長',
    'Front  Length' => '前長',
    'Trouser Waist' => '腰',
    'Crotch' => '內浪',
    'Trouser Inseam' => '內長',
    'Trouser Outseam' => '外長',
    'Thigh' => '髀',
    'Bottom' => '腳',
    'Waistcoat Front' => '前',
    'Waistcoat Back' => '後',
//    'Stance' => '',
//    'Shoulder Slop' => '',
//    'Chest' => '',
//    'Stomach' => '',
//    'Seat Shape' => '',
);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
    <?php
    echo PDF_HEADER;
    ?>


    <table class="detailstable" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;margin-top:20px;">

        <tr style="font-weight: bold">
            <td colspan="6"  style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;background: rgb(225, 225, 225);">
                <h3>Order Information for Tailor</h3>

            </td>

        </tr>
        <tr>
            <td style="width: 50%" >
                <div style="float:left;width: 300px;">
                    <table>

                        <tr>
                            <th style="text-align: left;">Customer</th>
                            <td>:  <?php echo $order_data->name; ?> </td>
                        </tr>
                        <tr>
                            <th style="text-align: left;    width: 120px;">Pre. Order No.</th>
                            <td>:  </td>
                        </tr>
                    </table>
                </div>

            </td>
            <td style="width: 40%" >
                <div style="float:right;width: 300px;">

                    <table >
                        <tr>
                            <th style="text-align: left;">Order No.</th>
                            <td>:  <?php echo $order_data->order_no; ?> </td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Date/Time</th>
                            <td>:  <?php echo $order_data->order_date; ?> <?php echo $order_data->order_time; ?>  </td>
                        </tr>

                    </table>

                </div>
            </td>
        </tr>
    </table>

    <table class="carttable"   align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;">


        <tr style="font-weight: bold">
            <td colspan="6"  style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;background: rgb(225, 225, 225);">
                <h3>Items</h3>

            </td>

        </tr>

    </table>


    <table class="carttable"   align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;">



        <tr style="font-weight: bold">
            <td style="width: 20px;text-align: right;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">S.No.</td>
            <td colspan="3"  style="text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Product(s)</td>

            <td colspan="2"  style="text-align: center;width: 200px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Swatches</td>
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

                <td colspan="2"  style="width: 200px;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">

                    <table >
                        <tr>
                            <th style="text-align: left;">Item Name</th>
                            <td>:  <?php echo $product->item_name; ?> </td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Item Code</th>
                            <td>:  <?php echo $product->sku; ?> </td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Item Name</th>
                            <td>:  <?php echo $product->quantity; ?> </td>
                        </tr>


                    </table>


                </td>

                <td colspan="2"  style="text-align: right;padding: 0px 10px;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;">

                </td>
            </tr>
            <tr>
                <td colspan="6" style="border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 10px 10px;">

                    <table style="width: 100%">
                        <tr> <td colspan="2" style="text-align: left;padding: 5px;background: rgb(225, 225, 225);">
                                <b>Style Details:</b> <?php echo $product->title; ?> - <?php echo $product->item_name; ?>
                            </td></tr>

                        <?php
                        foreach ($product->custom_dict as $key => $value) {
                            echo "<tr><td style='width: 250px;border-bottom:1px solid #c0c0c0;padding-left:20px;'>$key</td><td style='border-bottom:1px solid #c0c0c0'> $value</td></tr>";
                        }
                        ?>  
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>

        <tr>
            <td colspan="6" style="width: 20px;text-align: left;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 10px;">

                <table style="width: 100%">
                    <tr> 
                        <td colspan="5" style="text-align: left;padding: 5px;background: rgb(225, 225, 225);">
                            <b>Size(s):</b> <?php echo $order_data->measurement_style; ?>
                        </td>
                    </tr>
                    <?php
                    if (count($measurements_items)) {
                        ?>
                        <tr>
                            <td colspan="2" style="width: 250px;">Measurement Field</td>
                            <td style="width: 100px;">Value</td>
                            <td style="text-align: center;">Allowance </td>
                            <td style="text-align: center;">Final Size<br/>
                                <span style="font-size: 10px;">(Measurement + Allowance)</span>
                            </td>

                        </tr>

                        <?php
                        foreach ($measurements_items as $keym => $valuem) {
                            $mvalues = explode(" ", $valuem['measurement_value']);
                            echo "<tr><td style='border-bottom:1px solid #c0c0c0;padding-left:20px;'>" . $valuem['measurement_key'] . " </td><td style='border-bottom:1px solid #c0c0c0;padding-left:20px;font-family: Sun-ExtA ;'>" . (isset($lng_array[$valuem['measurement_key']]) ? $lng_array[$valuem['measurement_key']] : '') . "</td><td style='border-bottom:1px solid #c0c0c0'>" . $mvalues[0] . " <span style='margin-left: 1px;
    padding: 0;
    font-size: 10px;

    position: absolute;
    margin-top: -5px;
    width: 20px;'>" . $mvalues[1] . '"</span>' . "</td>"
                            . "<td style='border-bottom:1px solid #c0c0c0;padding-left:20px;'></td><td style='border-bottom:1px solid #c0c0c0;padding-left:20px;'></td></tr>";
                        }
                    }
                    ?>  
                </table>
            </td>
        </tr>


        <tr style="font-weight: bold">
            <td colspan="2"  style="width: 20%;height: 100px;    vertical-align: text-top;font-size: 12px;text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Wrist Watch</td>
            <td style="width: 20%;font-size: 12px;    vertical-align: text-top;text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Armhole</td>
            <td style="width: 20%;font-size: 12px;    vertical-align: text-top;text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Cuff Finish (Left)</td>
            <td style="width: 20%;font-size: 12px;    vertical-align: text-top;text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Cuff Finish (Right)</td>
            <td style="width: 20%;font-size: 12px;    vertical-align: text-top;text-align: center;border: 1px solid rgb(157, 153, 150);border-collapse: collapse;padding: 0px 10px;">Cuff Finish (Right)</td>
        </tr>
        <!--end of cart details-->







    </table>

</html>