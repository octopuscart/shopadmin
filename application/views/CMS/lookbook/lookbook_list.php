<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');

function truncate($str, $len) {
    $tail = max(0, $len - 10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len - $tail))));
    return $trunk;
}
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->

<link href="<?php echo base_url(); ?>assets/plugins/isotope/isotope.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>

<style>
    .gallery .image img {
        width: 100%;
        height: auto; 
        -webkit-border-radius: 3px 3px 0 0;
        -moz-border-radius: 3px 3px 0 0;
        border-radius: 3px 3px 0 0;
    }

    a.tag_style {
        padding: 2px 4px;
        background: black;
        color: white;
        border-radius: 6px;
        font-size: 10px;
    }

    .gallery .desc {
        margin-top: 12px;
    }
</style>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Look Book List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Your Blogs <small></small></h1>
    <!-- end page-header -->

<!--    <div id="options" class="m-b-10">
        <span class="gallery-option-set" id="filter" data-option-key="filter">
            <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
                Show All
            </a>
            <a href="#gallery-group-1" class="btn btn-default btn-xs" data-option-value=".gallery-group-1">
                Gallery Group 1
            </a>
            <a href="#gallery-group-2" class="btn btn-default btn-xs" data-option-value=".gallery-group-2">
                Gallery Group 2
            </a>
            <a href="#gallery-group-3" class="btn btn-default btn-xs" data-option-value=".gallery-group-3">
                Gallery Group 3
            </a>
            <a href="#gallery-group-4" class="btn btn-default btn-xs" data-option-value=".gallery-group-4">
                Gallery Group 4
            </a>
        </span>
    </div>-->
    <div id="gallery" class="gallery">


        <?php
        foreach ($blog_data as $key => $value) {
            ?>   
            <div class="image gallery-group-1">
                <div class="image-inner">
                    <a href="<?php echo base_url(); ?>assets/lookbook_images/<?php echo $value['image']; ?>" data-lightbox="gallery-group-1">
                        <img src="<?php echo base_url(); ?>assets/lookbook_images/<?php echo $value['image']; ?>" alt="" />
                    </a>

                </div>
                <div class="image-info">
                    <h5 class="title"><a href='<?php echo site_url('CMS/lookbookDetails/' . $value['id']); ?>'><?php echo truncate($value['title'], 100); ?></a></h5>
             

                    <div class="desc" style="height: auto">
                        <?php echo truncate($value['description'], 200); ?>                
                    </div>
                    <hr style="margin:5px 0px;"/>
                    <a href="<?php echo site_url('CMS/lookbookDetails/' . $value['id']); ?>" class="" style='margin-top: 10px;'><i class='fa fa-edit'></i> Edit</a>

                </div>
            </div>
            <?php
        }
        ?>




    </div>
</div>
<!-- end #content -->


<?php
$this->load->view('layout/footer');
?>
<script>
    $(function () {


        function calculateDivider() {
            var dividerValue = 4;
            if ($(this).width() <= 480) {
                dividerValue = 1;
            } else if ($(this).width() <= 767) {
                dividerValue = 2;
            } else if ($(this).width() <= 980) {
                dividerValue = 3;
            }
            return dividerValue;
        }
        var handleIsotopesGallery = function () {
            "use strict";
            $(window).load(function () {
                var container = $('#gallery');
                var dividerValue = calculateDivider();
                var containerWidth = $(container).width() - 20;
                var columnWidth = containerWidth / dividerValue;
                $(container).isotope({
                    resizable: true,
                    masonry: {
                        columnWidth: columnWidth
                    }
                });

                $(window).smartresize(function () {
                    var dividerValue = calculateDivider();
                    var containerWidth = $(container).width() - 20;
                    var columnWidth = containerWidth / dividerValue;
                    $(container).isotope({
                        masonry: {
                            columnWidth: columnWidth
                        }
                    });
                });

                var $optionSets = $('#options .gallery-option-set'),
                        $optionLinks = $optionSets.find('a');

                $optionLinks.click(function () {
                    var $this = $(this);
                    if ($this.hasClass('active')) {
                        return false;
                    }
                    var $optionSet = $this.parents('.gallery-option-set');
                    $optionSet.find('.active').removeClass('active');
                    $this.addClass('active');

                    var options = {};
                    var key = $optionSet.attr('data-option-key');
                    var value = $this.attr('data-option-value');
                    value = value === 'false' ? false : value;
                    options[ key ] = value;
                    $(container).isotope(options);
                    return false;
                });
            });
        };


        var Gallery = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleIsotopesGallery();
                }
            };
        }();

        Gallery.init();


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

<script>
    $(document).ready(function () {


    });
</script><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

