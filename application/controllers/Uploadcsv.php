<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Uploadcsv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Welcome_model', 'welcome');
    }

    public function importbulkemail() {
        $this->load->view('excelimport');
    }

    public function import() {
        if (isset($_POST["import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                $file = fopen($filename, "r");
                while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $data = array(
                        'selectevent' => $importdata[0],
                        'eventname' => $importdata[1],
                        'email' => $importdata[2],
                        'registration_type' => $importdata[3],
                        
                        'reg_type_no' => $importdata[4],
                        'regno' => $importdata[5],
                        'title' => $importdata[6],
                        'name' => $importdata[7],
                        
                        'company' => $importdata[8],
                        'telephone' => $importdata[9],
                        'country' => $importdata[10],
                        'addr1' => $importdata[11],
                        
                        'addr2' => $importdata[12],
                        'city' => $importdata[13],
                        'postal_code' => $importdata[14],
                        'pro_fees' => $importdata[15],
                        
                        'ref_deposit' => $importdata[16],
                        'refno_gen' => $importdata[17],
                        'date' => $importdata[18],
                        'trans_id' => $importdata[19],
                        'pay_status' => $importdata[20],
                        'password' => $importdata[21],
                    );
                    $insert = $this->welcome->insertCSV($data);
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('Admin_registration/buyers');
            } else {
                $this->session->set_flashdata('message', 'Something went wrong..');
                redirect('Admin_registration/buyers');
            }
        }
    }
    public function importseller(){
        if (isset($_POST["import"])) {
            $filename = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) {
                $file = fopen($filename, "r");
                while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $data = array(
                        'selectevent' => $importdata[0],
                        'eventname' => $importdata[1],
                        'email' => $importdata[2],
                        'sel_type' => $importdata[3],
                        
                        'title' => $importdata[4],
                        'name' => $importdata[5],
                        'company' => $importdata[6],
                        'telephone' => $importdata[7],
                        
                        'country' => $importdata[8],
                        'addr1' => $importdata[9],
                        'addr2' => $importdata[10],
                        'city' => $importdata[11],
                        
                        'postal_code' => $importdata[12],
                        'stall_no' => $importdata[13],
                        'date' => $importdata[14],
                        'refno_gen' => $importdata[15],
                        'password' => $importdata[16],
                    );
                    $insert = $this->welcome->insertCSVseller($data);
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('Admin_registration/seller');
            } else {
                $this->session->set_flashdata('message', 'Something went wrong..');
                redirect('Admin_registration/seller');
            }
        }
    }

}
