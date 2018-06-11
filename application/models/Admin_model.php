<?php
Class admin_model extends CI_Model {

    public function read_user_information($username) {

        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where($condition);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function login($data) {
        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function insert_admin($data2) {
        $q = $this->db->insert('admin_login', $data2);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert_appoint($data) {
        $q = $this->db->insert('appointment_schedule', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function select_admin() {
        $query = $this->db->query("SELECT * FROM admin_login");
        return $query->result();
    }

    function select_appoint() {
        $query = $this->db->query("SELECT distinct event_name,event_key FROM appointment_schedule");
        return $query->result();
    }

    function select_appoint_key($key) {
        $query = $this->db->query("SELECT distinct event_name,event_key,total_event_date FROM appointment_schedule where event_key='$key'");
        return $query->result();
    }

    function select_appoint_date($key) {
        $query = $this->db->query("SELECT schedule_date FROM appointment_schedule where event_key='$key'");
        return $query->result();
    }

    function select_appoint_start_time($key) {
        $query = $this->db->query("SELECT from_timing,to_timing FROM appointment_schedule where event_key='$key'");
        return $query->result();
    }

    public function select_event() {
        $query = $this->db->query("SELECT * FROM add_event");
        return $query->result();
    }

    public function delete_admin($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin_login');
    }

    public function deleteseller($del_id) {
        $this->db->where('id', $del_id);
        $this->db->delete('add_seller');
    }

    public function delete_event($id) {
        $this->db->where('id', $id);
        $this->db->delete('add_event');
    }

    public function delete_reg($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin_reg_type');
    }

    public function edit_admin($id) {
        $query = $this->db->query("SELECT * FROM admin_login where id='$id'");
        return $query->result();
    }

    public function edit_event($id) {
        $query = $this->db->query("SELECT * FROM add_event where id='$id'");
        return $query->result();
    }

    public function updateadmin($data1, $id) {
        $query = $this->db->query("update admin_login set password='$data1' where id='$id'");
    }

    public function updateevent($id, $eventname, $shortname, $eventkey, $no_of_days, $event_date, $description) {
        $query = $this->db->query("update add_event set `eventname`='$eventname',`shortname`='$shortname',"
                . "`eventkey`='$eventkey',`no_of_days`='$no_of_days',`event_date`='$event_date',`description`='$description'"
                . " where id='$id'");
    }

    public function insert_event($data1) {
        $q = $this->db->insert('add_event', $data2);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register_type($data1) {
        $q = $this->db->insert('admin_reg_type', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_buyer($data1) {
        $q = $this->db->insert('add_buyer', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_buyer_com1($data1) {
        $q = $this->db->insert('buyers_complete_detail', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_seller_com1($data1) {
        $q = $this->db->insert('sellers_complete_detail', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function select_acc_code() {
        $query = $this->db->query("SELECT uniqno FROM admin_reg_type ORDER BY ID Desc Limit 1");
        return $query->result();
    }

    public function select_registration() {
        $query = $this->db->query("SELECT * FROM admin_reg_type");
        return $query->result();
    }

    public function get_country() {
        $query = $this->db->query("SELECT * FROM countries");
        return $query->result();
    }

    public function get_country_code($key) {
        $query = $this->db->query("SELECT * FROM countries where code='$key'");
        return $query->result();
    }

    public function select_buyers() {
        $query = $this->db->query("SELECT * FROM add_buyer");
        return $query->result();
    }

    public function select_sellers_ref($ref) {
        $query = $this->db->query("SELECT * FROM add_seller where refno_gen='$ref'");
        return $query->result();
    }

    public function select_buyers_ref($ref) {
        $query = $this->db->query("SELECT * FROM add_buyer where refno_gen='$ref'");
        return $query->result();
    }

    public function get_event_name($key) {
        $query = $this->db->query("SELECT * FROM add_event where eventkey='$key'");
        return $query->result();
    }

    public function get_event_filter($key) {
        $query = $this->db->query("SELECT * FROM add_buyer where selectevent='$key'");
        return $query->result();
    }

    public function get_list_seller($key) {
        $query = $this->db->query("SELECT * FROM add_seller where selectevent='$key'");
        return $query->result();
    }

    public function get_reg_name($key) {
        $query = $this->db->query("SELECT * FROM admin_reg_type where uniqno='$key'");
        return $query->result();
    }

    public function get_filter($ekey, $rkey) {
        $query = $this->db->query("SELECT * FROM add_buyer where selectevent='$ekey' and reg_type_no='$rkey'");
        return $query->result();
    }

    public function get_reg_type($event_key) {
        $query = $this->db->query("SELECT distinct reg_type_no from add_buyer where selectevent='$event_key'");
        return $query->result();
    }

    public function edit_buyer($id) {
        $query = $this->db->query("SELECT * FROM add_buyer where id='$id'");
        return $query->result();
    }

    public function edit_seller($id) {
        $query = $this->db->query("SELECT * FROM add_seller where id='$id'");
        return $query->result();
    }

    public function updatebuyer($registration_type, $event_name, $id, $selectevent, $email, $reg_type, $regno, $title, $name, $company, $telephone, $country, $addr1, $addr2, $city, $pcode, $processingfee, $rdeposit) {
        $query = $this->db->query("update add_buyer set `registration_type`='$registration_type',`eventname`='$event_name', `selectevent`='$selectevent',`email`='$email',`reg_type_no`='$reg_type',`regno`='$regno',`title`='$title',`name`='$name',`company`='$company',`telephone`='$telephone',`country`='$country',`addr1`='$addr1',`addr2`='$addr2',`city`='$city',`postal_code`='$pcode',`pro_fees`='$processingfee',`ref_deposit`='$rdeposit' where id='$id'");
    }

    public function updateseller($event_name, $id, $selectevent, $email, $sel_type, $title, $name, $company, $telephone, $country, $addr1, $addr2, $city, $pcode, $stall_no) {
        $query = $this->db->query("update add_seller set `eventname`='$event_name', `selectevent`='$selectevent',`email`='$email',`sel_type`='$sel_type',`title`='$title',`name`='$name',`company`='$company',`telephone`='$telephone',`country`='$country',`addr1`='$addr1',`addr2`='$addr2',`city`='$city',`postal_code`='$pcode',`stall_no`='$stall_no' where id='$id'");
    }

    public function insert_seller($data1) {
        $q = $this->db->insert('add_seller', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function select_sellers() {
        $query = $this->db->query("SELECT * FROM add_seller");
        return $query->result();
    }

    public function count_buyer() {
        $query = $this->db->query("select count(id) as count from add_buyer");
        return $query->result();
    }

    public function count_seller() {
        $query = $this->db->query("select count(id) as count from add_seller");
        return $query->result();
    }

    public function count_event() {
        $query = $this->db->query("select count(id) as count from add_event");
        return $query->result();
    }

    public function insert_buyer_password($refno, $password) {
        $query = $this->db->query("update add_buyer set password='$password' where refno_gen='$refno'");
    }

    public function insert_seller_password($refno, $password) {
        $query = $this->db->query("update add_seller set password='$password' where refno_gen='$refno'");
    }

    public function insert_buyer_details($data1) {
        $q = $this->db->insert('buyer_login', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_seller_details($data1) {
        $q = $this->db->insert('seller_login', $data1);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
            
    function product_list(){
        $hasil=$this->db->get('farm');
        return $hasil->result();
    }
 
    function save_product(){
        $a = uniqid();
        $b = date('dmY');
        $c = time();
        $ref = $a . $b . $c;
        $data = array(
                'selectevent'  => $this->input->post('selectevent'),
                'farm_code'  => $this->input->post('farm_code'), 
                'farm_name'  => $this->input->post('farm_name'), 
                'max_reg' => $this->input->post('max_reg'), 
                'description' => $this->input->post('description'), 
                'refno_gen' => $ref,
                'max_available' =>$this->input->post('max_reg'), 
            );
        $result=$this->db->insert('farm',$data);
        return $result;
    }
 
    function update_product(){
        $selectevent=$this->input->post('selectevent');
        $farm_code=$this->input->post('farm_code');
        $farm_name=$this->input->post('farm_name');
        $max_reg=$this->input->post('max_reg');
        $description=$this->input->post('description');
 
        $this->db->set('farm_name', $farm_name);
        $this->db->set('max_reg', $max_reg);
        $this->db->set('description', $description);
        $this->db->set('selectevent', $selectevent);
        $this->db->where('farm_code', $farm_code);
        $result=$this->db->update('farm');
        return $result;
    }
 
    function delete_product(){
        $farm_code=$this->input->post('farm_code');
        $this->db->where('farm_code', $farm_code);
        $result=$this->db->delete('farm');
        return $result;
    }
    

}
