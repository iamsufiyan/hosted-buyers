<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(0);

Class Admin_registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('seller_model');
        $this->load->helper('string');
        $this->load->helper('security');
        $this->load->library('email');
        /* ------------------ */
    }

    function product_data() {
        $data = $this->admin_model->product_list();
        echo json_encode($data);
    }

    function save() {
        $data = $this->admin_model->save_product();
        echo json_encode($data);
    }

    function update() {
        $data = $this->admin_model->update_product();
        echo json_encode($data);
    }

    function delete() {
        $data = $this->admin_model->delete_product();
        echo json_encode($data);
    }

    public function addadmin() {

        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/add-admin');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    public function insert_buyer() {
        $a = uniqid();
        $b = date('dmY');
        $c = time();
        $ref = $a . $b . $c;
        $this->form_validation->set_rules('selectevent', 'Select Event', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[add_buyer.email]');
        $this->form_validation->set_rules('reg_type', 'Select registration Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('regno', 'Enter Registration No', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $date = date('Y-m-d');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/buyer_view');
        } else {
            $data1 = array(
                'selectevent' => $_POST['selectevent'],
                'eventname' => $_POST['event_name'],
                'registration_type' => $_POST['get_reg'],
                'email' => $_POST['email'],
                'reg_type_no' => $_POST['reg_type'],
                'regno' => $_POST['regno'],
                'title' => $_POST['title'],
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'telephone' => $_POST['telephone'],
                'country' => $_POST['country'],
                'addr1' => $_POST['addr1'],
                'addr2' => $_POST['addr2'],
                'city' => $_POST['city'],
                'postal_code' => $_POST['pcode'],
                'pro_fees' => $_POST['processingfee'],
                'ref_deposit' => $_POST['rdeposit'],
                'date' => $date,
                'refno_gen' => $ref
            );
            $this->db->set($data1);
            $data2 = array(
                'email' => $_POST['email'],
                'regno' => $_POST['regno'],
                'title' => $_POST['title'],
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'telephone' => $_POST['telephone'],
                'country' => $_POST['country'],
                'addr1' => $_POST['addr1'],
                'addr2' => $_POST['addr2'],
                'city' => $_POST['city'],
                'postal_code' => $_POST['pcode'],
                'refno_gen' => $ref
            );
            $this->db->set($data2);
            $result = $this->admin_model->insert_buyer($data1);
            $result = $this->admin_model->insert_buyer_com1($data2);
            $base = base_url();
            if ($result == true) {
                ?><script>alert('Buyer Created Successfully'); window.location.href = '<?php echo base_url(); ?>add-buyers'</script>";<?php
            } else {
                echo "<script>alert('Failed'); window.location.href='$base/add-buyers'</script>";
            }
        }
    }

    public function insert_seller() {
        $a = uniqid();
        $b = date('dmY');
        $c = time();
        $ref = $a . $b . $c;
        $this->form_validation->set_rules('selectevent', 'Select Event', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[add_seller.email]');
        $this->form_validation->set_rules('sel_type', 'Select Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $date = date('Y-m-d');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/seller_view');
        } else {
            $data1 = array(
                'selectevent' => $_POST['selectevent'],
                'eventname' => $_POST['event_name'],
                'email' => $_POST['email'],
                'sel_type' => $_POST['sel_type'],
                'title' => $_POST['title'],
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'telephone' => $_POST['telephone'],
                'country' => $_POST['country'],
                'addr1' => $_POST['addr1'],
                'addr2' => $_POST['addr2'],
                'city' => $_POST['city'],
                'postal_code' => $_POST['pcode'],
                'stall_no' => $_POST['stallno'],
                'date' => $date,
                'refno_gen' => $ref
            );
            $this->db->set($data1);
            $data2 = array(
                'email' => $_POST['email'],
                'title' => $_POST['title'],
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'telephone' => $_POST['telephone'],
                'country' => $_POST['country'],
                'addr1' => $_POST['addr1'],
                'addr2' => $_POST['addr2'],
                'city' => $_POST['city'],
                'postal_code' => $_POST['pcode'],
                'refno_gen' => $ref
            );
            $this->db->set($data2);
            $result = $this->admin_model->insert_seller($data1);
            $result = $this->admin_model->insert_seller_com1($data2);
            $base = base_url();
            if ($result == true) {
                ?> <script>alert('Seller Created Successfully'); window.location.href = '<?php echo base_url(); ?>add-sellers'</script>";<?php
            } else {
                echo "<script>alert('Failed'); window.location.href='$base/add-sellers'</script>";
            }
        }
    }

    public function insert_admin() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $date = date('d-m-Y');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/add-admin');
        } else {
            $data1 = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'date' => $date
            );
            $result = $this->admin_model->insert_admin($data1);
            $base = base_url();
            if ($result == true) {
                ?><script>alert('Admin Created Successfully'); window.location.href = '<?php echo base_url(); ?>add-admin'</script>";<?php
            } else {
                echo "<script>alert('Failed'); window.location.href='$base/add-admin'</script>";
            }
        }
    }

    public function insert_event() {
        $this->form_validation->set_rules('eventname', 'Event Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shortname', 'Event Short Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('eventkey', 'Event key', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sed', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
        $date = date('d-m-Y');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/addevent');
        } else {
            $data1 = array(
                'eventname' => $_POST['eventname'],
                'shortname' => $_POST['shortname'],
                'eventkey' => $_POST['eventkey'],
                'event_date' => $_POST['sed'],
                'no_of_days' => $_POST['nod'],
                'description' => $_POST['description'],
                'date' => $date
            );
            $this->db->set($data1);
            $result = $this->admin_model->insert_event($data1);
            $base = base_url();
            if ($result == true) {
                ?><script>alert('Event Created Successfully'); window.location.href = '<?php echo base_url(); ?>add-event'</script>";<?php
            } else {
                echo "<script>alert('Failed'); window.location.href='$base/add-event'</script>";
            }
        }
    }

    public function dashboard() {
        $this->load->helper('security');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $this->load->view('admin/dashboard');
            } else {
                $this->load->view('admin/admin-login');
            }
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('pass'),
            );
            $result = $this->admin_model->login($data);
            if ($result == TRUE) {
                $username = $this->input->post('username');
                $result = $this->admin_model->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->email
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    redirect('dashboard');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('admin/admin-login', $data);
            }
        }
    }

    public function logout() {
// Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('admin/admin-login', $data);
    }

    public function delete_admin($id) {
        $result = $this->admin_model->delete_admin($id);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php base_url(); ?>add-admin'</script>";<?php
        } else {
            echo "<script>window.location.href='$base/add-admin'</script>";
        }
    }

    public function delete_reg($id) {
        $result = $this->admin_model->delete_reg($id);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php base_url(); ?>registration-type'</script>";<?php
        } else {
            echo "<script>window.location.href='$base/registration-type'</script>";
        }
    }

    public function delete_event($id) {
        $result = $this->admin_model->delete_event($id);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php base_url(); ?>add-event'</script>";<?php
        } else {
            echo "<script>window.location.href='$base/add-event'</script>";
        }
    }

    public function edit_admin($id) {
        $result = $this->admin_model->edit_admin($id);
        foreach ($result as $row) {
            
        }
        echo "
        <input type='hidden' name='id' value='$row->id'>    
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Username</label> 
                    <input class='form-control' name='username' value = '$row->username'>
            </div>
        </div>
      </div>
      <div class='col-md-12' style='display:none;'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Password</label> 
                    <input type='password' class='form-control' name='password' value='$row->password'>
            </div>
        </div>
        </div>
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Update Password</label> 
                    <input type='password' class='form-control' name='upassword' value='' required>
            </div>
        </div>
        </div>
        <div class='col-md-12'style='margin-top: 24px'>
                            <div class = 'box-body'>
                                <div class='form-group'>
                                    <input type='submit' value='submit' class='btn btn-primary'>
                                </div>
                            </div>
        </div>";
    }

    public function edit_event($id) {

        $result = $this->admin_model->edit_event($id);
        foreach ($result as $row) {
            
        }
        $dates = $row->event_date;
        $from = trim(substr($dates, -28, 10));
        $to = substr($dates, -10);

        echo "
        <input type='hidden' name='id' value='$row->id'>    
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Event Name</label> 
                    <input class='form-control' name='eventname' value = '$row->eventname'>
            </div>
        </div>
      </div>
      <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Short Name</label> 
                    <input type='text' class='form-control' name='shortname' value='$row->shortname'>
            </div>
        </div>
        </div>
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Event key</label> 
                    <input type='text' class='form-control' name='eventkey' value='$row->eventkey'>
            </div>
        </div>
        </div>
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Event From date</label> 
                    <input type='date' class='form-control' name='fromdate' id='fromdate' value='$from'>
            </div>
        </div>
        </div>
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Event To date</label> 
                    <input type='date' class='form-control' name='todate' id='todate' value='$to'>
            </div>
        </div>
        </div>
        <div class='col-md-12'>
        <div class = 'box-body'>
            <div class = 'form-group'>
                <label>Description</label> 
                    <textarea class='form-control' name='description'  id='description'>$row->description</textarea>
            </div>
        </div>
        </div>
        <div class='col-md-12'style='margin-top: 24px'>
                            <div class = 'box-body'>
                                <div class='form-group'>
                                    <input type='submit' value='submit' class='btn btn-primary'>
                                </div>
           </div>
        </div>";
    }

    public function updateadmin() {
        $id = $_POST['id'];
        $password = $_POST['upassword'];
        $result = $this->admin_model->updateadmin($password, $id);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php base_url(); ?>add-admin'</script>";<?php
        } else {
            echo "<script>alert('Admin Updated Successfully'); window.location.href='$base/add-admin'</script>";
        }
    }

    function addevent() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/addevent');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    function regtype() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/registration-type');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    function buyers() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/buyer_view');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    function seller() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/seller_view');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    function count_days($date) {
        $from = trim(substr($date, -28, 10));
        $to = substr($date, -10);
        $from1 = strtotime($from);
        $tos = strtotime($to);
        $date_diff = ($tos - strtotime($from)) / 86400;
        $dayss = round($date_diff, 0);
        echo $dayss;
    }

    public function updateevent() {
        $from = $_POST['fromdate'];
        $to = $_POST['todate'];
        $selectdate = "$from - $to";
        $from1 = strtotime($from);
        $tos = strtotime($to);
        $date_diff = ($tos - strtotime($from)) / 86400;
        $total_days = round($date_diff, 0);

        $id = $_POST['id'];
        $eventname = $_POST['eventname'];
        $shortname = $_POST['shortname'];
        $eventkey = $_POST['eventkey'];
        $no_of_days = $total_days;
        $event_date = $selectdate;
        $description = $_POST['description'];
        $result = $this->admin_model->updateevent($id, $eventname, $shortname, $eventkey, $no_of_days, $event_date, $description);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php echo base_url(); ?>add-event'</script>";<?php
        } else {
            ?><script>alert('Event Updated Successfully'); window.location.href = '<?php echo base_url(); ?>add-event'</script>";<?php
        }
    }

    public function count_day($from, $to) {
        $from1 = strtotime($from);
        $tos = strtotime($to);
        $date_diff = ($tos - strtotime($from)) / 86400;
        $dayss = round($date_diff, 0);
        echo $dayss;
    }

    public function register_type() {
        $this->form_validation->set_rules('regtype', 'Enter registration Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/add-admin');
        } else {
            $data1 = array(
                'uniqno' => $_POST['uniqno'],
                'reg_type' => $_POST['regtype']
            );
            $result = $this->admin_model->register_type($data1);
            $base = base_url();
            if ($result == true) {
                ?><script>window.location.href = '<?php echo base_url(); ?>registration-type'</script>";<?php
            } else {
                ?><script>alert('Failed'); window.location.href = '<?php echo base_url(); ?>registration-type'</script>";<?php
            }
        }
    }

    public function get_event_filter($key) {
        ?>
        <th>All<br><input type="checkbox" id="checkAl"></th>
        <th style="width: 10px">#</th>
        <th>Regno</th>
        <th>Name</th>
        <th>Event</th>
        <th>Company</th>
        <th>Reg-type</th>
        <th>Trans Id</th>
        <th>Pay Status</th>
        <th>Generate<br>Password</th>
        <th>Edit</th>
        </tr>
        <?php
        $i = 1;
        $result = $this->admin_model->get_event_filter($key);
        foreach ($result as $row) {
            ?>
            <tr>
                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row->id; ?>"></td>
                <td><?php echo $i ?></td>
                <td><?php echo $row->regno ?></td>
                <td><?php echo $row->name ?></td>
                <td>
                    <?php
                    $a1 = $this->admin_model->get_event_name($row->selectevent);
                    foreach ($a1 as $a2) {
                        
                    }
                    echo $a2->eventname;
                    ?>
                <td><?php echo $row->company ?></td>
                <td>
                    <?php
                    $c1 = $this->admin_model->get_reg_name($row->reg_type_no);
                    foreach ($c1 as $c2) {
                        
                    }
                    echo $c2->reg_type;
                    ?></td>

                <td><?php
                    if ($row->trans_id == '') {
                        echo "Not Paid";
                    } else {
                        echo "$row->trans_id";
                    }
                    ?></td>
                <td><?php
                    if ($row->pay_status == '') {
                        echo "Not Paid";
                    } else {
                        echo "$row->pay_status";
                    }
                    ?></td>
                <?php
                if ($row->password == '') {
                    echo" <td><div><a href='' class='fa fa-lock' style='color:red!important' data-toggle='modal' data-target='#exampleModalCenter' onclick='get_outwards_data($row->id);' data-target='#myModals'></a>&nbsp;&nbsp;"
                    ;
                } else {
                    echo" <td><div><a href='#' class='fa fa-envelope' style='color:#17a2b8!important'></a>&nbsp;&nbsp;"
                    ;
                }
                ?>
                <?php
                echo" <td><div><a href='' class='fa fa-edit' style='color:blue!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                ;
                ?>

            </tr>
            <?php
            $i += 1;
        }
    }

    public function get_filter($ekey, $rkey) {
        ?>
        <th>All</th>
        <th style="width: 10px">#</th>
        <th>Regno</th>
        <th>Name</th>
        <th>Event</th>
        <th>Company</th>
        <th>Reg-type</th>
        <th>Trans Id</th>
        <th>Pay Status</th>
        <th>Generate1<br>Password</th>
        <th>Edit</th>
        </tr>
        <?php
        $i = 1;
        $result = $this->admin_model->get_filter($ekey, $rkey);
        foreach ($result as $row) {
            ?>
            <tr>
                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row->id; ?>"></td>
                <td><?php echo $i ?></td>
                <td><?php echo $row->regno ?></td>
                <td><?php echo $row->name ?></td>
                <td>
                    <?php
                    $a1 = $this->admin_model->get_event_name($row->selectevent);
                    foreach ($a1 as $a2) {
                        
                    }
                    echo $a2->eventname;
                    ?>
                <td><?php echo $row->company ?></td>
                <td>
                    <?php
                    $c1 = $this->admin_model->get_reg_name($row->reg_type_no);
                    foreach ($c1 as $c2) {
                        
                    }
                    echo $c2->reg_type;
                    ?></td>
                <td><?php
                    if ($row->trans_id == '') {
                        echo "Not Paid";
                    } else {
                        echo "$row->trans_id";
                    }
                    ?></td>
                <td><?php
                    if ($row->pay_status == '') {
                        echo "Not Paid";
                    } else {
                        echo "$row->pay_status";
                    }
                    ?></td>
                <?php
                if ($row->password == '') {
                    echo" <td><div><a href='' class='fa fa-lock' style='color:red!important' data-toggle='modal' data-target='#exampleModalCenter' onclick='get_outwards_data($row->id);' data-target='#myModals'></a>&nbsp;&nbsp;"
                    ;
                } else {
                    echo" <td><div><a href='#' class='fa fa-envelope' style='color:#17a2b8!important'></a>&nbsp;&nbsp;"
                    ;
                }
                ?>
                <?php
                echo" <td><div><a href='' class='fa fa-edit' style='color:blue!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                ;
                ?>

            </tr>
            <?php
            $i += 1;
        }
    }

    public function get_reg_type($event_key) {
        $result = $this->admin_model->get_reg_type($event_key);
        foreach ($result as $row) {
            $r1 = $this->admin_model->get_reg_name($row->reg_type_no);
            foreach ($r1 as $r2) {
                
            }
            echo "<option value='$row->reg_type_no' >$r2->reg_type</option>";
        }
    }

    public function edit_buyer($id) {
        $result = $this->admin_model->edit_buyer($id);
        foreach ($result as $row) {
            
        }
        $a1 = $this->admin_model->get_event_name($row->selectevent);
        foreach ($a1 as $a2) {
            
        }
        $a3 = $this->admin_model->get_reg_name($row->reg_type_no);
        foreach ($a3 as $a4) {
            
        }
        $y = $this->admin_model->get_country_code($row->country);
        foreach ($y as $y1) {
            
        }
        ?>
        <input type='hidden' name='id' value='<?php echo $row->id ?>'>    
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Event Name</label> 
                    <select class='form-control' name='selectevent' onchange="get_event_name(this.value);">
                        <option value='<?php echo $a2->eventkey ?>'><?php echo $a2->eventname ?></option>
                        <?php
                        $r1 = $this->admin_model->select_event();
                        foreach ($r1 as $s1) {
                            echo "<option value='$s1->eventkey'>$s1->eventname</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="event_name" id="event_name" value="<?php echo $row->eventname ?>">
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row->email ?>" id="inputEmail3" placeholder="Email">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Registration Type</label> 
                    <select class='form-control' name='reg_type'  onchange="get_reg_fun(this.value);">
                        <option value="<?php echo $a4->uniqno ?>"><?php echo $a4->reg_type ?></option>
                        <?php
                        $r2 = $this->admin_model->select_registration();
                        foreach ($r2 as $s2) {
                            ?>
                            <option value="<?php echo $s2->uniqno ?>" ><?php echo $s2->reg_type ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="get_reg" id="get_reg" value="<?php echo $row->registration_type ?>">
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Registration No</label>
                    <input type="text" class="form-control" name="regno" value="<?php echo $row->regno ?>" id="regno">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Title</label>
                    <select class="form-control select2" name="title">                                        
                        <option value="<?php echo $row->title ?>"><?php echo $row->title ?></option>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Name</label>
                    <input type="text" name='name' class='form-control' value='<?php echo $row->name ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Company</label>
                    <input type="text" name='company' class='form-control' value='<?php echo $row->company ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Telephone</label>
                    <input type="text" name='telephone' class='form-control' value='<?php echo $row->telephone ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Country</label>

                    <select class="form-control select2" name="country">           
                        <option value='<?php echo $y1->code ?>'><?php echo $y1->name ?></option>                   
                        <?php
                        $d1 = $this->admin_model->get_country();
                        foreach ($d1 as $d2) {
                            ?>
                            <option value='<?php echo $d2->code ?>' ><?php echo $d2->name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Address Line 1</label>
                    <textarea class="form-control" name="addr1" id="addr1"><?php echo $row->addr1 ?></textarea>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Address Line 2</label>
                    <textarea class="form-control" name="addr2" id="addr2"><?php echo $row->addr2 ?></textarea>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>City</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $row->city ?>" id="city" placeholder="Enter City">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Postal Code</label>
                    <input type="text" class="form-control" name="pcode" value="<?php echo $row->postal_code ?>" id="pcode">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Processing Fee</label>
                    <input type="text" class="form-control" name="processingfee" value="<?php echo $row->pro_fees ?>" id="processingfee">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Refundable Deposit</label>
                    <input type="text" class="form-control" name="rdeposit" value="<?php echo $row->ref_deposit ?>" id="rdeposit">
                </div>
            </div>
        </div>


        <div class='col-md-12'style='margin-top: 24px'>
            <div class = 'box-body'>
                <div class='form-group'>
                    <input type='submit' value='Update' class='btn btn-primary'>
                </div>
            </div>
        </div><?php
    }

    public function get_edit_seller($id) {
        $result = $this->admin_model->edit_seller($id);
        foreach ($result as $row) {
            
        }
        $a1 = $this->admin_model->get_event_name($row->selectevent);
        foreach ($a1 as $a2) {
            
        }
        $y = $this->admin_model->get_country_code($row->country);
        foreach ($y as $y1) {
            
        }
        ?>
        <input type='hidden' name='id' value='<?php echo $row->id ?>'>    
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Event Name</label> 
                    <select class='form-control' name='selectevent' onchange="get_event_name(this.value);">
                        <option value='<?php echo $a2->eventkey ?>'><?php echo $a2->eventname ?></option>
                        <?php
                        $r1 = $this->admin_model->select_event();
                        foreach ($r1 as $s1) {
                            echo "<option value='$s1->eventkey'>$s1->eventname</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="event_name" id="event_name" value="<?php echo $row->eventname ?>">
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row->email ?>" id="email">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Seller Type</label>
                    <input type="text" class="form-control" name="sel_type" value="<?php echo $row->sel_type ?>" id="sel_type">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Title</label>
                    <select class="form-control select2" name="title">                                        
                        <option value="<?php echo $row->title ?>"><?php echo $row->title ?></option>
                        <option value="Mr">Mr</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Name</label>
                    <input type="text" name='name' class='form-control' value='<?php echo $row->name ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Company</label>
                    <input type="text" name='company' class='form-control' value='<?php echo $row->company ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Telephone</label>
                    <input type="text" name='telephone' class='form-control' value='<?php echo $row->telephone ?>'>
                </div>
            </div>
        </div>

        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Country</label>

                    <select class="form-control select2" name="country">           
                        <option value='<?php echo $y1->code ?>'><?php echo $y1->name ?></option>                   
                        <?php
                        $d1 = $this->admin_model->get_country();
                        foreach ($d1 as $d2) {
                            ?>
                            <option value='<?php echo $d2->code ?>' ><?php echo $d2->name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Address Line 1</label>
                    <textarea class="form-control" name="addr1" id="addr1"><?php echo $row->addr1 ?></textarea>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Address Line 2</label>
                    <textarea class="form-control" name="addr2" id="addr2"><?php echo $row->addr2 ?></textarea>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>City</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $row->city ?>" id="city" placeholder="Enter City">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Postal Code</label>
                    <input type="text" class="form-control" name="pcode" value="<?php echo $row->postal_code ?>" id="pcode">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Stall No</label>
                    <input type="text" class="form-control" name="stall_no" value="<?php echo $row->stall_no ?>" id="stall_no">
                </div>
            </div>
        </div>
        <div class='col-md-12'style='margin-top: 24px'>
            <div class = 'box-body'>
                <div class='form-group'>
                    <input type='submit' value='Update' class='btn btn-primary'>
                </div>
            </div>
        </div>
        <?php
    }

    public function updatebuyer() {
        $id = $_POST['id'];
        $selectevent = $_POST['selectevent'];
        $email = $_POST['email'];
        $registration_type = $_POST['get_reg'];
        $reg_type = $_POST['reg_type'];
        $regno = $_POST['regno'];
        $title = $_POST['title'];
        $name = $_POST['name'];
        $company = $_POST['company'];
        $telephone = $_POST['telephone'];
        $country = $_POST['country'];
        $addr1 = $_POST['addr1'];
        $addr2 = $_POST['addr2'];
        $city = $_POST['city'];
        $pcode = $_POST['pcode'];
        $processingfee = $_POST['processingfee'];
        $rdeposit = $_POST['rdeposit'];
        $event_name = $_POST['event_name'];

        $result = $this->admin_model->updatebuyer($registration_type, $event_name, $id, $selectevent, $email, $reg_type, $regno, $title, $name, $company, $telephone, $country, $addr1, $addr2, $city, $pcode, $processingfee, $rdeposit);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php echo base_url(); ?>add-buyers'</script>";<?php
        } else {
            echo "<script>alert('Buyer Updated Successfully'); window.location.href='$base/add-buyers'</script>";
        }
    }

    public function updateseller() {
        $id = $_POST['id'];
        $selectevent = $_POST['selectevent'];
        $event_name = $_POST['event_name'];
        $email = $_POST['email'];
        $sel_type = $_POST['sel_type'];
        $title = $_POST['title'];
        $name = $_POST['name'];
        $company = $_POST['company'];
        $telephone = $_POST['telephone'];
        $country = $_POST['country'];
        $addr1 = $_POST['addr1'];
        $addr2 = $_POST['addr2'];
        $city = $_POST['city'];
        $pcode = $_POST['pcode'];
        $stall_no = $_POST['stall_no'];
        $result = $this->admin_model->updateseller($event_name, $id, $selectevent, $email, $sel_type, $title, $name, $company, $telephone, $country, $addr1, $addr2, $city, $pcode, $stall_no);
        $base = base_url();
        if ($result == true) {
            ?><script>alert('Failed'); window.location.href = '<?php echo base_url(); ?>add-sellers'</script>";<?php
        } else {
            echo "<script>alert('Sellers Updated Successfully'); window.location.href='$base/add-sellers'</script>";
        }
    }

    public function get_list_seller($eventkey) {
        ?>
        <tr>
            <th>All<br><input type="checkbox" id="checkAl"></th>
            <th style = "width: 10px">#</th>
            <th>Name</th>
            <th>Event</th>
            <th>Comp</th>
            <th>Seller</th>
            <th>Generate<br>Password</th>
            <th>Edit</th>
        </tr>
        <?php
        $i = 1;
        $result = $this->admin_model->get_list_seller($eventkey);
        foreach ($result as $row) {
            ?>
            <tr>
                <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row->id; ?>"></td>
                <td><?php echo $i ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php
                    $a1 = $this->admin_model->get_event_name($row->selectevent);
                    foreach ($a1 as $a2) {
                        
                    }
                    echo $a2->eventname;
                    ?></td>
                <td><?php echo $row->company ?></td>
                <td><?php echo $row->sel_type ?></td>
                <?php
                if ($row->password == '') {
                    echo" <td><div><a href='' class='fa fa-lock' style='color:red!important' data-toggle='modal' data-target='#exampleModalCenter' onclick='get_outwards_data($row->id);' data-target='#myModals'></a>&nbsp;&nbsp;"
                    ;
                } else {
                    echo" <td><div><a href='#' class='fa fa-envelope' style='color:#17a2b8!important'></a>&nbsp;&nbsp;"
                    ;
                }
                ?>
                <?php
                echo" <td><div><a href='' class='fa fa-edit' style='color:blue!important' data-toggle='modal' onclick='get_outward_data($row->id);' data-target='#myModal'></a>&nbsp;&nbsp;"
                ;
                ?>

            </tr>
            <?php
            $i += 1;
        }
    }

    public function buyers_csv() {
        $date = date("Y-m-d h:i:sa");
        $this->load->dbutil(); // call db utility library
        $this->load->helper('download'); // call download helper
        $query = $this->db->query("SELECT * FROM add_buyer");
        $filename = 'buyers ' . $date . '.csv'; // name of csv file to download with data
        force_download($filename, $this->dbutil->csv_from_result($query)); // download file
    }

    public function sellers_csv() {
        $date = date("Y-m-d h:i:sa");
        $this->load->dbutil(); // call db utility library
        $this->load->helper('download'); // call download helper
        $query = $this->db->query("SELECT selectevent,eventname,email,sel_type,title,name,company,telephone,country,addr1,addr2,city,postal_code,stall_no,date,refno_gen from add_seller");
        $filename = 'sellers ' . $date . '.csv'; // name of csv file to download with data
        force_download($filename, $this->dbutil->csv_from_result($query)); // download file
    }

    public function get_event_name($key) {
        $result = $this->admin_model->get_event_name($key);
        foreach ($result as $row) {
            
        }
        echo "$row->eventname";
    }

    public function get_event_date($key) {
        $result = $this->admin_model->get_event_name($key);
        foreach ($result as $row) {
            
        }
        echo "$row->event_date";
    }

    public function get_reg($key) {
        $result = $this->admin_model->get_reg_name($key);
        foreach ($result as $row) {
            
        }
        echo "$row->reg_type";
    }

    public function deleteseller() {
        $checkbox = $_POST['check'];
        for ($i = 0; $i < count($checkbox); $i++) {
            $query = $this->db->query("DELETE FROM add_seller where id = '$checkbox[$i]'");
        }
        redirect('Admin_registration/seller');
    }

    public function deletebuyer() {
        $checkbox = $_POST['check'];
        for ($i = 0; $i < count($checkbox); $i++) {
            $query = $this->db->query("DELETE FROM add_buyer where id = '$checkbox[$i]'");
        }
        redirect('Admin_registration/buyers');
    }

    public function get_event_csv($eventkey) {
        ?>
        <a  href="<?php echo base_url() ?>index.php/Admin_registration/csv_buyer_key/<?php echo $eventkey ?>"  class="btn btn-info">Export To CSV</a>
        <?php
    }

    public function get_event_seller_csv($eventkey) {
        ?>
        <a  href="<?php echo base_url() ?>index.php/Admin_registration/csv_seller_key/<?php echo $eventkey ?>"  class="btn btn-info">Export To CSV</a>
        <?php
    }

    public function csv_buyer_key($eventkey) {
        $date = date("Y-m-d h:i:sa");
        $this->load->dbutil(); // call db utility library
        $this->load->helper('download'); // call download helper
        $query = $this->db->query("select * from add_buyer where `selectevent`='$eventkey'");
        $filename = 'Buyer ' . $eventkey . '.csv'; // name of csv file to download with data
        force_download($filename, $this->dbutil->csv_from_result($query)); // download file
    }

    public function csv_seller_key($eventkey) {
        $date = date("Y-m-d h:i:sa");
        $this->load->dbutil(); // call db utility library
        $this->load->helper('download'); // call download helper
        $query = $this->db->query("select * from add_seller where `selectevent`='$eventkey'");
        $filename = 'Seller ' . $eventkey . '.csv'; // name of csv file to download with data
        force_download($filename, $this->dbutil->csv_from_result($query)); // download file
    }

    public function get_event_type_csv($event, $type) {
        ?>
        <a  href="<?php echo base_url() ?>index.php/Admin_registration/csv_event_type/<?php echo $event ?>/<?php echo $type ?>"  class="btn btn-info">Export To CSV</a>
        <?php
    }

    public function csv_event_type($event, $type) {
        $date = date("Y-m-d h:i:sa");
        $this->load->dbutil(); // call db utility library
        $this->load->helper('download'); // call download helper
        $query = $this->db->query("select * from add_buyer where `selectevent`='$event' and reg_type_no='$type'");
        $filename = 'Buyer ' . $event . '.csv'; // name of csv file to download with data
        force_download($filename, $this->dbutil->csv_from_result($query)); // download file
    }

    public function gen_buyer_password($id) {
        $result = $this->admin_model->edit_buyer($id);
        foreach ($result as $row) {
            
        }
        ?>
        <input type="hidden" name="refno" value="<?php echo $row->refno_gen ?>">
        <div class='col-md-12' style="display:none">
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Registration No / User name</label>
                    <label class="form-control"><?php echo $row->regno ?></label>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Email</label>
                    <input type="email" class='form-control' name="email" value='<?php echo $row->email ?>'>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
        </div>
        <?php
    }

    public function gen_seller_password($id) {
        $result = $this->admin_model->edit_seller($id);
        foreach ($result as $row) {
            
        }
        ?>
        <input type="hidden" name="refno" value="<?php echo $row->refno_gen ?>">
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>User name</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row->email ?>">
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class = 'box-body'>
                <div class = 'form-group'>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
        </div>
        <?php
    }

    public function insert_buyer_password() {
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $refno = $_POST['refno'];
        $email = $_POST['email'];
        $password = $this->input->post('password');
        $result = $this->admin_model->insert_buyer_password($refno, $password);
        $r1 = $this->admin_model->select_buyers_ref($refno);
        foreach ($r1 as $r2) {
            
        }

        $data1 = array(
            'username' => $r2->name,
            'password' => $password,
            'email' => $email,
            'refno_gen' => $refno,
            'regno' => $r2->regno
        );
        $this->db->set($data1);
        $result = $this->admin_model->insert_buyer_details($data1);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'soffiyan.pathan@gmail.com', // change it to yours
            'smtp_pass' => '7899676739', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = '';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('soffiyan.pathan@gmail.com', Admin); // change it to yours
        $this->email->to($email); // change it to yours
        $this->email->subject('Hosted Buyers Password Generation');
        $message = "<div style='font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center' align='center' id='emb-email-header'>
			<p style='Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px'>Dear $r2->name ,</p> 
			<p style='Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px'>Your Account has been created at Hosted-Buyers please use below login credentials to login to your account. <br>username : $email <br>password : $password<br><br>
			<a style='border: 1px solid #28528e; color: white; background: #28528e; padding: 10px; text-decoration: none;' href='http://iitmindia.com/hosted-buyers/seller-login' class=btn btn-success>Access</a></p>
		</div>";
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        
        <head>
        </head>';

        $this->email->message($message);
        if ($this->email->send()) {
            ?><script>alert('Password Generated Successfully'); window.location.href = '<?php echo base_url(); ?>add-buyers'</script>";<?php
        } else {
            ?><script>alert('Password Generated Successfully'); window.location.href = '<?php echo base_url(); ?>add-buyers'</script>";<?php
        }
    }

    public function insert_seller_password() {
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->load->library('email');

        $refno = $_POST['refno'];
        $password = $this->input->post('password');
        $email = $_POST['email'];

        $result = $this->admin_model->insert_seller_password($refno, $password);
        $r1 = $this->admin_model->select_sellers_ref($refno);
        foreach ($r1 as $r2) {
            
        }
        $data1 = array(
            'username' => $r2->name,
            'password' => $password,
            'email' => $email,
            'refno_gen' => $refno
        );
        $this->db->set($data1);
        $result = $this->admin_model->insert_seller_details($data1);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'soffiyan.pathan@gmail.com', // change it to yours
            'smtp_pass' => '7899676739', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = '';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('soffiyan.pathan@gmail.com', Admin); // change it to yours
        $this->email->to($email); // change it to yours
        $this->email->subject('Hosted Sellers Password Generation');
        $message = "<div style='font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center' align='center' id='emb-email-header'>
			<p style='Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px'>Dear $r2->name ,</p> 
			<p style='Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px'>Your Account has been created at Hosted-Buyers please use below login credentials to login to your account. <br>username : $email <br>password : $password<br><br>
			<a style='border: 1px solid #28528e; color: white; background: #28528e; padding: 10px; text-decoration: none;' href='http://iitmindia.com/hosted-buyers/buyer-login' class=btn btn-success>Access</a></p>
		</div>";
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        
        <head>
        </head>';

        $this->email->message($message);
        if ($this->email->send()) {
            ?><script>alert('Password Generated Successfully'); window.location.href = '<?php echo base_url(); ?>add-sellers'</script>";<?php
        } else {
            ?><script>alert('Password Generated Successfully'); window.location.href = '<?php echo base_url(); ?>add-sellers'</script>";<?php
        }
    }

    public function send_buyer_email() {
        echo 1;
    }

    public function add_appointment() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/add-appoint');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    public function insert_appoint() {
        $event_key = $_POST["selectevent"];
        $event_name = $_POST["event_name"];
        $event_date = $_POST["edate"];
        $data = $this->input->post('bill');
        $i = 2;
        $length = 15;
        foreach ($data as $bill_item) {

            $dataadd = array(
                'event_key' => $event_key,
                'event_name' => $event_name,
                'total_event_date' => $event_date,
                'schedule_date' => $data[$i]['date'],
                'from_timing' => $data[$i]['from_timing'],
                'to_timing' => $data[$i]['to_timing'],
                'complete_time' => $data[$i]['from_timing'] . $data[$i]['to_timing']
            );
            $i = $i + 1;
            $cust_id = $this->admin_model->insert_appoint($dataadd);
        }
        $base = base_url();
        if ($cust_id == true) {
            echo "<script>alert('Scheduled Successfully'); window.location.href = '$base/Admin_registration/view_slot/$event_key'</script>";
        } else {
            echo "<script>alert('Failed'); window.location.href='$base/add-appointment'</script>";
        }
    }

    public function view_appoint() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/view-appoint');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    public function view_slot($key) {
        if (isset($this->session->userdata['logged_in'])) {
            $data = array(
                'key' => $key
            );
            $this->load->view('admin/view-manage-slots', $data);
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

    public function farm_home() {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('admin/farm');
        } else {
            echo "<script>alert('Please Sign In To Access The Page')</script>";
            $this->load->view('admin/admin-login');
        }
    }

}
