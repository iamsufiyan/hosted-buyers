<?php

Class buyer_model extends CI_Model {

    function __construct() {
        $this->tableName = 'buyer_seller_image';
        $this->primaryKey = 'refno_gen';
    }
    
    public function insert_file_out($new_name, $refno) {
        $date = date('Y-m-d');
        $data = array(
            'user_pic' => $new_name,
            'refno_gen' => $refno
        );
        $this->db->insert('buyer_seller_image', $data);
        return $this->db->insert_id();
    }

    public function insert($data = array()) {
        $insert = $this->db->insert($this->tableName, $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function read_user_information($email) {

        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('buyer_login');
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
        $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('buyer_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function select_buyers_ref($ref) {
        $query = $this->db->query("SELECT * FROM buyers_complete_detail where refno_gen='$ref'");
        return $query->result();
    }

    public function update_buyer_com1($refno, $data) {
        $this->db->from('buyers_complete_detail', $data);
        $this->db->where('refno_gen', $refno);
    }

    public function upload_file_out($filename, $refno) {
        $this->load->database();
        $data = array(
            'user_pic' => $filename,
            'refno_gen' => $refno
        );
        $this->db->insert('buyer_seller_image', $data);
    }

    public function select_uniq_event($event) {
        $query = $this->db->query("SELECT * FROM add_buyer where refno_gen='$event'");
        return $query->result();
    }

    public function count_seller($key) {
        $query = $this->db->query("select count(id) as count from add_seller where selectevent='$key'");
        return $query->result();
    }
    public function count_reject($refno_gen){
        $query = $this->db->query("select count(id) as count from sellers_reject where refno_gen='$refno_gen'");
        return $query->result();
    }
    public function count_accept($refno_gen){
        $query = $this->db->query("select count(id) as count from buyer_booking where refno_gen='$refno_gen' and bit='1'");
        return $query->result();
    }
    public function count_up($refno_gen){
        $query = $this->db->query("select count(id) as count from buyer_booking where refno_gen='$refno_gen' and bit=''");
        return $query->result();
    }
    
    public function count_farm_trip($key){
        $query = $this->db->query("select count(id) as count from `farm` where selectevent='$key'");
        return $query->result();
    }
    public function select_farm($key){
        $query = $this->db->query("select * from `farm` where selectevent='$key'");
        return $query->result();
    }

    public function select_sellers($key) {
        $query = $this->db->query("select * from add_seller where selectevent='$key'");
        return $query->result();
    }
    public function select_sell($key) {
        $query = $this->db->query("select * from add_seller where selectevent='$key' and status=''");
        return $query->result();
    }

    public function get_slots($key) {
        $query = $this->db->query("select * from appointment_schedule where event_key='$key'");
        return $query->result();
    }

    public function booked($key) {
        $query = $this->db->query("select * from appointment_schedule where status='booked'");
        return $query->result();
    }

    public function emptys($key) {
        $query = $this->db->query("select * from appointment_schedule where status='empty'");
        return $query->result();
    }

    public function insert_book($data) {
        $q = $this->db->insert('buyer_booking', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function status_book($app_event_date, $from_time, $to_time, $event_key, $status, $unique_id) {
        $query = $this->db->query("update appointment_schedule set `status`='$status',`unique_id`='$unique_id' where `schedule_date`='$app_event_date' and `from_timing`='$from_time' and `to_timing`='$to_time' and `event_key`='$event_key'");
    }
    public function update_seller_status($seller_refno,$status,$unique_id){
        $query = $this->db->query("update add_seller set status='$status',`unique_id`='$unique_id' where refno_gen='$seller_refno'");
    }
    public function check_booking($refno){
        $query = $this->db->query("SELECT buyer_refno FROM farm_booked WHERE buyer_refno = '$refno'");
        return $query->result();
    }
}

?>