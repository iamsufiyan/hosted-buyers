<?php

class Welcome_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertCSV($data) {
        $this->db->insert('add_buyer', $data);
        return TRUE;
    }

    public function insertCSVseller($data) {
        $this->db->insert('add_seller', $data);
        return TRUE;
    }

    public function view_data() {
        $query = $this->db->query("SELECT im.*
                                 FROM add_buyer im 
                                 ORDER BY im.id DESC
                                 limit 10");
        return $query->result_array();
    }

}
