<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<style>
    .order_panel{
        padding: 10px;
        padding-bottom: 11px!important;
        border: 1px solid #c5c5c5;
        background: #fff;

    }
    .order_panel li{
        line-height: 19px!important;
        padding: 7px!important;
        border: none!important;
    }

    .order_panel li i{
        float: left!important;
        line-height: 19px!important;
        margin-right: 13px!important;
    }
    .order_panel h6{
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .blog-posts article {
        margin-bottom: 10px;
    }
    tr.highlightpeople {
        border: 3px solid red;
    }
</style>


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading with-border">
                    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
                    <form action="#" method="get" class="form-inline">
                        <div class="col-md-5 ">
                            <h4> Booking from <small><?php echo $daterange; ?></small></h4>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group" id="daterangepicker">
                                <input type="text" name="daterange" class="form-control dateFormat"  placeholder="click to select the date range" readonly="" style="    background: #FFFFFF;
                                       opacity: 1;width:200px;" value="<?php echo $daterange; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                            <button class="btn btn-success" type="submit" name="submit" value="searchdata"><i class="fa fa-send"></i> Submit</button>
                            <?php
                            if ($exportdata == 'yes') {
                                ?>
                                <a class="btn btn-warning" href="<?php echo site_url("Order/bookinglistxls/$fdate/$ldate"); ?>">Export</a>
                                <?php
                            }
                            ?>
                        </div>


                    </form>

                    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
                    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

                    <div  style="clear:both"></div>
                </div>
                <!-- /.panel-header -->
                <div class="panel-body">

                    <table id="tableDataOrder" class="table table-bordered  tableDataOrder">
                        <thead>
                            <tr>
                                <th style="width: 70px">S. No.</th>
                                <th style="width:150px">Booking Information</th>
                                <th style="width:300px">Customer Information</th>

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
                                        <td>
                                            <?php echo $count; ?>
                                        </td>
                                        <td>

                                            <table class="small_table">
                                                <tr>
                                                    <th>Booking No.</th>
                                                    <td>: <?php echo $value->id; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Guest(s)</th>
                                                    <td>: <?php echo $value->people; ?></td>
                                                </tr>
                                              
                                            </table>

                                        </td>

                                        <td>

                                            <b> <?php echo $value->name; ?></b>
                                            <table class="small_table">
                                                <tr>
                                                    <th><i class="fa fa-envelope"></i> &nbsp; </th>
                                                    <td class="overtext"> <a href="#" title="<?php echo $value->email; ?>"><?php echo $value->email; ?></a></td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fa fa-phone"></i>  &nbsp;</th>
                                                    <td> <?php echo $value->contact; ?></td>
                                                </tr>

                                            </table>

                                        </td>



                                        <td>
                                            <?php
                                      
                                            echo $value->select_date . " ". $value->select_time. "<br/>";
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php
$this->load->view('layout/footer');
?> 

<script>
    $(function () {


    })


    $(function () {
        $("#daterangepicker").daterangepicker({
            format: 'YYYY-MM-DD',
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                "Today's": [moment(), moment()],
                "Tomorrow's": [moment().add(1, 'days'), moment().add(1, 'days')],
                'Next 7 Days': [moment(), moment().add(6, 'days')],
                'Next 30 Days': [moment(), moment().add(29, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            
        }, function (start, end, label) {
            $('input[name=daterange]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $('#tableDataOrder').DataTable({
            "language": {
                "search": "Search Order By Email, Order No., Order Date Etc."
            }
        })
    })
</script>