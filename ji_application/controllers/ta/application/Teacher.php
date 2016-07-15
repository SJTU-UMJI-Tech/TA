<?php

class teacher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->load->helper('url');
        $this->load->view('prof_app_index');
    }

    public function classdetail()        //课程信息
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');
        $class = $this->Mpro_class->getclass();
        $data['class'] = $class;
        $this->load->view('prof_app_courselist', $data);
    }

    public function setstatus()  //开关申请
    {
        $this->load->helper(array('form', 'url'));
        $this->load->model('Mpro_class');
        $BSID = $this->input->post('BSID');
        $status = $this->input->post('status');
        $data = array(
            'status' => $status,
        );
        if ($this->Mpro_class->Msetstatus($data, $BSID)) {
            $this->load->view('prof_app_modifysuccess');
        }
    }

    public function setcourseinfo()  //设置课程信息
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[200]');
        $this->load->model('Mpro_class');
        if ($this->form_validation->run() == FALSE) {
            $class = $this->Mpro_class->getclass();
            $data['class'] = $class;
            $this->load->view('prof_app_courselist', $data);
        } else {
            $BSID = $this->input->post('BSID');
            $email = $this->input->post('email');
            $maxta = $this->input->post('maxta');
            $salary = $this->input->post('salary');
            $description = $this->input->post('description');
            $data = array(
                'maxta' => $maxta,
                'salary' => $salary,
                'email' => $email,
            );
            $data2 = array(
                'KCJJ' => $description
            );
            if ($this->Mpro_class->Msetcourseinfo($data, $data2, $BSID)) {
                $this->load->view('prof_app_modifysuccess');
            }
        }
    }

    public function viewunprocessed() //查看未处理的申请
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');
        $application = $this->Mpro_class->getapp1();
        $data['application'] = $application;
        $class = $this->Mpro_class->getclasslist();
        $data['class'] = $class;
        $this->load->view('prof_app_applications', $data);
    }

    public function viewprocessed() //查看已处理的申请
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');
        $application = $this->Mpro_class->getapp2();
        $data['application'] = $application;
        $class = $this->Mpro_class->getclasslist();
        $data['class'] = $class;
        $this->load->view('prof_app_applications2', $data);
    }

    public function process() //处理申请
    {
        $this->load->helper(array('form', 'url'));
        $this->load->model('Mpro_class');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data = array(
            'status' => $status,
        );
        if ($status == 2) {
            $data['interviewtime'] = $this->input->post('interviewtime');
        }
        if ($status == -1) {
            $data['rejectreason'] = $this->input->post('rejectreason');
        }
        if ($this->Mpro_class->Msetappinfo($data, $id)) {
            $this->load->view('prof_app_processsuccess');
        }
    }

    public function reprocess() //撤销已处理申请
    {
        $this->load->helper(array('form', 'url'));
        $this->load->model('Mpro_class');
        $id = $this->input->post('id');
        $data = array(
            'status' => 0,
            'interviewtime' => 'no_data',
            'rejectreason' => 'no_data'
        );
        if ($this->Mpro_class->Msetappinfo($data, $id)) {
            $this->load->view('prof_app_processsuccess');
        }
    }

    public function process_success()
    {
        $this->load->helper('url');
        $this->load->view('prof_app_processsuccess');
    }
}