<?php
$this->load->view('layout/layoutTop');
?>
<style>
    .product_text {
        float: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width:100px
    }
    .product_title {
        font-weight: 700;
    }
    .price_tag{
        float: left;
        width: 100%;
        border: 1px solid #222d3233;
        margin: 2px;
        padding: 0px 2px;
    }
    .price_tag_final{
        width: 100%;
    }
    .sub_item_table tr{
        border-bottom: 1px solid #dbd3d3;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Product Reports</h3>
            </div>
            <div class="box-body">
                <table id="tableData" class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 20px;">S.N.</th>
                            <th style="width:50px;">Image</th>
                            <th style="width:150px;">Category</th>
                            <th style="width:100px;">Title</th>
                            <th style="width:200px;">Short Description</th>
                            <th >Items Prices</th>
                            <th >Stock Status</th>
                            <th style="width: 75px;">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($product_data)) {
                            $count = 1;
                            foreach ($product_data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td>
                                        <img src="<?php echo product_image_base . 'coman/output/' . $value['folder']; ?>/cutting20001.png" style="height:51px;">
                                    </td>
                                    <td >
                                        <span class="">
                                            <?php
                                            $catarray = $product_model->parent_get($value['category_id']);
                                            echo $catarray['category_string'];
                                            ?>
                                        </span>
                                    </td>
                                    <td >
                                        <?php echo $value['title']; ?>
                                    </td>
                                    <td >

                                        <?php echo $value['short_description']; ?>
                                    </td>
                                    <td style="width:200px;">
                                        <table class='sub_item_table'>
                                            <?php
                                            $itemsprice = $value['items_price'];
                                            foreach ($itemsprice as $iikey => $iivalue) {
                                                echo "<tr><td>" . ($iivalue->item_name) . "</td><td>: {{" . ($iivalue->price) . "|currency:''}}</td></tr>";
                                            }
                                            ?>
                                        </table>
                                    </td>
                                    <td >
                                        <span class="">
                                            <?php echo $value['stock_status']; ?>
                                        </span>
                                    </td>
                                    <td >
                                        <a href="<?php echo site_url('ProductManager/edit_product/' . $value['id']); ?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</section>
<!-- end col-6 -->
</div>


<?php
$this->load->view('layout/layoutFooter');
?> 
<script>
    $(function () {

        $('#tableData').DataTable({
            "ajax": {
                url: "<?php echo site_url("ProductManager/productReportApi") ?>",
                type: 'GET'
            },
        })
    })

</script>