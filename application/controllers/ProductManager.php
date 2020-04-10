<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class ProductManager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        $this->all_query();
    }

    ///Category management 
    public function category_api() {
        $this->db->select('c.id as id, c.image, c.category_name as text, p.id as parent, c.description');
        $this->db->join('category as p', 'p.id = c.parent_id', 'left');
        $this->db->from('category as c');
        $this->db->order_by('c.display_index  desc');
        $query = $this->db->get();
        $result = $query->result();
        $category = array();
        $categorylist = array();
        foreach ($result as $key => $value) {
            $cat = array('id' => $value->id,
                'parent' => $value->parent ? $value->parent : '#',
                'state' => array('opened' => TRUE),
                'description' => $value->description,
                'image' => $value->image,
                'a_attr' => array('selectCategory' => ($value->id)),
                'text' => $value->text);
            array_push($category, $cat);
            $categorylist[$value->id] = $cat;
        }
        echo json_encode(array('tree' => $category, 'list' => $categorylist));
    }

    //Add Categories
    function categorie_delete($category_id) {
        $this->db->delete('category', array('id' => $category_id));
    }

    //Add Categories
    function categories() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $this->db->select('c.id as id, c.category_name as text, p.id as parent');
        $this->db->join('category as p', 'p.id = c.parent_id', 'left');
        $this->db->from('category as c');
        $query = $this->db->get();

        $data['category_data'] = $query->result();

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add Category') {
                $category_array = array(
                    'category_name' => $this->input->post('category_name'),
                    'description' => $this->input->post('description'),
                    'parent_id' => $this->input->post('parent_id'),
                    'image' => $this->input->post('image')
                );
                $this->db->insert('category', $category_array);
            }
            if ($_POST['submit'] == 'Edit') {
                echo $id = $this->input->post('parent_id');
                $this->db->set('category_name', $this->input->post('category_name'));
                $this->db->set('description', $this->input->post('description'));
                $this->db->set('image', $this->input->post('image'));
                $this->db->where('id', $id);
                $this->db->update('category');
            }
            redirect('ProductManager/categories');
        }

        $this->db->select('id, image');
        $query = $this->db->get('media');
        $image_list = $query->result();
        $data['images'] = $image_list;


        $this->load->view('productManager/categories', $data);
    }

    //Add Categories
    function categoryItems() {


        $data['category_items'] = $this->Product_model->category_items_prices();


        $query = $this->db->get('custome_items');
        $data['custome_items'] = $query->result();

        $query = $this->db->get('custome_items_price');
        $data['custome_items_price'] = $query->result();


        if (isset($_POST['delete_category'])) {
            $this->db->where('id', $this->input->post('category_id'));
            $this->db->delete('category_items');
            redirect('ProductManager/categoryItems');
        }


        if (isset($_POST['delete_price'])) {
            $p_item_id = $this->input->post('item_id');
            $p_item_price = $this->input->post('item_price');
            $this->db->where('id', $p_item_id);
            $this->db->delete('custome_items_price');
            redirect('ProductManager/categoryItems');
        }

        if (isset($_POST['update_category'])) {
            $this->db->set('category_name', $this->input->post('category_name'));
            $this->db->where('id', $this->input->post('category_id'));
            $this->db->update('category_items');
            redirect('ProductManager/categoryItems');
        }

        if (isset($_POST['update_price'])) {
            $p_item_id = $this->input->post('item_id');
            $p_item_price = $this->input->post('item_price');
            $this->db->set('price', $p_item_price);
            $this->db->where('id', $p_item_id);
            $this->db->update('custome_items_price');
            redirect('ProductManager/categoryItems');
        }


        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add Category') {
                $category_array = array(
                    'category_name' => $this->input->post('category_name'),
                );
                $this->db->insert('category_items', $category_array);
                $category_item_id = $this->db->insert_id();

                $item_ids = $this->input->post("item_id");
                $item_prices = $this->input->post("item_price");

                foreach ($item_prices as $key => $value) {
                    $item_id = $item_ids[$key];
                    $price = $item_prices[$key];
                    $category_item_price = array(
                        'item_id' => $item_id,
                        'category_items_id' => $category_item_id,
                        'price' => $price,
                    );
                    $this->db->insert('custome_items_price', $category_item_price);
                }
                redirect('ProductManager/categoryItems');




//                $category_array = array(
//                    'category_name' => $this->input->post('category_name'),
//                    'description' => $this->input->post('description'),
//                    'parent_id' => $this->input->post('parent_id'),
//                );
//                $this->db->insert('category', $category_array);
            }
