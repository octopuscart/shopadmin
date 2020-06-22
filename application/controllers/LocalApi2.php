<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class LocalApi2 extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->API_ACCESS_KEY = 'AAAAYO82HuA:APA91bGPbrV9GXqaEf9VAUfsqEkRhNN66DKpq1MZgr5-tiNwe6X0wwrUxu3fvC4Ik8ioX3vbRU5blNncLQCUjULJkA_KqYnm1pTNpqOlZodvqw6JKnvRsBqwpyjL2ZcECOt7XetXSLqZ';
        // (iOS) Private key's passphrase.
        $this->passphrase = 'joashp';
        // (Windows Phone 8) The name of our push channel.
        $this->channelName = "joashp";
        $this->checklogin = $this->session->userdata('logged_in');
        $this->load->model('Order_model');
    }

    function testGet_get() {
        print_r($this->checklogin['user_type']);
    }

    //function for user settingt
    function updateUserSession_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
            if (isset($this->checklogin[$fieldname])) {

                $this->checklogin[$fieldname] = $value;
                $this->session->set_userdata('logged_in', $this->checklogin);
            }
        }
    }

    function updateUserClient_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_users", $data);
        }
    }

    function updateUser() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');

        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("admin_user", $data);
        }
    }

    function updateAppointment_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("aid", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    function updateAppointmentTime_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('appointment_entry');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update('appointment_entry', $data);
        }
    }

    //function for curd update
    function updateCurd_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $tablename = $this->post('tablename');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($tablename, $data);
        }
    }

    //function for curd update
    function curd_get($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for product list
    function deleteCurd_post($table_name) {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update($table_name, $data);
        }
    }

    //function for curd update
    function cartUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        $quantity = $this->post('quantity');
        $totalPrice = (intval($quantity) * intval($value));
        if ($this->checklogin) {
            $data = array($fieldname => $value, "total_price" => "$totalPrice");
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("cart");

            $this->db->where('id', $pk_id);
            $query = $this->db->get('cart');
            $cart_items = $query->row();

            $order_details = $this->Order_model->recalculateOrder($cart_items->order_id);
        }
    }

    //function for order update
    function orderUpdate_post() {
        $fieldname = $this->post('name');
        $value = $this->post('value');
        $pk_id = $this->post('pk');
        if ($this->checklogin) {
            $data = array($fieldname => $value);
            $this->db->set($data);
            $this->db->where("id", $pk_id);
            $this->db->update("web_order");
        }
    }

    function notificationUpdate_get() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function checkUnseenOrder_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('status', "0");
        $query = $this->db->get('web_order');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMail_get() {
        $this->Order_model->orderInboxEmail();
        $this->response();
    }

    function inboxOrderMailIndb_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function inboxOrderMaildb_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        $this->response($systemlog);
    }

    function sendEmailOrderCancle_get($order_key) {
        $this->Order_model->order_mail($order_key);
    }

    function homeData_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('order_seen', "0");
        $query = $this->db->get('user_order');
        $order_unssen = $query->result_array();

        $this->db->order_by('id', 'desc');
        $query = $this->db->get('user_order');
        $order_seen = $query->result_array();


        $this->db->order_by('id', 'desc');
        $this->db->where('user_type', "");
        $query = $this->db->get('admin_users');
        $userdata = $query->result_array();



        $homedata = array(
            "order_data" => count($order_seen),
            "total_user" => count($userdata),
            "total_unseen_order" => count($order_unssen),
            "total_unssen_emails" => "0",
        );


        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $this->response($homedata);
    }

    //mobile app api
    function systemLog_get() {
        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('system_log');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    //mobile app api
    function inboxOrderMailIndbMobileUnseen_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('seen', "0");
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function checkUnseenOrderMobileUnseen_get() {

        $this->db->order_by('id', 'desc');
        $this->db->where('order_seen', "0");
        $query = $this->db->get('user_order');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $this->response($systemlog);
    }

    function inboxOrderMailIndbMobile_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('web_order_email');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $tamparray = [];
        foreach ($systemlog as $key => $value) {
            $emp = $value['from_email'];
            $tmp = explode("<", $emp);
            $name = $tmp[0];
            $emailf = str_replace(">", "", $tmp[1]);
            $value["femail"] = $emailf;
            $value["name"] = $name;
            array_push($tamparray, $value);
        }
        $this->response($tamparray);
    }

    function checkUnseenOrderMobile_get() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('user_order');
        $systemlog = $query->result_array();
        $tempdata = [];
        foreach ($systemlog as $key => $value) {

            $this->db->where('order_id', $value['id']);
            $query = $this->db->get('cart');
            $cartdata = $query->result();
            $value['cart'] = $cartdata;

            array_push($tempdata, $value);
        }

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($tempdata);
    }

    function checkClientMobile_get() {
        $this->db->order_by('id', 'desc');
        $this->db->where('user_type', "");
        $query = $this->db->get('admin_users');
        $systemlog = $query->result_array();
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->response($systemlog);
    }

    function registerMobileUser_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $reg_id = $this->post('reg_id');
        $model = $this->post('model');
        $manufacturer = $this->post('manufacturer');
        $uuid = $this->post('uuid');
        $regArray = array(
            "reg_id" => $reg_id,
            "manufacturer" => $manufacturer,
            "uuid" => $uuid,
            "model" => $model,
            "user_id" => "Admin",
            "user_type" => "Admin",
            "datetime" => date("Y-m-d H:i:s a")
        );
        $this->db->insert('gcm_registration', $regArray);
