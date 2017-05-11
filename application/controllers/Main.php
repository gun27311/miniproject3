<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function index(){
        $this->load->view('Showcommand');
        //$this->load->view('Homepage');
    }
    public function Showcommand(){
        $this->load->view('Showcommand');
    }
    public function Showadd(){
        $this->load->view('addcommand');
    }
    public function getMaxYear(){
        $this->load->model('My_model');
        $model=$this->My_model;
        $s=strtotime($model->getmaxyear());
        $da=date("Y",$s);
        echo $da;
    }
    public function getMinYear(){
        $this->load->model('My_model');
        $model=$this->My_model;
        $s=strtotime($model->getminyear());
        $da=date("Y",$s);
        echo $da;
    }
    public function getlistforyear($min,$max){
         $this->load->model('My_model');
        $model=$this->My_model;
        $max++;
        $result=$model->getlistforyear($min,$max);
        $command=array();
       
    
        foreach($result->result() as $row){
            $obj=new Command();
             $meo=new Command();
             $s=$model->getnatural($row->Command_id);
             $m=array();
             foreach($s->result() as $r){
                
                array_push($m,$r);
             }
            $obj->Command=$row;
            $obj->Memberlist=$m;
            array_push($command,$obj);
            
               
        }
        echo json_encode($command);
        
    }
    public function getComplete(){
        $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getlistCommand2();
        $command=array();
       
    
        foreach($result->result() as $row){
            $obj=new Command();
             $meo=new Command();
             $s=$model->getnatural($row->Command_id);
             $m=array();
             foreach($s->result() as $r){
                
                array_push($m,$r);
             }
            $obj->Command=$row;
            $obj->Memberlist=$m;
            array_push($command,$obj);
               
        }
        echo json_encode($command);
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
        //$arr=array();

        //foreach($result->result() as $row){
         //   array_push($arr,$row);
        //}
        //echo json_encode($arr);
        $command=array();
        foreach($result->result() as $row){
            $obj=new Command();
             $meo=new Command();
             $s=$model->getnatural($row->Command_id);
             $m=array();
             foreach($s->result() as $r){
                array_push($m,$r);
             }
            $obj->Command=$row;
            $obj->Memberlist=$m;
            array_push($command,$obj);
               
        }
        echo json_encode($command);
   }
   public function getNumPage(){
       $this->load->model('My_model');
        $model=$this->My_model;
         echo ceil(($model->getNumRow()-1)/10);
   }
   public function showmem(){
        if(isset($_GET['comid']))
       echo $_GET['comid']."<br>";
       if(isset($_GET['comname']))
       echo $_GET['comname']."<br>";
       foreach($_GET['memberlist'] as $row=>$v){
           echo $v."<br>";
       }
       echo $_GET['comstart']."<br>";
       if(isset($_GET['comstop']))
       echo $_GET['comstop']."<br>";
      
   }
   public function showonecommand($id){
       $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getOneCommand($id);
        $s=array();
        foreach($result->result() as $x){
            $s=array(
                'Command_id' => $x->Command_id,
                'Command_genid' => $x->Command_genid,
                'Command_name' => $x->Command_name,
                'Command_startdate'=>$x->Command_startdate,
                'Command_donedate'=>$x->Command_donedate,
                'Command_status'=>$x->Command_status,
                'Command_link'=>$x->Command_link
            );
        }
        $ww=array();
        $result=$model->getMemberInCommand($id);
        foreach($result->result() as $row){
            array_push($ww,$row);
        }
        $s['memberlist']=$ww;
        $this->load->view('Showonecommand',$s);
        
   }
   public function changeStatus($id,$s){
        $this->load->model('My_model');
        $model=$this->My_model;
        if($s=='Active'){
            $x='expine';
        }else{
            $x='Active';
        }
        $model->changeStatus($id,$x);

   }
   public function addcommand(){
       
       if(isset($_POST['memberlist'])){
       $this->load->model('My_model');
        $model=$this->My_model;
        $model->addCommand($_POST['comid'],$_POST['comname'],$_POST['comstart'],$_POST['comstop'],$_POST['status'],$_POST['link']);
        $result=$model->getallmember();
        $cid=$model->getidcommand($_POST['comid'],$_POST['comname'],$_POST['comstart'],$_POST['comstop'],$_POST['status']);
       $check=false;
       $i=0;
       $nummem=$model->getNumRowMember();
       echo $nummem;
        foreach($_POST['memberlist'] as $k){
            
            foreach($result->result() as $row){
                if($row->Member_name==$k){
                    echo $row->Member_name;
                    $model->addmember_in_command($row->Member_id,$cid);
                    $check=false;
                    
                    break;
                }

                
                $check=true;
            }
            if($check||$nummem==0){
                
                $model->addmember($k,$_POST['prolist'][$i]);
                $mid=$model->checkmemberid($k,$_POST['prolist'][$i]);
                //echo "namemem=".$k."pro=".$_POST['prolist'][$i].' mid='.$mid.' cid='.$cid."<br>";
                $model->addmember_in_command($mid,$cid);
            }
            $i++;
        }
        header("location:".base_url()."/index.php/main/Showcommand");
       }else{
           echo "<script type='text/javascript'>alert('กรุณาเพิ่มกรรมการ');</script>";
           echo "<meta http-equiv='refresh' content='0;URL=".base_url()."/index.php/main/Showadd'>";
           //header("location:".base_url()."/index.php/main/Showadd");
       }
       //header("location:".base_url()."/index.php/main/Showcommand");
        //$_POST['comid'];
       // $_POST['comname'];
       
        //$_POST['comstart'];
       // $_POST['comstop'];

        //$_POST['memberlist'];
   }
   public function getnameallmember(){
    
        $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getallmember();
        $a=array();
        foreach($result->result() as $row){
            array_push($a,$row->Member_name);
        }
        echo json_encode($a);
   }
   public function deleteCommmand($cid){
          $this->load->model('My_model');
        $model=$this->My_model;
        $model->deleteCommmand($cid);
        header("location:".base_url()."/index.php/main/Showcommand");
   }
   public function Showeditcommmand($cid){
       $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getOneCommand($cid);
        $s=array();
        foreach($result->result() as $x){
            $s=array(
                'Command_id' => $x->Command_id,
                'Command_genid' => $x->Command_genid,
                'Command_name' => $x->Command_name,
                'Command_startdate'=>$x->Command_startdate,
                'Command_donedate'=>$x->Command_donedate,
                'Command_status'=>$x->Command_status,
                'Command_link'=>$x->Command_link
            );
        }
        $ww=array();
        $result=$model->getMemberInCommand($cid);
        foreach($result->result() as $row){
            array_push($ww,$row);
        }
        $s['memberlist']=$ww;
        $this->load->view('Edit',$s);
   }
   public function editcommand($cid){
        if(isset($_POST['memberlist'])){
       $this->load->model('My_model');
        $model=$this->My_model;
        $model->updatecommand($_POST['comid'],$_POST['comname'],$_POST['comstart'],$_POST['comstop'],$_POST['status'],$cid,$_POST['link']);
        $result=$model->getallmember();
        $model->deleteMemberInCommand($cid);
       $check=false;
       $i=0;
        foreach($_POST['memberlist'] as $k){
            
            foreach($result->result() as $row){
                if($row->Member_name==$k){
                    $model->addmember_in_command($row->Member_id,$cid);
                    $check=false;
                    break;
                }
                $check=true;
            }
            if($check){
               
                $model->addmember($k,$_POST['prolist'][$i]);
                $mid=$model->checkmemberid($k,$_POST['prolist'][$i]);
                //echo "namemem=".$k."pro=".$_POST['prolist'][$i].' mid='.$mid.' cid='.$cid."<br>";
                $model->addmember_in_command($mid,$cid);
            }
            $i++;
        }
       }
       header("location:".base_url()."/index.php/main/showonecommand/".$cid);
   }

   public function showsearch(){
       $this->load->model('My_model');
        $model=$this->My_model;
        $result=$model->getallmember();
        $a=array();
        foreach($result->result() as $row){
            array_push($a,$row->Member_name);
        }
        $g['json']=json_encode($a);
       $this->load->view('search',$g);
   }
}

 class Command {
     
 }
 class obj{}

?>