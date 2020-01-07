<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>    


<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"  />



<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<style>
    .appointmentheader div{
        font-size: 20px;
    }
    .appointmentfooter{
        border-bottom: 2px solid #000;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 5px 3px;
        margin-bottom: -1px;
    }
</style>

<!-- Main content -->
<section class="" ng-controller="AppointmentController">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">

        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Set An Appointment <small></small></h1>
        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            <!-- begin profile-section -->
            <div class="profile-section">
               
                <div class="row">
                    <div class="col-md-7">
                        <!-- begin profile-info -->
                        <div class="profile-info" style="    font-size: 14px;">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <form action="#" method="post">
                                <input type="hidden" name="aid" class="form-control" value="<?php echo $last_aid; ?>">

                                <table class="table table-profile">

                                    <tbody>
                                        <tr >
                                            <td class="field">Country</td>
                                            <td>
                                                <input type="text" name="country" class="form-control" placeholder="Country">
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">City/State</td>
                                            <td>
                                                <input type="text" name="city_state" class="form-control" placeholder="City/State" >       
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Hotel Name</td>
                                            <td>
                                                <input type="text" name="hotel" class="form-control" placeholder="Hotel Name" ng-model="mapdata.hotel">     
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Address</td>
                                            <td>
                                                <input type="text" name="address" class="form-control" placeholder="Address" ng-model="mapdata.address">
                                            </td>
                                        </tr>

                                        <tr >
                                            <td class="field">Contact No.</td>
                                            <td>
                                                <input type="text" name="contact_no" class="form-control" placeholder="Contact No.">                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="field">Select Dates</td>
                                            <td>
                                                
                                                    <div id="advance-daterange" class="btn btn-white">
                                                        <span></span>
                                                        <i class="fa fa-angle-down fa-fw"></i>
                                                    </div> 
                                                    <input type="hidden" id="start_date" name="start_date" value="<?php echo date("Y-m-d"); ?>">
                                                    <input type="hidden" id="end_date" name="end_date" value="<?php echo date("Y-m-d"); ?>">
                                                    <button type="submit" class="btn btn-warning" name="set_date">Set Dates</button>
                                               
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                 </form>
                            </div>
                            <!-- end table -->


                            <!-- begin table -->
                            <div class="table-responsive">

                                <table class="table table-profile">

                                    <tbody>

                                        <tr >

                                            <td colspan="2">
                                                <table style="    width: 500px;" class="table">
                                                    <tr>
                                                        <td colspan="3">
                                                            <p class="text-danger">Note: You can change appointment time after add the appointment.</p>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <div class="col-md-5">
                        <h4><i class="fa fa-cog"></i> <button class="btn btn-success" ng-click="viewOnModal()">View Map</button></h4>

                        <iframe  frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'  height="400px" width="100%" id='mapifram'  src="https://maps.google.com/?q=<?php echo $appointment['hotel']; ?>+<?php echo $appointment['address']; ?>&output=embed">
                        </iframe> 

                    </div>
                </div>



            </div>
            <!-- end profile-section -->
            <!-- begin profile-section -->
        </div>
    </div>
</section>


<script src="<?php echo base_url(); ?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<!--datepicker-->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!--end of datepicker-->
<script>
                            Admin.controller('AppointmentController', function ($scope, $http, $filter, $timeout) {
                                $scope.mapdata = {'address': '', 'hotal': '', 'url': ''};
                                $scope.viewOnModal = function () {
                                    $("#mapifram").attr("src", "https://maps.google.com/?q=" + $scope.mapdata.hotel + "+" + $scope.mapdata.address + "&output=embed")
                                }

                                var startdate = "<?php echo date("Y-m-d"); ?>";
                                var enddate = "<?php echo date("Y-m-d"); ?>";
                                $('#advance-daterange span').html(moment(startdate).format('DD MMMM YYYY') + ' - ' + moment(enddate).format('DD MMMM YYYY'));
                                $('#advance-daterange').daterangepicker({
                                    format: 'YYYY-MM-DD',
                                    startDate: startdate,
                                    endDate: enddate,
                                    // minDate: startdate,
//        maxDate: '<?php echo date('Y-m-d') ?>',
//        dateLimit: { days: 60 },
                                    showDropdowns: true,
                                    showWeekNumbers: true,
                                    timePicker: false,
                                    timePickerIncrement: 1,
                                    timePicker12Hour: true,
                                    opens: 'right',
                                    drops: 'down',
                                    buttonClasses: ['btn', 'btn-sm'],
                                    applyClass: 'btn-primary',
                                    cancelClass: 'btn-default',
                                    separator: ' to ',
                                    locale: {
                                        applyLabel: 'Submit',
                                        cancelLabel: 'Cancel',
                                        fromLabel: 'From',
                                        toLabel: 'To',
                                        customRangeLabel: 'Custom',
                                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                        firstDay: 1
                                    }
                                }, function (start, end, label) {
                                    $("#start_date").val(start.format('YYYY-MM-DD'));
                                    $("#end_date").val(end.format('YYYY-MM-DD'));
                                    $('#advance-daterange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
                                });
                            })
</script>
<?php
$this->load->view('layout/footer');
?> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
                            $(function () {
                                $('.edit_detail').hide();
                                $("#edit_toggle").click(function () {
                                    $('.edit_detail').hide();
                                    if (this.checked) {
                                        $('.edit_detail').show();
                                    }
                                })

                                $('.edit_detail').click(function (e) {
                                    e.stopPropagation();
                                    e.preventDefault();
                                    $($(this).prev()).editable('toggle');
                                });
                                $('.time_data').editable({
                                    source: {
<?php
$timeselection = [
    '06:00 AM',
    '06:30 AM',
    '07:00 AM',
    '07:30 AM',
    '08:00 AM',
    '08:30 AM',
    '09:00 AM',
    '09:30 AM',
    '10:00 AM',
    '10:30 AM',
    '11:00 AM',
    '11:30 AM',
    '12:00 PM',
    '01:00 PM',
    '01:30 PM',
    '02:00 PM',
    '02:30 PM',
    '03:00 PM',
    '04:30 PM',
    '05:00 PM',
    '05:30 PM',
    '06:00 PM',
    '06:30 PM',
    '07:00 PM',
    '07:30 PM',
    '08:00 PM',
    '08:30 PM',
    '09:00 PM',
    '09:30 PM',
    '10:00 PM',
    '10:30 PM',
    '11:00 PM',
    '11:30 PM',
];
foreach ($timeselection as $key => $value) {
    echo "'$value':'$value',";
}
?>
                                    }
                                });
                                $('#profession').editable({
                                    source: {
                                        'Academic': 'Academic',
                                        'Medicine': 'Medicine',
                                        'Law': 'Law',
                                        'Banking': 'Banking',
                                        'IT': 'IT',
                                        'Entrepreneur': 'Entrepreneur',
                                        'Sales/Marketing': 'Sales/Marketing',
                                        'Other': 'Other',
                                    }
                                });
                                $('#country').editable({
                                    source: {
<?php ?>

                                    }
                                });
                            })
</script>