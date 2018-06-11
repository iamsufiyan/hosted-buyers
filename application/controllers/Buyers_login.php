<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

Class Buyers_login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('buyer_model');
        $this->load->model('admin_model');
        $this->load->helper('string');
        $this->load->helper('security');
        $this->load->library('email');
    }

    public function dashboard() {
        $this->load->view('buyer/buyer-login');
    }

    public function home() {
        $this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $this->load->view('buyer/buyer-dashboard');
            } else {
                echo "<script>alert('Please Sign In To Access The Page')</script>";
                $this->load->view('buyer/buyer-login');
            }
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('pass'),
            );
            $result = $this->buyer_model->login($data);
            if ($result == TRUE) {
                $email = $this->input->post('email');
                $result = $this->buyer_model->read_user_information($email);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->email,
                        'refno_gen' => $result[0]->refno_gen,
                        'regno' => $result[0]->regno
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect('buyer-dashboard');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('buyer/buyer-login', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('buyer/buyer-login', $data);
    }

    public function add_profile() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('buyer/add-profile');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('buyer/buyer-login');
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
        $this->db->update('buyers_complete_detail', $data);
        $this->db->where('refno_gen', $_POST['refno']);
        $this->db->update('add_buyer', $data2);
        redirect('Buyers_login/add_profile');
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
                $this->db->update('add_buyer', $datas);
                $this->db->where('refno_gen', $refno);
                $this->db->update('buyers_complete_detail', $datas);
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
        redirect('Buyers_login/add_profile/');
        //echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function view_seller() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('buyer/view-seller');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('buyer/buyer-login');
        }
    }

    public function booking($from, $to, $event_key, $date) {
        if (isset($this->session->userdata['logged_in'])) {
            $data = array(
                'from' => $from,
                'to' => $to,
                'event_key' => $event_key,
                'date' => $date
            );
            $this->load->view('buyer/booking', $data);
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('buyer/buyer-login');
        }
    }

    public function booking_insert() {
        $a = uniqid();
        $b = date('dmY');
        $c = time();
        $ref = $a . $b . $c;
        $app_event_date = $_POST['app_event_date'];
        $from_time = $_POST['from_time'];
        $to_time = $_POST['to_time'];
        $event_key = $_POST['event_key'];
        $status = "request";
        $seller_refno = $_POST['seller'];
        $this->form_validation->set_rules('seller', 'Seller', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('buyer/booking');
        } else {
            $data = array(
                'seller_refno' => $_POST['seller'],
                'app_event_date' => $_POST['app_event_date'],
                'time' => $_POST['time'],
                'event_key' => $_POST['event_key'],
                'buyer_name' => $_POST['bname'],
                'refno_gen' => $_POST['refno'],
                'unique_id' => $ref
            );
            $result = $this->buyer_model->insert_book($data);
            $result = $this->buyer_model->status_book($app_event_date, $from_time, $to_time, $event_key, $status, $ref);
            $result = $this->buyer_model->update_seller_status($seller_refno, $status, $ref);
            $base = base_url();
            if (!$result) {
                ?><script>alert('Data Inserted Successfully'); window.location.href = '<?php echo base_url(); ?>buyer-dashboard'</script>";<?php
            } else {
                echo "<script>alert('Failed'); window.location.href='$base/buyer-dashboard'</script>";
            }
        }
    }

    public function view_farm() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('buyer/view-farm');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('buyer/admin-login');
        }
    }

    public function booking_farm($buyer_refno, $farm_refno, $max_available) {
        if (isset($this->session->userdata['logged_in'])) {
            $a = $max_available - 1;
            $date = date('Y-m-d');
            $data = array(
                'farm_refno' => $farm_refno,
                'buyer_refno' => $buyer_refno,
                'book_date' => $date
            );
            $this->db->insert('farm_booked', $data);
            $data1 = array(
                'max_available' => $a
            );
            $this->db->where('refno_gen', $farm_refno);
            $this->db->update('farm', $data1);
            redirect('Buyers_login/home');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('buyer/admin-login');
        }
    }

}
