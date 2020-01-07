<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<!-- begin #content -->
<!-- begin #content -->
<div id="content" class="content content-full-width">
    
     <h1 class="page-header">Site General SEO Attributes<small> Set the site title, keywords and description that is common for all the pages.</small></h1>
    
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
                  
                       
                      
                        <!-- end email to -->
                        <!-- begin email subject -->
                        <label class="control-label">Title:</label>
                        <div class="m-b-15">
                            <input type="text" value="<?php echo $site_data->seo_title;?>" class="form-control" name="title" required="" />
                        </div>
                        <!-- end email subject -->
                        <!-- begin email content -->
                        <label class="control-label">Description:</label>
                        <div class="m-b-15">
                            <textarea  class="textarea form-control"   rows="8" name="description" required=""><?php echo $site_data->seo_desc;?></textarea>
                        </div>

                        <!--tags-->
                          <label class="control-label">Keywords:</label>
                        <div class="m-b-15">
                            <textarea  class="textarea form-control"   rows="8" name="keyword" required=""><?php echo $site_data->seo_keywords;?></textarea>
                        </div>


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
<script>
    function changeCategory(cat_name, cat_id){
    $("#category_name").text(cat_name);
    $("#category_id").val(cat_id);
}
    
    $(function () {


        $('#tags').tagit({
            availableTags: <?php echo json_encode($tags); ?>
        });






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