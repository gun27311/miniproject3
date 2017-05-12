<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class My_model extends CI_Model{
        public function getlistCommand(){
            $sql="SELECT * FROM Command ";
            return $this->db->query($sql);
        }
        public function getlistCommand2(){
            $sql="SELECT * FROM Command ORDER BY Command_id desc";
            return $this->db->query($sql);
        }
        public function getCommand($id){
            $sql="SELECT * FROM Command WHERE Command_id like ?";
            $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function getDataPage($page){
            $sql="SELECT * FROM Command GROUP BY Command_id desc LIMIT $page,10";
            
            return $this->db->query($sql);
        }
        public function getNumRow(){
            $this->db->from('Command');
            $query = $this->db->get();  
            return $query->num_rows();
        }
        public function getNumRowMember(){
            $this->db->from('Member');
            $query = $this->db->get();  
            return $query->num_rows();
        }
        public function getOneCommand($id){
            $sql="SELECT * FROM Command WHERE Command_id like ?";
            $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function getMemberInCommand($id){
            $sql="SELECT * FROM `Command` NATURAL JOIN Member_in_Command NATURAL JOIN Member WHERE Command_id LIKE ?";
             $data=array($id);
            return $this->db->query($sql,$data);
        }
        public function changeStatus($id,$s){
            $sql="UPDATE `Command` SET `Command_status`=? WHERE Command_id like ?";
            $data=array($s,$id);
            $this->db->query($sql,$data);
        }
        public function addCommand($genid,$name,$startdate,$donedate,$status,$link){
            $sql="INSERT INTO `Command`(`Command_genid`, `Command_name`, `Command_startdate`, `Command_donedate`, `Command_status`,`Command_link`) 
            VALUES (?,?,?,?,?,?)";
            $data=array($genid,$name,$startdate,$donedate,$status,$link);
            if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function addmember($name,$position){
            $sql="INSERT INTO `Member`(`Member_name`, `Member_Position`) VALUES (?,?)";
            $data=array($name,$position);
            if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function addmember_in_command($mid,$cid){
             $sql="INSERT INTO `Member_in_Command` (`Member_id`, `Command_id`) VALUES (?,?)";
             $data=array($mid,$cid);
             if($this->db->query($sql,$data)){
                return true;
            }else{
                return false;
            }
        }
        public function getidcommand($genid,$name,$start,$done,$status){
            $sql="SELECT * FROM `Command` WHERE 
            `Command_genid`like ? and `Command_name` like ? and `Command_status` like ?";
            $data=array($genid,$name,$status);
            $result=$this->db->query($sql,$data);
               foreach($result->result() as $r){
                    return $r->Command_id;
               }
        }
        public function checkmemberid($name,$position){
            $sql="SELECT * FROM `Member` WHERE `Member_name` like ? ";
            $data=array($name);
            $result=$this->db->query($sql,$data);
            foreach($result->result() as $r){
                    return $r->Member_id;
               }
        }
        public function getallmember(){
            $sql="SELECT * FROM Member";
            return $this->db->query($sql);
        }
        public function deleteCommmand($cid){
            $sql="DELETE FROM `Member_in_Command` WHERE `Command_id` like ?";
            $data=array($cid);
            $this->db->query($sql,$data);
            $sql="DELETE FROM `Command` WHERE `Command_id` like ?";
             $this->db->query($sql,$data);
        }
        public function updatecommand($cgid,$cname,$cstart,$cstop,$cstatus,$cid,$link){
            $sql="UPDATE `Command` 
            SET `Command_genid`=?,`Command_name`=?,`Command_startdate`=?,`Command_donedate`=?,`Command_status`=? ,`Command_link`=? WHERE `Command_id` like ?";
            $data=array($cgid,$cname,$cstart,$cstop,$cstatus,$link,$cid);
            $this->db->query($sql,$data);
        }
        public function deleteMemberInCommand($cid){
            $sql="DELETE FROM `Member_in_Command` WHERE `Command_id` like ?";
            $data=array($cid);
            $this->db->query($sql,$data);
        }
        public function getnatural($cid){
            $sql="SELECT * FROM Member_in_Command NATURAL JOIN Member WHERE Command_id like ? ORDER BY Command_id desc";
            $data=array($cid);
            return $this->db->query($sql,$data);
        }
        public function getminyear(){
            $sql="SELECT Min(Command_startdate) AS miny FROM Command";
            $result=$this->db->query($sql);
             foreach($result->result() as $r){
                return $r->miny;
            }//css
            
        }
        public function getmaxyear(){
            $sql="SELECT Max(Command_startdate) AS maxy FROM Command";
            $result=$this->db->query($sql);
            foreach($result->result() as $r){
                return $r->maxy;
            }
            
        }
        public function getlistforyear($min,$max){
            $sql="SELECT * FROM Command WHERE Command_startdate BETWEEN '$min-00-00' AND '$max-00-00';";
            
             return $this->db->query($sql);
        }
        
    }

?>