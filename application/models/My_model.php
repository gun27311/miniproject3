<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class My_model extends CI_Model{
        public function getdata(){
            $sql="SELECT * FROM command";
            return $this->db->query($sql);
        }
    }

?>