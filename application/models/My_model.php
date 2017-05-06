<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class My_model extends CI_Model{
        public function getlistCommand(){
            $sql="SELECT * FROM command";
            return $this->db->query($sql);
        }
        public function getCommand($id){
            $sql="SELECT * FROM command WHERE Command_id like ?";
            $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function getDataPage($page){
             $sql="SELECT * FROM command LIMIT $page,10";
             
            return $this->db->query($sql);
        }
        public function getNumRow(){
            $this->db->from('command');
            $query = $this->db->get();  
            return $query->num_rows();
        }
    }

?>