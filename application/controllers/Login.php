<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(['url','form','sia','tgl_indo']);
        $this->load->library(['session','form_validation']);
        $this->load->model('User_model','user',true);
    }

    public function login(){
        if(!$_POST){
            $data = (object) $this->user->getDefaultValuesLogin();
        }else{
            $data = (object) $this->input->post(null,true);
        }

        if(!$this->user->validateLogin()){
            $this->load->view('login/login',compact('data'));
            return;
        }

        if(!$this->user->run($data)){
            $this->session->set_flashdata('pesan_error','Username atau Password salah');
            redirect('login');
        }else{
            $id_user = $this->session->userdata('id');
            $dataUser = ['last_login' => date('Y-m-d H:i:s')];
            $this->user->updateUser($id_user,$dataUser);
            redirect('dashboard');
        }
    }
}