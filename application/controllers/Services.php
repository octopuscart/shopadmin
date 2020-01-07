<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        redirect('/');
    }

    function order_mail_send($order_id) {
        $subject = "Order Confirmation - Your Order with www.bespoketailorshk.com [$order_id] has been successfully placed!";
        $this->Order_model->order_mail($order_id, $subject);
    }

    function order_pdf($order_id) {
        $this->Order_model->order_pdf($order_id);
    }

    public function remove_order_status($status_id, $orderkey) {
        $this->db->delete('user_order_status', array('id' => $status_id));
        redirect("Order/orderdetails/$orderkey");
    }

//order list accroding to user type
    public function newslatter($lattertype) {
        $data['lattertype'] = $lattertype;
        $data['exportdata'] = 'yes';
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        $data['users_all'] = $this->User_model->user_reports("User");
        $this->load->view('Email/newslatter', $data);
    }
    
    
    function appointment(){
        $data = array();
        $this->load->view("Appointment/setnew", $data);
    }
    
     function systemLogReport(){
        $data = array();
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('system_log');
        $systemlog = $query->result();
        $data['systemlog'] = $systemlog;
        $this->load->view("Services/systemLogReport", $data);
    }

}

?>
