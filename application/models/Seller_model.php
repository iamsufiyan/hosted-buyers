<?php

Class seller_model extends CI_Model {

    public function read_user_information($email) {

        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('seller_login');
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
        $this->db->from('seller_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function select_seller_ref($ref) {
        $query = $this->db->query("SELECT * FROM sellers_complete_detail where refno_gen='$ref'");
        return $query->result();
    }
    public function select_buyer_ref($ref){
        $query = $this->db->query("SELECT * FROM buyers_complete_detail as i join `add_buyer` as s on i.regno=s.regno where i.refno_gen='$ref'");
        return $query->result();
    }
    public function get_requester($refno){
        $query = $this->db->query("SELECT * FROM `buyer_booking` as i join `add_event` as s on  i.event_key=s.eventkey  where seller_refno = '$refno'");
        return $query->result();
    }
    public function get_data_accept($refno){
        $query = $this->db->query("SELECT * FROM buyer_booking where unique_id='$refno'");
        return $query->result();
    }
    public function get_buyer_booking($unique_id){
        $query = $this->db->query("SELECT * FROM buyer_booking where unique_id='$unique_id'");
        return $query->result();
    }

}
