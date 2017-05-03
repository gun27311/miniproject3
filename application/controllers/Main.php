<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller{
    public function index(){
        $this->load->view('Homepage');
    }
    public function Showcommand(){
        $this->load->view('Showcommand');
    }
    public function getdata(){
        echo "12344";
    }
}



?>