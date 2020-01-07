<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>    

<?php
$appointmentdate = $appointmentData['date_time_list'];
$appointment = $appointmentData['appointment'];
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
        <h1 class="page-header"><?php echo $appointment['hotel']; ?>, <?php echo $appointment['country']; ?> <br/><small>(<?php echo $appointment['days']; ?>)</small></h1>
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
                                <table class="table table-profile">

                                    <tbody>
                                        <tr >
                                            <td class="field">Country</td>
                                            <td>
                                                <span id="country" data-type="text" data-pk="<?php echo $appointment['aid']; ?>" data-name="country" data-value="<?php echo $appointment['country']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Country" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_country" > <?php echo $appointment['country']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">City/State</td>
                                            <td>
                                                <span id="city_state" data-type="text" data-pk="<?php echo $appointment['aid']; ?>" data-name="city_state" data-value="<?php echo $appointment['city_state']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter City/State" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#city_state" > <?php echo $appointment['city_state']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Hotel Name</td>
                                            <td>
                                                <span id="hotel" data-type="text" data-pk="<?php echo $appointment['aid']; ?>" data-name="hotel" data-value="<?php echo $appointment['hotel']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Hotel Name" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_hotel" > <?php echo $appointment['hotel']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td class="field">Address</td>
                                            <td>
                                                <span id="address" data-type="textarea" data-pk="<?php echo $appointment['aid']; ?>" data-name="address" data-value="<?php echo $appointment['address']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Address" class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_address" > <?php echo $appointment['address']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>

                                        <tr >
                                            <td class="field">Contact No.</td>
                                            <td>
                                                <span id="contact_no" data-type="text" data-pk="<?php echo $appointment['aid']; ?>" data-name="contact_no" data-value="<?php echo $appointment['contact_no']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointment"); ?>" data-original-title="Enter Contact No." class="m-l-5 editable editable-click" tabindex="-1" data-toggle="#edit_contact_no" > <?php echo $appointment['contact_no']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="field">Select Dates</td>
                                            <td>
                                                <form action="#" method="post">
                                                    <div id="advance-daterange" class="btn btn-white">
                                                        <span></span>
                                                        <i class="fa fa-angle-down fa-fw"></i>
                                                    </div> 
                                                    <input type="hidden" id="start_date" name="start_date" value="<?php echo $appointment['start_date']; ?>">
                                                    <input type="hidden" id="end_date" name="end_date" value="<?php echo $appointment['end_date']; ?>">
                                                    <button type="submit" class="btn btn-warning" name="set_date">Set Dates</button>
                                                </form>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
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
                                                            <p class="text-danger">Note: If you change date(s), You would have to change time.</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Date</th>
                                                        <th>From Time</th>
                                                        <th>To Time</th>
                                                    </tr>

                                                    <?php
                                                    foreach ($appointmentdate as $key => $value) {
                                                        ?>

                                                        <tr>
                                                            <td>
                                                                <?php echo $value['date']; ?>

                                                            </td>
                                                            <td>
                                                                <span id="date1<?php echo $value['id']; ?>" data-type="select" data-pk="<?php echo $value['id']; ?>" data-name="from_time" data-value="<?php echo $value['from_time']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointmentTime"); ?>" data-original-title="From Time" class="m-l-5 editable editable-click time_data" tabindex="-1" data-toggle="#date1<?php echo $value['id']; ?>" > <?php echo $value['from_time']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                                            </td>
                                                            <td>
                                                                <span id="date2<?php echo $value['id']; ?>" data-type="select" data-pk="<?php echo $value['id']; ?>" data-name="to_time" data-value="<?php echo $value['to_time']; ?>" data-url="<?php echo site_url("LocalApi/updateAppointmentTime"); ?>" data-original-title="From Time" class="m-l-5 editable editable-click time_data" tabindex="-1" data-toggle="#date2<?php echo $value['id']; ?>" > <?php echo $value['to_time']; ?></span><button class="btn btn-xs btn-link edit_detail" ><i class="fa fa-pencil"></i>Edit</button>
                                                            </td>
                                                        </tr>



                                                        <?php
                                                    }
                                                    ?>
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
                        <h4><i class="fa fa-cog"></i> Settings</h4>
                        <div class="checkbox m-b-5 m-t-0" >
                            <label><input type="checkbox" id="edit_toggle" /> Edit Information</label>
                        </div>
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
        $scope.viewOnModal = function (address, hotel) {
            $("#mapifram").attr("src", "https://maps.google.com/?q=" + hotel + "+" + address + "&output=embed")
            $scope.mapdata.address = address;
            $scope.mapdata.hotel = hotel;
            console.log($scope.mapdata);
            $("#modal-dialog-map").modal("show")
        }

        var startdate = "<?php echo $appointment['start_date']; ?>";
        var enddate = "<?php echo $appointment['end_date']; ?>";
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
            opens: 'left',
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