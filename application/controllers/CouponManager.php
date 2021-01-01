<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class CouponManager extends CI_Controller {

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

    function couponReport() {
        $data = array();
        $data['condition'] = 'stockin';
        $data['title'] = '';
        $this->load->view('couponManager/couponReport', $data);
    }
    
    function couponUsedReport() {
        $data = array();
        $data['condition'] = 'stockin';
        $data['title'] = '';
        $this->load->view('couponManager/couponReportUsed', $data);
    }

    //Product API for data Table
    public function productReportApi($condition) {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $searchqry = "";

        $search = $this->input->get("search")['value'];
        if ($search) {
            $searchqry = ' and p.title like "%' . $search . '%" or p.sku like "%' . $search . '%" ';
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

}