//            if ($_POST['submit'] == 'Edit') {
//                echo $id = $this->input->post('parent_id');
//                $this->db->set('category_name', $this->input->post('category_name'));
//                $this->db->set('description', $this->input->post('description'));
//                $this->db->where('id', $id);
//                $this->db->update('category');
//            }
//            redirect('ProductManager/categories');
        }
        $this->load->view('productManager/categoryItems', $data);
    }

    //
    //end of categories
    //----------------------------
    //Attribute 
    function attributeCategoryList($category_id) {
        $categorystr = $this->Product_model->parent_get($category_id);
        $categorylist = $categorystr['category_array'];
        $categorylistattr = array();
        foreach ($categorylist as $key => $value) {
            $category_temp = $value['id'];
            $this->db->from('category_attribute');
            $this->db->where('category_id', $category_temp);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $temp = $query->result();
                foreach ($temp as $key => $value) {
                    $categorylistattr[$value->id] = $value;
                }
            }
        }
        return array('category_attribute' => $categorylistattr, 'category_id' => $category_id, 'category_str' => $categorystr['category_string']);
    }

    //Attribute Command
    function attributeCategoryListComman() {

        $categorylistattr = array();

        $this->db->from('category_attribute');
        $this->db->where('category_id', 'cm');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $temp = $query->result();
            foreach ($temp as $key => $value) {
                $categorylistattr[$value->id] = $value;
            }
        }

        return array('category_attribute' => $categorylistattr, 'category_id' => $category_id, 'category_str' => $categorystr['category_string']);
    }

    //
    function createAttribute($category_id) {
        if ($category_id > 0) {
            
        } else {
            redirect('ProductManager/createAttribute/1');
        }

        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $catarobj = $this->attributeCategoryList($category_id);
        $data['category_id'] = $catarobj['category_id'];
        $data['category_attribute'] = $catarobj['category_attribute'];
        $data['category_str'] = $catarobj['category_str'];

        if (isset($_POST['save_attr'])) {
            if ($_POST['save_attr'] == 'save_attr') {
                $category_attr_array = array(
                    'attribute_id' => $this->input->post('attribute_id'),
                    'attribute_value' => $this->input->post('attribute_value'),
                );
                $this->db->insert('category_attribute_value', $category_attr_array);
            }
            redirect('ProductManager/createAttribute/' . $category_id);
        }
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add Category') {
                $category_array = array(
                    'category_id' => $category_id,
                    'attribute' => $this->input->post('attribute'),
                    'display_index' => $this->input->post('display_index'),
                );
                $this->db->insert('category_attribute', $category_array);
            }
            if ($_POST['submit'] == 'Edit') {
                echo $id = $this->input->post('parent_id');
                $this->db->set('category_name', $this->input->post('category_name'));
                $this->db->set('description', $this->input->post('description'));
                $this->db->where('id', $id);
                $this->db->update('category');
            }
            redirect('ProductManager/createAttribute/' . $category_id);
        }
        $this->load->view('productManager/create_attribute', $data);
    }

    //end of attribute 
