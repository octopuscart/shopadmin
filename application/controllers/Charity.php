<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Charity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->db->where_in('attr_key', ["EOPGMid", "EOPGSecretCode", "EOPGSalesLink", "EOPGQueryLink", "CouponLink"]);
        $query = $this->db->get('configuration_attr');
        $paymentattr = $query->result_array();
        $paymentconf = array();
        foreach ($paymentattr as $key => $value) {
            $paymentconf[$value['attr_key']] = $value['attr_val'];
        }
        $this->mid = $paymentconf['EOPGMid'];
        $this->secret_code = $paymentconf['EOPGSecretCode'];
        $this->salesLink = $paymentconf['EOPGSalesLink'];
        $this->queryLink = $paymentconf['EOPGQueryLink'];
        $this->couponApiUrl = $paymentconf['CouponLink'];
//        $this->couponApiUrl = "http://localhost/woodlandcoupon/index.php/";
    }

    private function useCurl($url, $headers, $fields = null) {
        // Open connection
        $ch = curl_init();
        if ($url) {
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);

            return $result;
        }
    }

    public function index() {
        $c_query = "SELECT sum(amount) as amount FROM `charity_donation` where confirm_status='Confirm' order by id desc";
        $querytotal = $this->db->query($c_query);
        $totalrcv = $querytotal->row_array();

        $collectamount = $totalrcv["amount"];

        $targetgoal = "100000";

        $collectpercent = ($collectamount * 100) / $targetgoal;

        $data["target_achive"] = $collectpercent;

        if (isset($_POST['amount'])) {
            $requestid = "CHWL" . date('ymd') . date('His');
            $paymenttype = $this->input->post('payment_type');
            $charity_donation = array(
                "request_hash" => md5($requestid),
                "request_id" => $requestid,
                "name" => $this->input->post('name'),
                "email" => $this->input->post('email'),
                "contact_no" => $this->input->post('contact_no'),
                "payment_type" => $this->input->post('payment_type'),
                "message" => $this->input->post('message'),
                'amount' => $this->input->post('amount'),
                'anonymous_donation' => $this->input->post('anonymous_donation'),
                "status" => "Payment Init",
                "remark" => "",
                "date" => date('Y-m-d'),
                "time" => date('H:i:s'),
            );
//            print_r($charity_donation);
            $this->db->insert('charity_donation', $charity_donation);
            $restpay = array("PAYME" => "", "FPS" => "");
            if (isset($restpay[$paymenttype])) {
                redirect("Charity/qrPayment/$paymenttype/" . $requestid);
            } else {
                redirect("Charity/orderPayment/" . $requestid);
            }
        }

        $this->load->view('donation/annual_charity', $data);
    }

    function reports() {

        $this->db->order_by("id desc");
        $query = $this->db->get("charity_donation");
        $requestdata = $query->row_array();
        $data = array("donation" => $requestdata);

        $c_query = "SELECT sum(amount) as amount FROM `charity_donation` where confirm_status='Confirm' order by id desc";
        $querytotal = $this->db->query($c_query);
        $totalrcv = $querytotal->row_array();

        $collectamount = $totalrcv["amount"];

        $targetgoal = "100000";

        $collectpercent = ($collectamount * 100) / $targetgoal;

        $data["target_achive"] = $collectpercent;
        $data["total_collection"] = $collectamount;
        $data["targetgoal"] = $targetgoal;
        $this->load->view('donation/reports', $data);
    }

    function confirm($id) {
        $this->db->set("confirm_status", "Confirm");
        $this->db->where("id", $id);
        $this->db->update("charity_donation");
        redirect(site_url("Charity/reports"));
    }

    function delete($id) {
        $this->db->set("confirm_status", "Delete");
        $this->db->where("id", $id);
        $this->db->update("charity_donation");
        redirect(site_url("Charity/reports"));
    }

    function thankyouEmail($order_key) {
        $this->db->where("request_id", $order_key);
        $query = $this->db->get("charity_donation");
        $requestdata = $query->row_array();
        $data = array("donation" => $requestdata);
        $emailsender = email_sender;
        $sendername = email_sender_name;
        $email_bcc = email_bcc;
        $this->email->set_newline("\r\n");
        $this->email->from(email_bcc, $sendername);
        $this->email->to($requestdata['email']);
        $this->email->bcc(email_bcc);
        $subjectt = "Thank you for your donation";
        $subject = $subjectt;
        $this->email->subject($subject);
        $htmlsmessage = $this->load->view('donation/donation_email', $data, true);
        if (REPORT_MODE == 1) {
            $this->email->message($htmlsmessage);
            $this->email->print_debugger();
            $send = $this->email->send();
            if ($send) {
                
            } else {
                $error = $this->email->print_debugger(array('headers'));
            }
        } else {
            echo $htmlsmessage;
        }
    }

}
