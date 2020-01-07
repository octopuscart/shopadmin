<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Configuration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function reportConfiguration() {
        $data = array();
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('configuration_report');
        $systemlog = $query->row();
        $data['configuration_report'] = $systemlog;



        if (isset($_POST['update_data'])) {
            $confArray = array(
                "email_header" => $this->input->post("email_header"),
                "email_footer" => $this->input->post("email_footer"),
                "pdf_report_header" => $this->input->post("pdf_report_header"),
            );
            $this->db->update('configuration_report', $confArray);
            redirect("Configuration/reportConfiguration");
        }


        $this->load->view("configuration/reportConfiguration", $data);
    }

    public function migration() {
        if ($this->db->table_exists('mailchimp_list')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `mailchimp_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` varchar(100) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `datetime` varchar(100) DEFAULT NULL,
  `member_count` varchar(50) NOT NULL,
  `display_index` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;');
        }


        if ($this->db->table_exists('configuration_email')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `configuration_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(200) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `smtp_server` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `smtp_port` varchar(50) NOT NULL,
  `api_key` varchar(512) NOT NULL,
  `api_endpoint` varchar(512) NOT NULL,
  `default` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;');
        }


        if ($this->db->table_exists('mailer_contacts2_check')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `mailer_contacts2_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `mailer_contact_id` varchar(50) NOT NULL,
  `status` varchar(500) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1242 ;');
        }


        if ($this->db->table_exists('mailer_contacts')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `mailer_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `mailer_list_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
        }

        if ($this->db->table_exists('mailer_list')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `mailer_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` varchar(100) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `datetime` varchar(100) DEFAULT NULL,
  `member_count` varchar(50) NOT NULL,
  `display_index` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;');
        }





        if ($this->db->table_exists('mailer_contacts2')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `mailer_contacts2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `full_name` varchar(200) NOT NULL,
  `mailer_list_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
        }


        if ($this->db->table_exists('appointment_list')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `appointment_list` (
  `id` int(122) NOT NULL AUTO_INCREMENT,
  `select_date` varchar(122) NOT NULL,
  `select_time` varchar(122) NOT NULL,
  `first_name` varchar(122) NOT NULL,
  `no_of_person` varchar(30) NOT NULL,
  `last_name` varchar(122) NOT NULL,
  `email` varchar(122) NOT NULL,
  `contact_no` varchar(122) NOT NULL,
  `hotel` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city_state` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `referral` varchar(122) NOT NULL,
  `datetime` varchar(122) NOT NULL,
  `appointment_type` varchar(122) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;');
        }


        if ($this->db->field_exists('hotel', 'appointment_list')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `appointment_list` ADD `hotel` VARCHAR(200) NOT NULL AFTER `contact_no`, ADD `address` VARCHAR(300) NOT NULL AFTER `hotel`, ADD `city_state` VARCHAR(200) NOT NULL AFTER `address`, ADD `country` VARCHAR(200) NOT NULL AFTER `city_state`;');
        }




        if ($this->db->table_exists('appointment_entry')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE IF NOT EXISTS `appointment_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city_state` varchar(100) NOT NULL,
  `appointment_type` varchar(50) NOT NULL,
  `hotel` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `days` varchar(200) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `from_time` varchar(100) NOT NULL,
  `to_time` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
        }

        if ($this->db->field_exists('display_index', 'category')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `category` ADD `display_index` INT NOT NULL AFTER `parent_id`;');
        }

        if ($this->db->field_exists('display_index', 'products ')) {
            // table exists
        } else {
            $this->db->query('ALTER TABLE `products` ADD `display_index` INT NOT NULL AFTER `folder`;');
        }


        if ($this->db->table_exists('configuration_cartcheckout')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE `configuration_cartcheckout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_path_pre` varchar(200) NOT NULL,
  `product_path_post` varchar(200) NOT NULL,
  `payment_paypal` varchar(10) NOT NULL,
  `payment_bank` varchar(10) NOT NULL,
  `payment_cheque` varchar(10) NOT NULL,
  `payment_cod` varchar(10) NOT NULL,
  `default_payment_mode` varchar(50) NOT NULL,
  `gift_coupon` varchar(10) NOT NULL,
  `order_prefix` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
        }

        if ($this->db->table_exists('style_tips')) {
            
        } else {
            $this->db->query('CREATE TABLE `style_tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `tag` varchar(500) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
');
        }







        if ($this->db->table_exists('seo_settings')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE `seo_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_title` varchar(500) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_url` text NOT NULL,
  `seo_image` text NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
');
        }


        if ($this->db->table_exists('style_category')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE `style_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  `parent_id` varchar(50) NOT NULL,
  `display_index` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
');
        }


        if ($this->db->table_exists('style_tags')) {
            // table exists
        } else {
            $this->db->query('CREATE TABLE `style_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(200) NOT NULL,
  `parent_id` varchar(50) NOT NULL,
  `display_index` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
');
        }


        if ($this->db->table_exists('lookbook_category')) {
            // table exists
        } else {
            $this->db->query('    CREATE TABLE `lookbook_category` (
   `id` int(11) NOT NULL AUTO_INCREMENT,

  `category_name` varchar(250) NOT NULL,
  `parent_id` varchar(50) NOT NULL,
  `display_index` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

');
        }

        if ($this->db->table_exists('lookbook')) {
            // table exists
        } else {
            $this->db->query('   
CREATE TABLE `lookbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(200) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


');
        }

        if ($this->db->table_exists('conf_social_link')) {
            // table exists
        } else {
            $this->db->query('   
CREATE TABLE `conf_social_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `link_url` text NOT NULL,
  `display_index` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


');
        }
    }

}