//        $this->db->where('reg_id', $reg_id);
//        $query = $this->db->get('gcm_registration');
//        $regarray = $query->result_array();
//        if ($regArray) {
//            
//        } else {
//            $this->db->insert('gcm_registration', $regArray);
//        }
        $this->response(array("status" => "done"));
    }

    function registerMobileGuest_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $reg_id = $this->post('reg_id');
        $model = $this->post('model');
        $manufacturer = $this->post('manufacturer');
        $uuid = $this->post('uuid');
        $regArray = array(
            "reg_id" => $reg_id,
            "manufacturer" => $manufacturer,
            "uuid" => $uuid,
            "model" => $model,
            "user_id" => "Guest",
            "user_type" => "Guest",
            "datetime" => date("Y-m-d H:i:s a")
        );
        $this->db->insert('gcm_registration', $regArray);
//        $this->db->where('reg_id', $reg_id);
//        $query = $this->db->get('gcm_registration');
//        $regarray = $query->result_array();
//        if ($regArray) {
//            
//        } else {
//          
//        }
        $this->response(array("status" => "done"));
    }

    function updateOrderStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $order_id = $this->post('order_id');
        $data = array("status" => "1");
        $this->db->set($data);
        $this->db->where("id", $order_id);
        $this->db->update("web_order");

        $order_status_data = array(
            'c_date' => date('Y-m-d'),
            'c_time' => date('H:i:s'),
            'order_id' => $order_id,
            'status' => "Received",
            'user_id' => "Mobile user",
            'remark' => "Reservation Received From Mobile App",
            "process_by" => "Mobile App",
            "process_user" => "Admin Mobile App",
        );
        $this->db->insert('user_order_status', $order_status_data);

        $this->response(array("status" => "done"));
    }

    function updateEmailStatus_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $email_id = $this->post('email_id');
        $data = array("seen" => "1");
        $this->db->set($data);
        $this->db->where("id", $email_id);
        $this->db->update("web_order_email");
        $this->response(array("status" => "done"));
    }

    //Mobile Booking APi
    function bookingFromMobile_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $bookingarray = $this->post();
        //print_r($bookingarray);

        $web_order = array(
            'last_name' => $this->post('first_name'),
            'first_name' => $this->post('last_name'),
            'email' => $this->post('email'),
            'contact' => $this->post('contact_no'),
            'select_date' => $this->post('select_date'),
            'select_time' => $this->post('select_time'),
            'booking_type' => $this->post('book_type'),
            'extra_remark' => "",
            'select_table' => $this->post('select_table'),
            'people' => $this->post('people'),
            "usertype" => $this->post('usertype'),
            'datetime' => date("Y-m-d H:i:s a"),
            "order_source" => "Mobile App",
            'order_date' => date("Y-m-d"),
            'status' => "0",
        );
        $this->db->insert('web_order', $web_order);

        $last_id = $this->db->insert_id();
        $oderid = $last_id;
        $ordertype = $this->post('booking_type');
        $orderlog = array(
            'log_type' => "Reservation Received",
            'log_datetime' => date('Y-m-d H:i:s'),
            'user_id' => "",
            'order_id' => $last_id,
            'log_detail' => "Reservation No. #$last_id  $ordertype From Mobile App",
        );
        $this->db->insert('system_log', $orderlog);

        $this->response(array("status" => "done"));
    }

    //Mobile Booking APi
    function updateOrderSeen_post() {
        $this->config->load('rest', TRUE);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $order_id = $this->post('order_id');
        $this->db->set('order_seen', '1');
        $this->db->where('id', $order_id); //set column_name and value in which row need to update
        $this->db->update('user_order');
        $this->response(array("status" => "done"));
    }

    // Curl 
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

    public function android($data, $reg_id_array) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $message = array(
            'title' => $data['title'],
            'message' => $data['message'],
            'subtitle' => '',
            'tickerText' => '',
            'msgcnt' => 1,
            'vibrate' => 1
        );

        $headers = array(
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $fields = array(
            'registration_ids' => $reg_id_array,
            'data' => $message,
        );

        return $this->useCurl($url, $headers, json_encode($fields));
    }

    public function iOS($data, $devicetoken) {
        $deviceToken = $devicetoken;
        $ctx = stream_context_create();
        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);
        // Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'title' => $data['mtitle'],
                'body' => $data['mdesc'],
            ),
            'sound' => 'default'
        );
        // Encode the payload as JSON
        $payload = json_encode($body);
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);
        if (!$result)
            return 'Message not delivered' . PHP_EOL;
        else
            return 'Message successfully delivered' . PHP_EOL;
    }

    function ganarateNotificationForAdmin_get() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");


        $this->db->order_by('id', 'desc');
        $this->db->where('order_seen', "0");
        $query = $this->db->get('user_order');
        $orderlist = $query->result_array();

        $ordercount = count($orderlist);


        $totalcount = $ordercount + 0;

        $title = "$totalcount Unseen Notifications";
        $message = "";
        $messageo = "";
        $messagem = "";
        if ($ordercount) {
            $messageo = "Total $ordercount Unseen Order(s)";
        }

        $message = $messageo . $messagem;

        $query = $this->db->get('gcm_registration');
        $gcm_registration = $query->result_array();
        $regid = [];
        foreach ($gcm_registration as $key => $value) {
            array_push($regid, $value['reg_id']);
        }
        $data = array('title' => $title, "message" => $message);

        if ($totalcount) {
            echo $this->android($data, $regid);
        }
    }

    function newOrderNotification_get($orderid) {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->db->where('id', $orderid);
        $query = $this->db->get('web_order');
        $orderdata = $query->row();
        $name = $orderdata->first_name . " " . $orderdata->last_name;
        $email = $orderdata->email;
        $ordersource = $orderdata->order_source;

        $title = "New booking (#$orderid) From $ordersource";
        $message = "Guest:$name, Email:$email";


        $query = $this->db->get('gcm_registration');
        $gcm_registration = $query->result_array();
        $regid = [];
        foreach ($gcm_registration as $key => $value) {
            array_push($regid, $value['reg_id']);
        }
        $data = array('title' => $title, "message" => $message);
        $this->android($data, $regid);
    }

    function testMsg_get() {
        $data = array('title' => "test messae", "message" => "test");
        $query = $this->db->get('gcm_registration');
        $gcm_registration = $query->result_array();
        $regid = [];
        foreach ($gcm_registration as $key => $value) {
            array_push($regid, $value['reg_id']);
        }

        echo $this->android($data, $regid);
    }

}

?>