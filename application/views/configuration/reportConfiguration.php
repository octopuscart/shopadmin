<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />

<!-- begin #content -->
<!-- begin #content -->
<div id="content" class="content content-full-width">

    <h1 class="page-header">Email/Reports System Templates<small></small></h1>

    <!-- begin vertical-box -->
    <div class="vertical-box">
        <!-- begin vertical-box-column -->

        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">

            <!-- begin wrapper -->
            <div class="wrapper">
                <div class="p-30 bg-white">

                    <!-- begin email form -->
                    <form action="#" method="post" enctype="multipart/form-data">
                        <!-- begin email to -->


                        <!--tags-->
                        <label class="control-label">Email Header:</label>
                        <div class="m-b-15">
                            <textarea  class="textarea form-control ckeditor"   rows="8" name="email_header" required=""><?php echo $configuration_report->email_header; ?></textarea>
                        </div>

                        <!-- begin email content -->
                        <label class="control-label">Email Footer:</label>
                        <div class="m-b-15">
                            <textarea  class="textarea form-control ckeditor"   rows="8" name="email_footer" required=""><?php echo $configuration_report->email_footer; ?></textarea>
                        </div>


                        <div class="m-b-15">
                            <label class="control-label">Report Header:</label>
                            <div class="m-b-15">
                                <textarea  class="textarea form-control ckeditor"   rows="8" name="pdf_report_header" required=""><?php echo $configuration_report->pdf_report_header; ?></textarea>
                            </div>
                        </div>
                        <!-- end email subject -->





                        <!-- end email content -->
                        <button type="submit" name="update_data" class="btn btn-primary p-l-40 p-r-40">Update</button>
                    </form>
                    <!-- end email form -->
                </div>
            </div>
            <!-- end wrapper -->
        </div>
        <!-- end vertical-box-column -->
    </div>
    <!-- end vertical-box -->
</div>
<!-- end #content -->


<?php
$this->load->view('layout/footer');
?>

<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/js/form-wysiwyg.demo.min.js"></script>


<script>
    function changeCategory(cat_name, cat_id) {
        $("#category_name").text(cat_name);
        $("#category_id").val(cat_id);
    }

    $(function () {


        $('#tags').tagit({
            availableTags: <?php echo json_encode($tags); ?>
        });



        FormWysihtml5.init();


<?php
$checklogin = $this->session->flashdata('checklogin');
if ($checklogin['show']) {
    ?>
            $.gritter.add({
                title: "<?php echo $checklogin['title']; ?>",
                text: "<?php echo $checklogin['text']; ?>",
                image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class '
                        });
    <?php
}
?>
                })
</script>

