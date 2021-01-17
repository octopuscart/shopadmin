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
<section class="content" ng-controller="MemberListController">

    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Loyalty Program Members</h3>

            </div>
            <div class="panel-body">

                <table id="tableData" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sn. No.</th>
                            <th style="width:250px;">Name</th>
                            <th style="width:100px;">Contact No</th>
                            <th style="width:150px;">Email</th>
                            <th style="width: 100px;">Total Orders</th>
                            <th style="width: 150px;"> Reimbursement Amount</th>
                            <th style="width: 100px;">Current Orders</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
