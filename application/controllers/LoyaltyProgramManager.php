<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class LoyaltyProgramManager extends CI_Controller {

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

    function createBilling() {
        $data = array();
        $data['title'] = '';
        if(isset($_POST['booknow'])){
            redirect("LoyaltyProgramManager/createBilling");
        }
        $this->load->view('loyaltyManager/createBilling', $data);
    }
    
    function membersList() {
        $data = array();
        $data['condition'] = 'stockin';
        $data['title'] = '';
          $this->load->view('loyaltyManager/memberList', $data);
    }
    
    function syncOrder(){
        
    }

  

}
