<table id="donationalisttable" class="table table-bordered ">
    <thead>
        <tr>
            <th style="width: 50px;">S. N.</th>
            <th style="width: 50px;">ID#</th>
            <th>Name</th>
            <th> Anonymous</th>
            <th>Amount</th>
            <th> Payment Mode</th>
            <th>Message</th>
            <th>Date/Time</th>
            <th>Status</th>
            <?php
            if ($isxls) {
                ?>
                <th>Confirm</th>
                <th>Remove</th>
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach ($reportdata as $key => $value) {
  
                ?>

                <tr>
                    <td><?php echo $count ?></td>
                    <td><?php echo $value["request_id"] ?></td>
                    <td><?php echo $value["donate_name"] ?></td>
                    <td> <?php echo $value["anonymous_donation"] ?></td>
                    <td><?php echo $value["amount"] ?></td>
                    <td> <?php echo $value["payment_type"] ?></td>
                    <td><?php echo $value["message"] ?></td>
                    <td><?php echo $value["datetime"] ?></td>
                    <td><?php echo $value["confirm_status"] ?></td>
                    <?php
                    if ($isxls) {
                        ?>
                        <td><?php echo $value["confirm"] ?></td>
                        <td><?php echo $value["delete"] ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                $count++;
            
        }
        ?>
    </tbody>
</table>