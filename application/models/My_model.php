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
        public function getOneCommand($id){
            $sql="SELECT * FROM command WHERE Command_id like ?";
            $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function getMemberInCommand($id){
            $sql="SELECT * FROM `command` NATURAL JOIN member_in_command NATURAL JOIN member WHERE Command_id LIKE ?";
             $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function addCommand($genid,$name,$startdate,$donedate,$status){
            $sql="INSERT INTO `command`(`Command_genid`, `Command_name`, `Command_startdate`, `Command_donedate`, `Command_status`) 
            VALUES (?,?,?,?,?)";
            $data=array($genid,$name,$startdate,$donedate,$status);
            if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function addmember($fname,$lname,$position){
            $sql="INSERT INTO `member`(`Member_fname`, `Member_lname`, `Member_Position`) VALUES (?,?,?)";
            $data=array($fname,$lname,$position);
            if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function addmember_in_command($mid,$cid){
             $sql="INSERT INTO `member_in_command`(`Member_id`, `Command_id`) VALUES (?,?)";
             $data=array($mid,$cid);
             if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
    }

?>