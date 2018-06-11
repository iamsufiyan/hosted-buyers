<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

Class Sellers_login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('buyer_model');
        $this->load->model('admin_model');
        $this->load->model('seller_model');
        $this->load->helper('string');
        $this->load->helper('security');
    }

    public function dashboard() {
        $this->load->view('seller/seller-login');
    }

    public function home() {
        $this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $this->load->view('seller/seller-dashboard');
            } else {
                echo "<script>alert('Please Sign In To Access The Page')</script>";
                $this->load->view('seller/seller-login');
            }
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('pass'),
            );
            $result = $this->seller_model->login($data);
            if ($result == TRUE) {
                $email = $this->input->post('email');
                $result = $this->seller_model->read_user_information($email);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->email,
                        'refno_gen' => $result[0]->refno_gen,
                        'regno' => $result[0]->regno
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect('seller-dashboard');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('seller/seller-login', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('seller/seller-login', $data);
    }

    public function add_profile() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('seller/add-profile');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('seller/seller-login');
        }
    }

    public function insert_profile() {
        $refno = $_POST['refno'];
        $data = array(
            'title' => $_POST['title'],
            'name' => $_POST['name'],
            'DOB' => $_POST['dob'],
            'designation' => $_POST['designation'],
            'mobile_number' => $_POST['mphone'],
            'company_website' => $_POST['cweb'],
            'are_you_iata_member' => $_POST['iata'],
            'what_best_describes_your_business' => $_POST['buisness'],
            'organisations_affiliated' => $_POST['organisations_affiliated'],
            'designation' => $_POST['designation'],
            'annual_sales' => $_POST['annual'],
            'destinations_promoted' => $_POST['destination'],
            'company_profile' => $_POST['company_profile'],
            'photo_id_proof' => $_POST['pip'],
            'passengers_lastyear' => $_POST['passenger'],
            'attented' => $_POST['attented'],
            'company' => $_POST['company'],
            'telephone' => $_POST['tphone'],
            'addr1' => $_POST['addr1'],
            'addr2' => $_POST['addr2'],
            'city' => $_POST['city'],
            'postal_code' => $_POST['zcode']
        );
        $data2 = array(
            'title' => $_POST['title'],
            'name' => $_POST['name'],
            'company' => $_POST['company'],
            'telephone' => $_POST['tphone'],
            'addr1' => $_POST['addr1'],
            'addr2' => $_POST['addr2'],
            'city' => $_POST['city'],
            'postal_code' => $_POST['zcode']
        );
        $this->db->where('refno_gen', $_POST['refno']);
        $this->db->update('sellers_complete_detail', $data);
        $this->db->where('refno_gen', $_POST['refno']);
        $this->db->update('add_seller', $data2);
        redirect('Sellers_login/add_profile');
    }
    public function final_booked($unique_id) {
        $status = 'Booked';
        $data = array(
            'status' => $status
        );
        $bit = 1;
        $data1 = array(
            'bit' => $bit
        );
        $this->db->where('unique_id', $unique_id);
        $this->db->update('add_seller', $data);
        $this->db->where('unique_id', $unique_id);
        $this->db->update('appointment_schedule', $data);
        $this->db->where('unique_id', $unique_id);
        $this->db->update('buyer_booking', $data1);
        redirect('Sellers_login/home');
    }

    public function final_reject($unique_id) {
        $result = $this->seller_model->get_buyer_booking($unique_id);
        foreach ($result as $row) {
            
        }
        $data = array(
            'seller_refno' => $row->seller_refno,
            'app_event_date' => $row->app_event_date,
            'time' => $row->time,
            'event_key' => $row->event_key,
            'buyer_name' => $row->buyer_name,
            'refno_gen' => $row->refno_gen,
            'unique_id' => $row->unique_id
        );
        $flag = 2;
        $data1 = array(
            'bit' => $flag
        );
        $s1 = '';
        $data2 = array(
            'status' => $s1,
            'unique_id' => $s1
        );
        $data3 = array(
            'status' => $s1,
            'unique_id' => $s1
        );
        $this->db->insert('sellers_reject', $data);

        $this->db->where('unique_id', $row->unique_id);
        $this->db->update('buyer_booking', $data1);

        $this->db->where('refno_gen', $row->seller_refno);
        $this->db->update('add_seller', $data2);

        $this->db->where('unique_id', $row->unique_id);
        $this->db->update('appointment_schedule', $data3);

        redirect('Sellers_login/home');
    }

    public function view_buyer($refno) {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('head_foot/header-seller');
            $date = date('d-m-Y');
            $result = $this->seller_model->select_buyer_ref($refno);
            foreach ($result as $row) {}
            ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Invoice</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>seller-dashboard">Home</a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fa fa-globe"></i> Hosted Buyers
                                                <small class="float-right">Date: <?php echo $date ?></small>
                                            </h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            Buyer
                                            <address>
                                                <strong>Name : <?php echo $row->name ?></strong><br>
                                                Address 1 : <?php echo $row->addr1 ?><br>
                                                Address 1 : <?php echo $row->addr2 ?><br>
                                                Email : <?php echo $row->email ?><br>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>Event : <?php echo $row->eventname ?></strong><br>
                                                Registration-type : <?php echo $row->registration_type ?><br>
                                                Company : <?php echo $row->company ?><br>
                                                Telephone : <?php echo $row->telephone ?><br>                                                
                                                City : <?php echo $row->city ?><br>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            <address>
                                                <strong>Postal Code : <?php echo $row->postal_code ?></strong><br>
                                                Designation : <?php echo $row->Designation ?><br>
                                                DOB : <?php echo $row->DOB ?><br>
                                                Mobile Number : <?php echo $row->mobile_number ?><br>                                                
                                                Company Website : <?php echo $row->company_website ?><br>
                                            </address>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <?php
            $this->load->view('head_foot/footer');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('seller/seller-login');
        }
    }
    public function upload_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if ($status != "error") {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|docx';
            $config['max_size'] = 1024 * 8;

            $new_name = time() . $_FILES["userfile"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $refno = $_POST['refno'];
                $datas = array(
                    'user_pic'=>$new_name
                );
                $this->db->where('refno_gen', $refno);
                $this->db->update('add_seller', $datas);
                $this->db->where('refno_gen', $refno);
                $this->db->update('sellers_complete_detail', $datas);
                $file_id = $this->buyer_model->insert_file_out($new_name, $refno);
                if ($file_id) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        redirect('Sellers_login/add_profile/');
        //echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
