<?php

class UserController extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('userModel');
      $this->load->helper('url');
  }

  public function personalPage()
  {
    $this->load->view('header');
    $this->load->view('users/personal-page');
    $this->load->view('footer');
  }
  public function personalData()
  {
    $user = $this->session->user;
    $this->load->view('header');
    $this->load->view('users/personal-data', ['user'=>$user]);
    $this->load->view('footer');
  }
  public function update(){
    $id = $this->session->user->id;

    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('phone', 'Telefone', 'required');


    if ($this->form_validation->run() === FALSE) {
      $result = $this->userModel->getByID($id);
      $this->load->view('header');
      $this->load->view('users/personal-data', ['user'=>$result]);
      $this->load->view('footer');
    } else {
      $this->userModel->update($id);
      $user = $this->userModel->getByID($id);
      $this->session->set_userdata(['user' => $user]);
      redirect(base_url('/meus-dados'));
      die();

    }
  }
}
