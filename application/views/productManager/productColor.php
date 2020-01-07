<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/treejs/themes/default/style.min.css">
<script src="<?php echo base_url(); ?>assets/treejs/jstree.min.js"></script>
<style>
    .page_navigation a {
        padding: 5px 10px;
        border: 1px solid #000;
        margin: 5px;
        background: #000;
        color: white;
    }
    .page_navigation a.active_page {
        padding: 5px 10px;
        border: 1px solid #000;
        margin: 5px;
        background: #fff;
        color: black;
    }
    .colordiv_box{
        width:100%;
        height: 20px;
    }
    .colordiv_product{
        padding: 10px;
        float: left;
    }
</style>
<!-- Main content -->
<section class="content" ng-controller="category_controller">
    <div class="row">

        <!--list of category-->
        <div class='col-md-2'>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div id="using_json_2" class="demo">
                        </div>
                    </div>

                </div>

            </div>


            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Bulk Change</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="#">
                        <div ng-if="selectedCategory2.selected_color">
                            <div class="colordiv" style="background:  {{colorlist[selectedCategory2.selected_color]['code']}};    padding: 20px;    border: 1px solid #000;"></div>
                            <p class="textoverflow text-center">{{colorlist[selectedCategory2.selected_color]['title']}}</p>
                        </div>
                        <input type="hidden" name="color_id" value="{{selectedCategory2.selected_color}}">

                        <input type="hidden" name="color_code" value="{{colorlist[selectedCategory2.selected_color]['code']}}">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 productitem" style="padding-bottom: 10px;" id="{{product.id}}" atrindex ="{{$index}}" atrd_index ="{{product.display_index}}" ng-repeat="product in productdata.products| filter : {
                                    checked:'true'
                                    }">
                                <span class="badge"> {{product.title}}</span>
                                <input type="hidden" name="product_id[]" value="{{product.id}}">
                            </div>
                        </div>
                        <br/>



                        <div class="btn-group btn-group-sm" role="group" aria-label="..."  ng-if="selectedCategory2.selected_color">
                            <button type="submit" name="apply_category" value="apply" class="btn btn-default">Apply</button>
                        </div>
                    </form>

                </div>
            </div>





        </div>
        <!--end of list category-->

        <div class="col-md-3">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Colors</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php foreach ($colorslist as $key => $value) { ?>

                            <label class="col-md-3" style="background:<?php echo $value->code; ?>;padding:15px;" title="<?php echo $value->title; ?>">
                                <input type="radio" ng-model="selectedCategory2.selected_color" name="color_id" value="<?php echo $value->id; ?>" ><br/>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" style="    padding: 10px;">
                    <li>
                        <h5>{{selectedCategory.category_string}}</h5>
                    </li>
                    <li class="pull-right">

                        <div class="input-group pull-right" style="width: 300px;    margin-top: 2px;">
                            <span class="input-group-addon" id="basic-addon1">Search Product</span>
                            <input type="text" class="form-control" placeholder="Type hear..." ng-model="searchproduct">
                        </div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="row" id="sortable">
                        <div class="col-sm-6 col-md-3 productitem" id="{{product.id}}" atrindex ="{{$index}}" atrd_index ="{{product.display_index}}" ng-repeat="product in productdata.products| filter : {
                                    title:searchproduct
                                    }">
                            <div class="thumbnail">
                                <img src="{{product.image}}" alt="..." style="height: 150px">
                                <div class="caption">
                                    <h3>{{product.title}}</h3>
                                    <div class="colordiv_box">
                                        <div class="colordiv_product" ng-repeat="colorl in product.colors" style="background:{{colorl.attribute_value}};padding:10px;"></div>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <label>
                                            <input type="checkbox"  aria-label="..." ng-model="product.checked"> Check This
                                        </label>
                                    </div><!-- /input-group -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--            <div class="col-md-12" id="paging_container12">
                                    <div class="showing-info">
                                        <p class="text-center"><span class="info_text ">Showing {0}-{1} of {2} results</span></p>
                                    </div>
                    
                                     Item 
                                    <div class="col-sm-4 animated zoomIn"  ng-repeat="k in productdata.productscounter">
                                        {{k}}
                                    </div>
                    
                                    <center>
                                        <div class="page_navigation"></div>
                                    </center>
                                    <div style="clear: both"></div>
                                </div>-->
                </div>
                <!-- /.tab-content -->
            </div>

            <div class="modal fade" id="categorymodel" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="box-title">Change Categories</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <div id="using_json_3" class="demo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>



    </div>
