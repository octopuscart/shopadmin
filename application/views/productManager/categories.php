<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/treejs/themes/default/style.min.css">
<script src="<?php echo base_url(); ?>assets/treejs/jstree.min.js"></script>
<style>
    .product_image{
        height: 100px!important;
        width: 100px!important;
        float: left;
        margin: 5px;
        padding: 5px;
        border: 3px solid #9E9E9E;
        cursor: pointer;
    }

    .product_image:hover{
        border: 3px solid #000;
    }
    .product_image_back{
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 100px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }
</style>
<!-- Main content -->
<section class="content" ng-controller="category_controller">
    <div class="row">

        <!--list of category-->
        <div class='col-md-6'>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <div id="using_json_2" class="demo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end of list category-->


        <!--add category-->
        <div class='col-md-6'>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Add/Edit Category</h3>
                </div>
                <div class="panel-body">


                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Parent Category</label><br/>
                            <span class='categorystring'>{{selectedCategory.category_string}}</span>

                            <button id='editbutton' ng-click="editData()" type='button' class='btn btn-default btn-sm cat_button' style='margin-left:15px;'>
                                <i class='fa fa-edit'></i>
                            </button>
                            <a id='deletebutton'  ng-click="deleteData(selectedCategory.selected.id)" ng-if="selectedCategory.selected.children.length == 0"  type='button' class='btn btn-default btn-sm cat_button'>
                                <i class='fa fa-trash'></i>
                            </a>

                            <input type='hidden' id='parent_id' value='0' name='parent_id' ng-model="selectedCategory.category.parent_id">
                        </div>
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input  type="text" class="form-control" name="category_name" id="category_name"  placeholder="Category Name" ng-model="selectedCategory.category.category_name">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control"  name="description" id="description" placeholder="Description" ng-model="selectedCategory.category.description">
                        </div>
                        <div class="row">
                            <div class="col-md-3">

                                <input type="text" class="form-control"  name="image" id="description" placeholder="Image" ng-model="selectedCategory.category.image" style="display: none">

                                <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/media/"); ?>{{selectedCategory.category.image}})" ng-if="selectedCategory.category.image">
                                </div>

                                <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets/default/default.png"); ?>)" ng-if="!selectedCategory.category.image">
                                </div>


                            </div>
                            <div class="col-md-3" style="margin: 33px 0px;">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                    Choose Image
                                </button>
                            </div>
                        </div>
                        <br/>
                        <button id='submit_button' type="submit" name="submit" class="btn btn-primary" value="{{selectedCategory.operation}}">{{selectedCategory.operation}}</button>
                        <button id='submit_button' type="button"  class="btn btn-warning" ng-click="cencel()">Cancel</button>

                    </form>
                </div>
            </div>
        </div>
        <!--end of add category-->

    </div>



    <!--image model-->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Images</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                        foreach ($images as $key => $value) {
                            ?>
                            <div class="">
                                <div class="product_image product_image_back" ng-click="selectImage('<?php echo $value->image;?>')" style="background: url(<?php echo (base_url() . "assets/media/" . $value->image); ?>)">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end of image model-->


</section>
<!-- end col-6 -->
</div>


<?php
$this->load->view('layout/footer');
?> 

<script>
    var jsondata;
    var selectedcategory;

    Admin.controller('category_controller', function ($scope, $http, $filter, $timeout) {
        $scope.selectedCategory = {
            "selected": {}, "parents": [],
            "category_string": "Main Category",
            "category": {'parent_id': '0', 'category_name': '', 'description': '', 'id': '', "image": ""},
            "operation": "Add Category"
        };
        
        $scope.selectImage = function(image){
            console.log(image)
            $scope.selectedCategory.category.image = image;
            $("#myModal").modal("hide");
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


        $(document).on("click", "[selectcategory]", function (event) {
            var catid = $(this).attr("selectcategory");
            var objdata = $('#using_json_2').jstree('get_node', catid);
            var catlist = objdata.parents;

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
        })

        //edit data
        $scope.editData = function () {
            console.log($scope.selectedCategory.selected.id);
            $scope.selectedCategory.operation = "Edit";
            var cobj = $scope.categorydata.list[$scope.selectedCategory.selected.id];
            $scope.selectedCategory.category.parent_id = cobj.id;
            $scope.selectedCategory.category.category_name = cobj.text;
            $scope.selectedCategory.category.description = cobj.description;
            $scope.selectedCategory.category.image = cobj.image;
        }
        //edit data



        //delete data
        $scope.deleteData = function (cateid) {
            var url = "<?php echo base_url(); ?>index.php/ProductManager/categorie_delete/" + cateid;
            $http.get(url).then(function (rdata) {
                window.location.reload();
            })
        }
        //end of delete data


    })


</script>