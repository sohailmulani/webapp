<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function index(){
    $this->load->library('form_validation');
    $this->load->view('admin/login');
  }

  public function authenticate(){
    $this->load->library('form_validation');
    $this->load->model('Admin_model');

    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('password','Password','trim|required');

    if($this->form_validation->run() == true){
      //Success
      $username = $this->input->post('username');
      $admin = $this->Admin_model->getByUsername($username);

      if (!empty($admin)) {
          $username = $this->input->post('password', $admin['password']);
        if (password_verufy()) {
          // code...
        }
      }else {
        $this->session->set_flashdata('msg','Either username or password is incorrect !');
        redirect(base_url().'admin/login/index');
      }
    }
    else {
      $this->load->view('admin/login');
    }
  }
}
  ?>
