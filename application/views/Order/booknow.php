<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<style>
    .datepicker-inline {
        /*width: 450px;*/
        display: contents;
    }
    .datepicker table{
        /*width:100%;*/
    }
    .datepicker td, .datepicker th {
        padding: 5px;
        color: black;
    }
    .datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:focus, .datepicker table tr td.active:hover:focus, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .open .dropdown-toggle.datepicker table tr td.active, .open .dropdown-toggle.datepicker table tr td.active:hover, .open .dropdown-toggle.datepicker table tr td.active.disabled, .open .dropdown-toggle.datepicker table tr td.active.disabled:hover {
        color: #ffffff;
        background-color: #000000;
        border-color: #151515;
    }

    .btnbooking{
        background: black!important;
        border-color: black!important;
        border-radius: 15px;
    }
    .button_plus{
        border-radius: 15px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        background: black!important;
        border-color: black!important;
    }

    .button_minus{
        border-radius: 15px;
        border-top-right-radius:  0;
        border-bottom-right-radius: 0;
        background: black!important;
        border-color: black!important;
    }

    span.booking_lable {
        font-size: 16px;
        color: black;
    }

    .form-row{
        /*        border-bottom: 1px solid #000;
                padding-bottom: 15px;*/
        padding: 10px;
        clear: both;
    }

    .stimeslot .btn {
        float: left;
        padding: 5px;
        margin: 5px;
        background: black;
        color: white;
        border-radius: 15px;
        font-size: 12px;
    }

    .tabimage{
             height: 40px!important;
    }

    .tabtitle{
        margin-bottom: 0px;
        font-size: 12px;
        color: black;
        text-align: center;
    }
    .titleblockwix {
        float: left;
        width: 100%;
        background: black;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        margin-top: 20px;
        padding:10px;
    }

    .tableimg{
         
            height: 40px!important;
    }
    .tabletop {
      
        background: #ececec;
        display:  inline-block;
     
        text-align: center;
        border: 3px solid #ececec;
    }

    .tabletop:hover{
        border: 3px solid black;
    }

    .tabletop.active {
        border: 3px solid #000000;
    }

    .nav-tabs {
        border-bottom: 1px solid #000000;
    }
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #495057;
        background-color: #fff;
        border-color: #000000 #000000 #fff;
    }

    .userloginform{
        padding: 10px 40px;
        background: #f6f6f6;
        border-radius: 32px;
        margin:20px 50px;
    }
    
    .mb-3{
        margin-bottom: 10px;
    }

</style>

<script>




</script>

<div id="content" class="content">
    <section class="" style="min-height: auto;" ng-controller="bookingController">

        <div class="content-wrap" style="padding: 0px;">

            <div class="panel panel-inverse" data-sortable-id="index-10">
                <div class="panel-heading">
                    <h4 class="panel-title">For Telephonic/Walkin Guests</h4>
                </div>
                <div class="panel-body">

                    <div class="row clearfix" style="    width: fit-content;">

                                <div class="p-5rounded bg-white" style="width: 800px;
                                     padding: 15px;">
                                    <h3 class="font-secondary h1 color">Book At Restaurants</h3>

                                    <div class=" mt-4 mt-lg-0" >
                                        <div class="form-result"></div>
                                        <form class="mb-0 row"  action="#" method="post" >
                                            <div class="form-process"></div>
                                            <div class="col-sm-4 mb-3">
                                                <input type="text" id="template-contactform-name" name="name" value="" class="form-control border-form-control required" placeholder="Name" required="">
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                <input type="email" id="template-contactform-email" name="email" value="" class="required email form-control border-form-control" placeholder="Email Address" required="">
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col-sm-4 mb-3">
                                                <input type="text" id="template-contactform-phone" name="contact" value="" class="form-control border-form-control required" placeholder="Contact No." required="">
                                            </div>
                                            <div class="col-sm-6 mb-3 input-daterange travel-date-group">
                                                <input type="date" id="template-contactform-subject" name="select_date" value="" class="form-control border-form-control  required" placeholder="Select Reservation Date" min="<?php echo date('Y-m-d');?>" required="">
                                            </div>
                                            <div class="clear"></div>
                                            <div class="col-md-6 mb-3">
                                                <select id="template-contactform-time" class="custom-select form-control border-form-control" name="select_time" required="">
                                                    <option value="disabled" disabled="" selected="">Select Time</option>
                                                    <option value="12:00">12:00 - 13:00</option>
                                                    <option value="13:00">13:00 - 14:00</option>
                                                    <option value="14:00">14:00 - 15:00</option>
                                                    <option value="18:00">18:00 - 19:00</option>
                                                    <option value="19:00">19:00 - 20:00</option>
                                                    <option value="20:00">20:00 - 21:00</option>
                                                    <option value="21:00">21:00 - 22:00</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <select id="template-contactform-people" class="custom-select form-control border-form-control" name="people" required="">
                                                    <option value="disabled" disabled="" selected=""  >Person</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6+</option>
                                                </select>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-md-6 mb-3">
                                                <select id="template-contactform-time" class="custom-select form-control border-form-control" name="order_source" required="">
                                                    <option value="disabled" disabled="" selected="">Select Source</option>
                                                    <option value="Quandoo">Quandoo</option>
                                                    <option value="Chope">Chope</option>
                                                    <option value="Openrice">Openrice</option>
                                                    <option value="Woodlands Website">Woodlands Website</option>
                                                    <option value="Telephonic">Telephonic</option>
                                                    <option value="Walkin Guests">Walkin Guests</option>
                                                   
                                                </select>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <textarea id="template-contactform-phone" name="extra_remark" value="" class="form-control border-form-control required" placeholder="Remark" ></textarea>
                                            </div>
                                            
                                            <div class="clear"></div>
                                            <div class="col-md-12 nobottommargin">
                                                <button class="button button-circle btn btn-lg text-white ml-0 mt-3 colordarkgreen btn btn-primary" type="submit" name="booknow" value="submit">Book Now</button>
                                            </div>
                                            <div class="clear"></div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

        </div>



        <!-- Modal -->
        <div class="modal fade" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="thanksModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thanks you for booking.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2>
                            Thank You for giving us the opportunity to serve you.<br/> We will do our best to be sure you enjoy our services.
                        </h2>

                        <figure class="figure" style="    width: 100%;margin-top: 20px;
                                text-align: center;">
                            <img src="<?php echo base_url(); ?>assets/images/logo50.png" class="figure-img img-fluid rounded" alt="Baan Thai" style="height:40px">
                            <figcaption class="figure-caption">The signature flavors of authentic Thai cuisine.</figcaption>
                        </figure>

                    </div>

                </div>
            </div>
        </div>


        <script>

<?php
if ($submitdata == 'yes') {
    ?>
                $(function () {
                let newmail = new Audio("<?php echo base_url(); ?>assets/sound/sendemail.mp3");
                newmail.play();
                $("#thanksModal").modal("show");
                $('#thanksModal').on('hidden.bs.modal', function (e) {
                //            window.location = "<?php echo site_url('booknow'); ?>";
                });
                })
    <?php
}
?>



        </script>



    </section>
</div>





<?php
$this->load->view('layout/footer');
?> 



<script>
    var baseurl = "<?php echo base_url(); ?>index.php/";
    var today = "<?php echo date('Y-m-d'); ?>";</script>
<script src="<?php echo base_url(); ?>assets/angular/booking.js"></script>
