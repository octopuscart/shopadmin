<?php


use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Appointment_model');
        $this->userdata = $this->session->userdata('logged_in');
    }

    public function listAppointments() {
        $allappointment = $this->Appointment_model->AppointmentDataAll();
        $data['appointmentdata'] = $allappointment;
        $this->load->view('Appointment/appointmentSetting', $data);
    }

    public function deleteAppointment($aid) {
        $this->db->where('aid', $aid);
        $query = $this->db->delete('appointment_entry');
        redirect('Appointment/listAppointments');
    }

    public function editAppointment($appId) {
        $appointmentData = $this->Appointment_model->AppointmentData($appId);
        $data['appointmentData'] = $appointmentData;
        $appointment_r = $appointmentData['appointment'];
        if (isset($_POST['set_date'])) {

            $this->db->delete('appointment_entry', array('aid' => $appId));

            $appointmentdata = $appointmentData['appointment'];
            $from_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $date_from = $from_date;
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
            $date_to = $end_date;
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
            $from_date_s = date_format(date_create($from_date), "d F");
            $to_date_s = date_format(date_create($end_date), "d F Y");
            $days = $s_date = "$from_date_s - $to_date_s";
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "aid" => $appointment_r['aid'],
                    "hotel" => $appointment_r['hotel'],
                    "country" => $appointment_r['country'],
                    "city_state" => $appointment_r['city_state'],
                    "address" => $appointment_r['address'],
                    "contact_no" => $appointment_r['contact_no'],
                    "days" => $days,
                    "appointment_type" => "globle",
                    "date" => $temp_date,
                    "start_date" => $from_date,
                    "end_date" => $end_date,
                    "from_time" => $appointment_r['from_time'],
                    "to_time" => $appointment_r['to_time'],
                );
                $this->db->insert('appointment_entry', $tempData);
            }
            redirect("Appointment/editAppointment/$appId");
        }

        $this->load->view('Appointment/appointmentEdit', $data);
    }

    public function addAppointment() {
        $this->db->order_by('id desc');
        $query = $this->db->get('appointment_entry');
        $last_id = $query->row();
        $data = array("last_aid" => $last_id?($last_id->id + 1):1);
        if (isset($_POST['set_date'])) {
            $appId = $this->input->post('aid');
            $from_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $date_from = $from_date;
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
            $date_to = $end_date;
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
            $from_date_s = date_format(date_create($from_date), "d F");
            $to_date_s = date_format(date_create($end_date), "d F Y");
            $days = $s_date = "$from_date_s - $to_date_s";
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "aid" => $this->input->post('aid'),
                    "hotel" => $this->input->post('hotel'),
                    "country" => $this->input->post('country'),
                    "city_state" => $this->input->post('city_state'),
                    "address" => $this->input->post('address'),
                    "contact_no" => $this->input->post('contact_no'),
                    "days" => $days,
                    "appointment_type" => "globle",
                    "date" => $temp_date,
                    "start_date" => $from_date,
                    "end_date" => $end_date,
                    "from_time" => "09:00 AM",
                    "to_time" => "09:00 PM",
                );
                $this->db->insert('appointment_entry', $tempData);
            }
            redirect("Appointment/editAppointment/$appId");
        }

        $this->load->view('Appointment/appointmentAdd', $data);
    }

    function xlsReader() {


$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file.xlsx';
 
        $writer->save($filename); // will create and save the file in the root of the project
    }

}