//
//Add product function
    function add_product() {
        $this->db->select('id, category_name');
        $query = $this->db->get('category');
        $category_list = $query->result();
        $data['category_data'] = $category_list;
        $data['default_category'] = $category_list[0];
        if (isset($_POST['submit'])) {
            $cat_name = $this->input->post('category_name');
            //$dat = date('Y-m-d ');
            //$tm = date('H:i:s');
            //$datetime = $dat . ' ' . $tm;
            $datetime = date("F j, Y, g:i a");
            //Check whether user upload picture
            if (!empty($_FILES['picture']['name'])) {

                $config['upload_path'] = 'assets/product_images';
                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);

                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "1." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }
            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'category_id' => $this->input->post('category_name'),
                'short_description' => $this->input->post('short_description'),
                'description' => $this->input->post('description'),
                'regular_price' => $this->input->post('regular_price'),
                'sale_price' => $this->input->post('sale_price'),
                'price' => $this->input->post('price'),
                'file_name' => $file_newname,
                'offer'=> $this->input->post('offer'),
                'file_name1' => "",
                'file_name2' => "",
                'status' => 1,
                'stock_status'=>'In Stock',
                'op_date_time' => $datetime,
                'user_id' => $user_id);

            $this->db->insert('products', $post_data);
            $last_id = $this->db->insert_id();

            if (autosku) {
                $sku = SKU_PREFIX . $user_id . $last_id;
                $this->db->set('sku', $sku);
                $this->db->where('id', $last_id); //set column_name and value in which row need to update
                $this->db->update('products'); //
            }
            //
            //Storing insertion status message.
            if ($last_id) {
                redirect('ProductManager/edit_product/' . $last_id);
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        $this->load->view('productManager/addProducts', $data);
    }

    //Edit product 
    function edit_product($product_id) {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $data['product_attributes'] = $product_model->product_attribute_list($product_id);

        $data['attributefunction'] = $product_model;

        $data['product_detail_attrs'] = $product_model->productAttributes($product_id);



        $this->db->select('*');
        $this->db->where('id', $product_id);
        $query = $this->db->get('products');
        $productobj = $query->row();


        if ($productobj) {
            $data['product_obj'] = $productobj;
        } else {
            redirect('ProductManager/productReport');
        }
        $vproduct_id = $product_id;


        $categorystr = $this->Product_model->parent_get($productobj->category_id);
        $categorylist = $categorystr['category_array'];
        $categorystring = $categorystr['category_string'];
        $data['category_string'] = $categorystring;

        $data['product_prices'] = "";

        if (isset($_POST['removedata'])) {
            $this->db->set('status', 0);
            $this->db->where('id', $product_id); //set column_name and value in which row need to update
            $this->db->update('products'); //
            redirect("ProductManager/productReport");
        }
        
        if (isset($_POST['recoverdata'])) {
            $this->db->set('status', 1);
            $this->db->where('id', $product_id); //set column_name and value in which row need to update
            $this->db->update('products'); //
            redirect("ProductManager/productReport");
        }
        
        if (isset($_POST['deletedata'])) {
            $this->db->where('id', $product_id); //set column_name and value in which row need to update
            $this->db->delete('products'); //
            redirect("ProductManager/productReport");
        }


        //end of new attr
        //update procuct
        if (isset($_POST['editdata'])) {


            $config['upload_path'] = 'assets/product_images';
            $config['allowed_types'] = '*';
//            $config['overwrite'] = TRUE;

            if (!empty($_FILES['picture']['name'])) {
                $ext2 = explode('.', $_FILES['picture']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture);
                $ext33 = strtolower(end($ext22));
                $temp1 = rand(100, 1000000);
                $filename = $ext22[0];
                $file_newname = $temp1 . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name', $file_newname);
                }
            }

            if (!empty($_FILES['picture1']['name'])) {
                $ext2 = explode('.', $_FILES['picture1']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture1);
                $ext33 = strtolower(end($ext22));
                if ($picture1) {
                    $filename = $ext22[0];
                } else {
                    $filename = $temp1 . "1";
                }
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture1')) {
                    $uploadData = $this->upload->data();
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name1', $file_newname);
                    $this->db->where('id', $product_id); //set column_name and value in which row need to update
                    $this->db->update('products'); //
                }
            }


            if (!empty($_FILES['picture2']['name'])) {
                $ext2 = explode('.', $_FILES['picture2']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture2);
                $ext33 = strtolower(end($ext22));
                if ($picture2) {
                    $filename = $ext22[0];
                } else {
                    $filename = $temp1 . "3";
                }
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture2')) {
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name2', $file_newname);
                    $this->db->where('id', $product_id); //set column_name and value in which row need to update
                    $this->db->update('products'); //
                }
            }


            $post_data = array(
                'title' => $this->input->post('title'),
                'category_id' => $this->input->post('category_name'),
                'short_description' => $this->input->post('short_description'),
                'description' => $this->input->post('description'),
                'regular_price' => $this->input->post('regular_price'),
                'sale_price' => $this->input->post('sale_price'),
                'price' => $this->input->post('price'),
                'offer'=>$this->input->post('offer'),
                'status' => 1,
                'stock_status' => $this->input->post('stock_status')
            );
            $this->db->set($post_data);

            $this->db->where('id', $product_id); //set column_name and value in which row need to update
            $this->db->update('products'); //
            //Storing insertion status message.
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //end of update product
        //add related products
        if (isset($_POST['add_realted_products'])) {
            $productlists = $this->input->post('related_product_id');

            foreach ($productlists as $key => $value) {
                $related_product_array = array(
                    'related_product_id' => $value,
                    'product_id' => $product_id,
                );
                $this->db->insert('product_related', $related_product_array);
            }

            //$last_id = $this->db->insert_id();
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //end of realted products
        //remove related products
        if (isset($_POST['remove_realted_products'])) {
            $productlists = $this->input->post('related_product_id');

            foreach ($productlists as $key => $value) {
                $related_product_id = $value;
                $this->db->where('id', $related_product_id);
                $this->db->delete('product_related');
            }

            //$last_id = $this->db->insert_id();
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //remove of realted products

        $this->load->view('productManager/editProducts', $data);
    }

    //variant_product
    function variant_product($product_id) {
        $this->db->where('id', $product_id);
        $query = $this->db->get('products');
        $product = $query->row_array();
        unset($product['id']);
        $product['variant_product_of'] = $product_id;
        $this->db->insert('products', $product);
        $last_id = $this->db->insert_id();
        $sku = "CAS" . $user_id . $last_id;
        $this->db->set('sku', $sku);
        $this->db->where('id', $last_id); //set column_name and value in which row need to update
        $this->db->update('products');

        redirect('ProductManager/edit_product/' . $last_id);
    }

    function productReport() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $data['condition'] = 'stockin';
        $data['title'] = '';
        $this->load->view('productManager/productReport', $data);
    }

    function productRemove($id) {
        
    }

    function productReportStockOut() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $data['condition'] = 'stockout';
        $data['title'] = 'Out Of Stock';
        $this->load->view('productManager/productReport', $data);
    }

    function productReportTrash() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $data['condition'] = 'remove';
        $data['title'] = 'Removed';
        $this->load->view('productManager/productReport', $data);
    }

    //Product API for data Table
    public function productReportApi($condition) {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $searchqry = "";

        $search = $this->input->get("search")['value'];
        if ($search) {
            $searchqry = " and p.title like '%$search%' or p.sku like '%$search%' ";
        }

        $editionalquery = "where p.status = '1'";
        switch ($condition) {
            case "remove":
                $editionalquery = " where p.status = '0' ";
                break;
            case "stockout":
                $editionalquery = " where p.stock_status = 'Out of Stock' and p.status = '1'";
                break;
            default:
                $editionalquery = " where p.stock_status = 'In Stock' and p.status = '1'";
        }


        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $query = "select p.* from products as p $editionalquery  $searchqry  order by id desc ";
        $query1 = $this->db->query($query);
        $productslistcount = $query1->result_array();

        $query = "select p.* from products as p $editionalquery $searchqry  order by id  limit  $start, $length";
        $query2 = $this->db->query($query);
        $productslist = $query2->result_array();




        $return_array = array();
        foreach ($productslist as $pkey => $pvalue) {
            $temparray = array();
            $temparray['s_n'] = $pkey + 1;


            $imageurl = base_url() . "assets/default/default.png";
            if ($pvalue['file_name']) {
                $imageurl = base_url() . "assets/product_images/" . $pvalue['file_name'];
            }


            $temparray['image'] = "<img src='$imageurl' style='height:51px;'>";
            $temparray['sku'] = $pvalue['sku'];
            $temparray['title'] = $pvalue['title'];
            $temparray['short_description'] = $pvalue['short_description'];
            $catarray = $this->Product_model->parent_get($pvalue['category_id']);
            $temparray['category'] = $catarray['category_string'];
            $temparray['items_prices'] = $pvalue['price'];
            $temparray['stock_status'] = $pvalue['stock_status'];
            $temparray['edit'] = '<a href="' . site_url('ProductManager/edit_product/' . $pvalue['id']) . '" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>';

            array_push($return_array, $temparray);
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $query2->num_rows(),
            "recordsFiltered" => $query1->num_rows(),
            "data" => $return_array
        );
        echo json_encode($output);
        exit();
    }

    //Add product function
    function add_sliders() {
        $query = $this->db->get('sliders');
        $data['sliders'] = $query->result();
        if (isset($_POST['submit'])) {
            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = 'assets/paymentstatus';
                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "1." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }
            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'line1' => $this->input->post('line1'),
                'line2' => $this->input->post('line2'),
                'link' => $this->input->post('link'),
                'link_text' => $this->input->post('link_text'),
                'file_name' => $file_newname);


            $this->db->insert('sliders', $post_data);
            $last_id = $this->db->insert_id();
            redirect('ProductManager/add_sliders');
        }
        $this->load->view('productManager/add_sliders', $data);
    }

    public function productSortingChangeIndexApi($id, $displayindex) {
        $this->db->set('display_index', ($displayindex));
        $this->db->where('id', $id);
        $this->db->update('products');
    }

    public function productSortingChangeStatusApi($id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('products');
    }

    public function productSortingApi($category_id) {
        $startp = $this->input->get('start_page');
        $endp = $this->input->get('end_page');
        if ($endp) {
            
        } else {
            $endp = 0;
        }
        if ($category_id) {
            
        } else {
            $category_id = 0;
        }
        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");
        $sqldata = "select *, 'false' as checked from products where category_id in ($categoriesString) and status =1 order by display_index desc";
        $query = $this->db->query($sqldata);
        $product_result = $query->result();

        $productarray = array();
        $product_folders = explode(", ", product_folders);

        foreach ($product_result as $rkey => $rvalue) {
            $imageurl = "";
            if (count($product_folders)) {
                $imageurl = product_image_base . PRODUCT_PATH_PRE . $rvalue->folder . PRODUCT_PATH_POST;
            }
            $this->db->where('product_id', $rvalue->id);
            $query = $this->db->get('product_attribute');
            $colorslist = $query->result();
            $rvalue->colors = $colorslist;
            $rvalue->image = $imageurl;
            array_push($productarray, $rvalue);
        }




        $productListFinal = $productarray; //array_slice($product_result, $endp, 16);
        $productarray = array("total_products" => count($product_result), "products" => $productListFinal);
        echo json_encode($productarray);
    }

    function productSorting() {

        if (isset($_POST['apply_category'])) {
            $productids = $this->input->post('product_id');
            if (count($productids)) {
                $this->db->set('category_id', $this->input->post('category_id'));
                $this->db->where_in('id', $productids);
                $this->db->update('products');
            }
        }

        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $this->load->view('productManager/productSorting', $data);
    }

    function productColors() {

        if (isset($_POST['apply_category'])) {
            $productids = $this->input->post('product_id');
            if (count($productids)) {


                foreach ($productids as $pkey => $pvalue) {
                    $productattr = array(
                        'product_id' => $pvalue,
                        'attribute_id' => $this->input->post('color_id'),
                        'attribute' => "color",
                        'attribute_value' => $this->input->post('color_code'),
                        'attribute_value_id' => ''
                    );
                    $this->db->insert('product_attribute', $productattr);
                }
            }
        }

        $this->db->order_by('display_index');
        $query = $this->db->get('configuration_colors');
        $colorslist = $query->result();
        $data['colorslist'] = $colorslist;


        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $this->load->view('productManager/productColor', $data);
    }

}
