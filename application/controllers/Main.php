<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function index(){
        $this->load->view('Homepage');
    }
    public function Showcommand(){
        $this->load->view('Showcommand');
    }
    public function getlistCommand(){
        $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getlistCommand();
        $arr=array();
        foreach($result->result() as $row){
             $obj=new Command();
            $obj->Command_id=$row->Command_id;
           $obj->Command_genid=$row->Command_genid;
           $obj->Command_name=$row->Command_name;
           $obj->Command_startdate=$row->Command_startdate;
           $obj->Command_donedate=$row->Command_donedate;
           $obj->Command_status=$row->Command_status;
           $obj->Command_link=$row->Command_link;
            //echo " $row->Command_link <br>";
           array_push($arr,$obj);
        }
        echo json_encode($arr);
    }
    public function getCommand($id){
        $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getCommand($id);
        $arr=array();
        foreach($result->result() as $row){
            $obj=new Command();
            $obj->Command_id=$row->Command_id;
           $obj->Command_genid=$row->Command_genid;
           $obj->Command_name=$row->Command_name;
           $obj->Command_startdate=$row->Command_startdate;
           $obj->Command_donedate=$row->Command_donedate;
           $obj->Command_status=$row->Command_status;
           $obj->Command_link=$row->Command_link;
           array_push($arr,$obj);
        }
        echo json_encode($arr);
    }
   public function getListPageCommand($page){
        $this->load->model('My_model');
        $model=$this->My_model;
        $page=($page-1)*10;
        //ceil();
        $result=$model->getDataPage($page);
        $arr=array();

        foreach($result->result() as $row){
            array_push($arr,$row);
        }
        echo json_encode($arr);
   }
   public function getNumPage(){
       $this->load->model('My_model');
        $model=$this->My_model;
         echo ceil(($model->getNumRow()-1)/10);
   }
}

 class Command {
     public $Command_id;
     public $Command_genid;
     public $Command_name;
     public $Command_startdate;
     public $Command_donedate;
     public $Command_status;
     public $Command_link;
 }

?>