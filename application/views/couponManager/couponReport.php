<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- Main content -->
<section class="content" ng-controller="UseCouponController">
    <div class="">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Coupon Access</h3>
            </div>
            <div class="panel-body">
                <table id="tableData" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 20px;">S.N.</th>
                            <th style="width:250px;">Sender</th>
                            <th style="width:250px;">Receiver</th>

                            <th style="width:100px;">Coupon</th>

                            <th style="width:100px;">Amount</th>
                            <th style="width:100px;">Payment Type</th>

                            <th style="width:10px;">Date/Time</th>

                            <th style="width: 75px;"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="couponmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form ng-submit="userCouponData()">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Coupon Code: {{selectcode.coupon_code}} ID:#{{formData.coupon_id}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usermodel">Select Email </label>
                            <select class="form-control"  ng-model="formData.email" ng-init="formData.email = selectcode.email" required="">
                                <option value="" selected="">Select Email</option>
                                <option value="{{selectcode.email}}" >{{selectcode.name}} - {{selectcode.email}}</option>
                                <option value="{{selectcode.email_receiver}}">{{selectcode.name_receiver}} - {{selectcode.email_receiver}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usermodel1">Remark</label>
                            <input class="form-control" id="usermodel1" ng-model="formData.remark" required="" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Reimburse</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
<!-- end col-6 -->
</div>

<script>
    var apiurl = "https://manager2.woodlandshk.com/";
//    var apiurl = "http://localhost/woodlandcoupon/index.php/";
</script>

<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-manage-default.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/angular/couponController.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script>
    $(function () {


    }
    )

</script>