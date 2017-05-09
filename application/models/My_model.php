<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class My_model extends CI_Model{
        public function getlistCommand(){
            $sql="SELECT * FROM command ";
            return $this->db->query($sql);
        }
        public function getlistCommand2(){
            $sql="SELECT * FROM command ORDER BY Command_id desc";
            return $this->db->query($sql);
        }
        public function getCommand($id){
            $sql="SELECT * FROM command WHERE Command_id like ?";
            $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function getDataPage($page){
            $sql="SELECT * FROM command GROUP BY Command_id desc LIMIT $page,10";
            
            return $this->db->query($sql);
        }
        public function getNumRow(){
            $this->db->from('command');
            $query = $this->db->get();  
            return $query->num_rows();
        }
        public function getNumRowMember(){
            $this->db->from('member');
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
        public function addmember($name,$position){
            $sql="INSERT INTO `member`(`Member_name`, `Member_Position`) VALUES (?,?)";
            $data=array($name,$position);
            if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function addmember_in_command($mid,$cid){
             $sql="INSERT INTO `member_in_command` (`Member_id`, `Command_id`) VALUES (?,?)";
             $data=array($mid,$cid);
             if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function getidcommand($genid,$name,$start,$done,$status){
            $sql="SELECT * FROM `command` WHERE 
            `Command_genid`like ? and `Command_name` like ? and `Command_status` like ?";
            $data=array($genid,$name,$status);
            $result=$this->db->query($sql,$data);
               foreach($result->result() as $r){
                    return $r->Command_id;
               }
        }
        public function checkmemberid($name,$position){
            $sql="SELECT * FROM `member` WHERE `Member_name` like ? ";
            $data=array($name);
            $result=$this->db->query($sql,$data);
            foreach($result->result() as $r){
                    return $r->Member_id;
               }
        }
        public function getallmember(){
            $sql="SELECT * FROM member";
            return $this->db->query($sql);
        }
        public function deleteCommmand($cid){
            $sql="DELETE FROM `member_in_command` WHERE `Command_id` like ?";
            $data=array($cid);
            $this->db->query($sql,$data);
            $sql="DELETE FROM `command` WHERE `Command_id` like ?";
             $this->db->query($sql,$data);
        }
        public function updatecommand($cgid,$cname,$cstart,$cstop,$cstatus,$cid){
            $sql="UPDATE `command` 
            SET `Command_genid`=?,`Command_name`=?,`Command_startdate`=?,`Command_donedate`=?,`Command_status`=? WHERE `Command_id` like ?";
            $data=array($cgid,$cname,$cstart,$cstop,$cstatus,$cid);
            $this->db->query($sql,$data);
        }
        public function deleteMemberInCommand($cid){
            $sql="DELETE FROM `member_in_command` WHERE `Command_id` like ?";
            $data=array($cid);
            $this->db->query($sql,$data);
        }
        public function getnatural($cid){
            $sql="SELECT * FROM member_in_command NATURAL JOIN member WHERE Command_id like ? ORDER BY Command_id desc";
            $data=array($cid);
            return $this->db->query($sql,$data);
        }
        public function getminyear(){
            $sql="SELECT Min(Command_startdate) AS miny FROM command";
            $result=$this->db->query($sql);
             foreach($result->result() as $r){
                return $r->miny;
            }
            
        }
        public function getmaxyear(){
            $sql="SELECT Max(Command_startdate) AS maxy FROM command";
            $result=$this->db->query($sql);
            foreach($result->result() as $r){
                return $r->maxy;
            }
            
        }
        public function getlistforyear($min,$max){
            $sql="SELECT * FROM command WHERE Command_startdate BETWEEN '$min-00-00' AND '$max-00-00';";
            
             return $this->db->query($sql);
        }
        
    }

?>