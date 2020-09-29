

<table id="tableDataOrder" class="table table-bordered  tableDataOrder" border="1">
    <thead>
        <tr>
            <th style="width: 70px">S. No.</th>
            <th style="width:150px">Booking No.</th>
            <th style="width:150px">Guest(s)</th>
            <th style="width:300px">Customer Name</th>
              <th style="width:300px">Customer Contact No.</th>

            <th style="width:150px">Booking Date/Time</th>
            <th style="width:150px">Source</th>
            <th >Remark</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if (count($orderslist)) {
            $count = 1;
            foreach ($orderslist as $key => $value) {
                ?>
                <tr style="border-bottom: 1px solid #000;"  class="<?php echo $value->people > 9 ? 'highlightpeople' : ''; ?>">
                    <td><?php echo $count; ?> </td>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->people; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td> <?php echo $value->contact; ?></td>
                    <td>
                        <?php
                        echo $value->select_date . " " . $value->select_time . "<br/>";
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $value->order_source . "<br/>";
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $value->extra_remark . "<br/>";
                        ?>
                    </td>
                </tr>
                <?php
                $count++;
            }
        } else {
            ?>
        <h4><i class="fa fa-warning"></i> No order found</h4>
        <?php
    }
    ?>

</tbody>
</table>
