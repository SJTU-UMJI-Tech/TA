<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function home(){
        $this->load->view('manager_app_header');
        $this->load->view('manager_app_workshop');
    }
    
    public function openworkshop(){
        $this->load->view('manager_app_header');
        $this->load->view('manager_app_openworkshop');
    }

    public function saveworkshop(){
        $topic=$this->input->post("topic");
        $date=$this->input->post("date");
        $time=$this->input->post("time");
        $duration=$this->input->post("duration");
        $speaker=$this->input->post("speaker");
        $place=$this->input->post("place");
        $maxstu=$this->input->post("maxstu");
        $curstu=$this->input->post("curstu");
        $data = array(
            'topic'=>$topic,
            'date'=>$date,
            'time'=>$time,
            'duration'=>$duration,
            'speaker'=>$speaker,
            'place'=>$place,
            'maxstu'=>$maxstu,
            'curstu'=>$curstu,
            'status'=>0
        );
        $this->load->model("Meditman");
        $bool=$this->Meditman->saveworkshop($data);
        $this->load->view('manager_app_header');
        if ($bool){
            $this->load->view('manager_app_workshop');
        } else {
            $this->load->view('manager_app_failopen');
        }
    }

    public function currentworkshop(){
        $this->load->view('manager_app_header');
        $this->load->model('Meditman');
        $list=$this->Meditman->showcurrent();
        $data['list']=$list;
        $this->load->view('manager_app_currentworkshop',$data);
    }

    public function closedworkshop(){
        $this->load->view('manager_app_header');
        $this->load->model('Meditman');
        $list=$this->Meditman->showclosed();
        $data['list']=$list;
        $this->load->view('manager_app_closedworkshop',$data);
    }
}