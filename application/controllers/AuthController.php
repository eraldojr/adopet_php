<?php

class AuthController extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('userModel');
      $this->load->helper('url');
  }

  public function notLogged(){
    $this->load->view('header');
    $this->load->view('errors/cli/notLogged');
    $this->load->view('footer');

  }
  public function create(){
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('phone', 'Telefone', 'required');
    $this->form_validation->set_rules('pass', 'Senha', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('header');
      $this->load->view('users/register');
      $this->load->view('footer');
    } else {
      $this->userModel->new();
      redirect('/');
      die();
    }
  }

  public function login()
  {

      $this->load->library('form_validation');

      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('pass', 'Senha', 'required');

      if ($this->form_validation->run() === FALSE) {
          $this->load->view('header');
          $this->load->view('main/main');
          $this->load->view('footer');
      } else {
          $user = $this->userModel->getByEmailAndPassword();
          if($user){
            $this->session->set_userdata(['user' => $user]);
            redirect(base_url('minha-pagina'));
            return;
          }
          redirect(base_url('/'));
          return;
      }
  }

  public function logout()
  {
      $this->session->unset_userdata('user');
      redirect(base_url('/'));
      die();
  }

}
