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
<section class="content" >
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->

        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-pencil-square"></i></div>
                <div class="stats-info">
                    <h4>Total Received</h4>
                    <p>{{<?php echo $total_collection; ?>|currency}}</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-bar-chart"></i></div>
                <div class="stats-info">
                    <h4>Percent</h4>
                    <p><?php echo $target_achive; ?>%</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-circle-o"></i></div>
                <div class="stats-info">
                    <h4>Target Goal</h4>
                    <p>{{<?php echo $targetgoal; ?>|currency}}</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-refresh"></i></div>
                <div class="stats-info">
                    <h4>Remain</h4>
                    <p>{{<?php echo $targetgoal - $total_collection; ?>|currency}}</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Donation Reports
                
                                <a class="btn btn-danger btn-xs pull-right" href="<?php echo site_url("Charity/reportXls");?>">Export Report</a>
</h3>

            </div>
            <div class="panel-body" style="overflow-x: auto">

                <?php
                $this->load->view('donation/reportsxls', array("reportdata" => $reportdata, "isxls" => true));
                ?>
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


<script>
    $(function () {

        $('#donationalisttable').DataTable({

        })
    }
    )

</script>