<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    private $table = 'user';

    public function getDefaultValuesLogin(){
        return [
            'username'=>'',
            'password'=>'',
        ];
    }

    public function getValidationRulesLogin(){
        return [
            [
                'field'=>'username',
                'label'=>'Username',
                'rules'=>'trim|required'
            ],
            [
                'field'=>'password',
                'label'=>'Password',
                'rules'=>'trim|required'
            ]
        ];
    }

    public function validateLogin(){
        $rules = $this->getValidationRulesLogin();
        $this->form_validation->set_rules($rules);
        return $this->form_validation->run();
    }

    public function run($data){
        $username = $data->username;
        $password = md5(sha1(md5($data->password)));

        $user = $this->db->where('username',$username)
                             ->where('password',$password)
                             ->get($this->table)
                             ->row();
        
        if(count($user)){
            $sessionData = [
                'login'=>true,
                'username'=>$user->nama,
                'id'=>$user->id_user
            ];
            $this->session->set_userdata($sessionData);
            return true;
        }

        return false;
    }

    public function logout(){
        $sessionData = ['login','username','id'];
        $this->session->unset_userdata($sessionData);
        $this->session->sess_destroy();
    }

    public function updateUser($id,$data){
        return $this->db->where('id_user',$id)->update($this->table,$data);
    }
}
?>