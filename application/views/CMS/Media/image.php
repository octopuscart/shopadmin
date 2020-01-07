<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/treejs/themes/default/style.min.css">

<script src="<?php echo base_url(); ?>assets/treejs/jstree.min.js"></script>
<style>
    .product_image{

    }
    .product_image_back{
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 200px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }
    .imagelist{
        height: 223px!important;
        /* border: 1px solid #e9eef1; */
        border-radius: 5px;
        margin: 10px 0px;
    }
</style>
<!-- Main content -->
<section class="content" ng-controller="productController">
    <div class="">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title">Add Images</h3>
            </div>
            <div class="panel-body">



                <?php echo $this->session->flashdata('success_msg'); ?>
                <?php echo $this->session->flashdata('error_msg'); ?>
                <form action="#" method="post" enctype="multipart/form-data">


                    <!--pictures-->
                    <div class="row">
                        <div class="col-md-2 imagelist">
                            <div class="thumbnail">
                                <div class=" product_image_back" style="background: url(<?php echo (base_url() . "assets/default/default.png"); ?>);height: 100px!important;"></div>
                                <div class="caption">
                                    <div class="form-group">
                                        <label for="image1">Upload Primary Image</label>
                                        <input type="file" name="picture" required="" />           
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($image_list as $imk => $imv) {
                            ?>
                            <div class="col-md-2 imagelist">
                                <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/media/" . $imv->image); ?>)"></div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!--pictures-->

                </form>


                <div class="row">

                </div>

            </div>
        </div>


    </div>

</section>
<!-- end col-6 -->










<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
<?php
$this->load->view('layout/footer');
?> 
<script>
    $(function () {

    });

</script>

<script>
    Admin.controller('productController', function ($scope, $http, $filter, $timeout) {


    })




</script>

