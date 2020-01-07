<table border="1">
    <thead>
        <tr>
            <th>Order No.</th>
            <th>Total Price</th>
            <th>Total Quantity</th>
               <th>Items</th>
             <th>Measurement</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Contact No.</th>
            <th>Shipping Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zipcode</th>
             <th>Country</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Status</th>
            <th>Payment Mode</th>
         
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($orderslist)) {
            foreach ($orderslist as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value->order_no; ?></td>
                    <td><?php echo $value->total_price; ?></td>
                    <td><?php echo $value->total_quantity; ?></td>
                    <td><?php echo $value->items; ?></td>
                    <td><?php echo $value->measurement_style; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td><?php echo $value->contact_no; ?></td>
                    <td><?php echo $value->address1 .' <br/>'. $value->address2; ?></td>
                    <td><?php echo $value->city; ?></td>
                    <td><?php echo $value->state; ?></td>
                    <td><?php echo $value->zipcode; ?></td>
                    <td><?php echo $value->country; ?></td>
                    <td><?php echo $value->order_date; ?></td>
                    <td><?php echo $value->order_time; ?></td>
                    <td><?php echo $value->status; ?></td>
                    <td><?php echo $value->payment_mode; ?></td>
                    
                    
                </tr>
                <?php
            }
        } else {
            ?>
        <h4><i class="fa fa-warning"></i> No order found</h4>
        <?php
    }
    ?>

</tbody>
</table>