</section>
<!-- end col-6 -->
</div>



<?php
$this->load->view('layout/footer');
?> 

<script src="<?php echo base_url(); ?>assets/dist/jquery.pajinate.min.js"></script>

<script>
                                                var jsondata;
                                                var selectedcategory;
                                                Admin.controller('category_controller', function ($scope, $http, $filter, $timeout) {
                                                    $scope.selectedCategory = {"selected": {}, "parents": [],
                                                        "category_string": "Main Category",
                                                        "category_string2": "Main Category",
                                                        "category": {'parent_id': '0', 'category_name': '', 'description': '', 'id': ''},
                                                        "operation": "Add Category",
                                                        "selected_category": 0
                                                    };

                                                    $scope.colorlist = {};
                                                    var colorjson = <?php echo json_encode($colorslist); ?>;
                                                    for (color in colorjson) {
                                                        console.log(color);
                                                        var colorobj = colorjson[color];
                                                        $scope.colorlist[colorobj['id']] = colorobj;
                                                    }



                                                    var url = "<?php echo base_url(); ?>index.php/ProductManager/category_api";
                                                    $http.get(url).then(function (rdata) {
                                                        $scope.categorydata = rdata.data;
                                                        $('#using_json_2').jstree({'core': {
                                                                'data': $scope.categorydata.tree
                                                            }});

                                                    })

                                                    $scope.resetData = function () {
                                                        $scope.selectedCategory.operation = "Add Category";
                                                        $scope.selectedCategory.category.parent_id = '0';
                                                        $scope.selectedCategory.category.category_name = '';
                                                        $scope.selectedCategory.category.description = '';
                                                    }

                                                    $scope.cencel = function () {
                                                        $scope.resetData();
                                                    }

                                                    $(document).on("click", "#using_json_2 [selectcategory]", function (event) {
                                                        var catid = $(this).attr("selectcategory");
                                                        var objdata = $('#using_json_2').jstree('get_node', catid);
                                                        var catlist = objdata.parents;
                                                        $scope.selectedCategory.selected_category = catid;
                                                        $scope.getProducts(catid);
                                                        $scope.resetData();
                                                        $timeout(function () {
                                                            $scope.selectedCategory.selected = objdata;
                                                            var catsst = [];
                                                            for (i = catlist.length + 1; i >= 0; i--) {
                                                                var catid = catlist[i];
                                                                var catstr = $scope.categorydata.list[catid];
                                                                if (catstr) {
                                                                    catsst.push(catstr.text);
                                                                }
                                                            }
                                                            catsst.push(objdata.text);
                                                            $("#parent_id").val(objdata.id);
                                                            $scope.selectedCategory.category_string = catsst.join("->")
                                                        }, 100)
                                                    });



                                                    //end of delete data
                                                    $scope.selectedCategory2 = {"selected": {}, "parents": [],
                                                        "category_string": "Main Category",
                                                        "category_string2": "Main Category",
                                                        "category": {'parent_id': '0', 'category_name': '', 'description': '', 'id': ''},
                                                        "operation": "Add Category",
                                                        "selected_color": 0
                                                    };

                                                    $scope.productdata = {'products': [], 'product_count': 0, 'productscounter': [], 'selectedproduct': {}, };
                                                    $scope.getProducts = function (category_id) {
                                                        var url = "<?php echo base_url(); ?>index.php/ProductManager/productSortingApi/" + category_id;
                                                        $http.get(url).then(function (rdata) {
                                                            $scope.productdata.products = rdata.data.products;
                                                            $scope.productdata.product_count = rdata.data.total_products;
                                                            var totalcountdata = rdata.data.total_products;
                                                            var productscounter = [];
                                                            for (i = 1; i <= totalcountdata; i++) {
                                                                productscounter.push(i);
                                                            }

                                                            $scope.productdata.productscounter = productscounter;
                                                            $timeout(function () {
                                                                $('#paging_container12').pajinate({
                                                                    items_per_page: 12,
                                                                    num_page_links_to_display: 5,
                                                                });
                                                            }, 1500)
                                                        });
                                                    }

                                                    $scope.getProducts(45)




                                                })


</script>

