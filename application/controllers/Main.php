<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function index(){
        $this->load->view('Homepage');
    }
    public function Showcommand(){
        $this->load0->view('Showcommand');
    }
    public function getlistCommand(){
      
        $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getdata();
        $arr=array();
        
        foreach($result->result() as $row){
             $obj=new Command();
            $obj->Command_id=$row->Command_id;
           $obj->Command_genid=$row->Command_genid;
           $obj->Command_startdate=$row->Command_startdate;
           $obj->Command_donedate=$row->Command_donedate;
           $obj->Command_status=$row->Command_status;
           $obj->Command_link=$row->Command_link;
            //echo " $row->Command_link <br>";
           array_push($arr,$obj);
        }
        echo json_encode($arr);
    }


}

 class Command {
     public $Command_id;
     public $Command_genid;
     public $Command_startdate;
     public $Command_donedate;
     public $Command_status;
     public $Command_link;
 }

?>