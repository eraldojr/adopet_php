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

    if($this->input->post('name')==null){
    //if ($this->form_validation->run() === FALSE) {
      $this->load->view('header');
      $this->load->view('users/register');
      $this->load->view('footer');
    } else {
      $this->userModel->create();
      $data = ['msg' => "Cadastro realizado com sucesso! Agora você pode já pode fazer login."];
      $this->load->view('header');
      $this->load->view('main/main', $data);
      $this->load->view('footer');
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

          $data = $this->getPhoto($this->input->post('email'));
          if($user){
            $this->session->set_userdata(['user' => $user]);

            redirect('/minha-pagina');
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

  private function getPhoto($email){
      $directory = DATAPATH . 'users/' . $email;
      if(file_exists($directory)){
        $data['photo'] = scandir($directory);
      }else{
        $data['photo'] = null;
      }

      return $data;

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
    $data = $this->getPhoto($user->email);
    $this->load->view('header');
    $this->load->view('users/personal-data', ['user'=>$user, 'data'=>$data]);
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
  public function changePhoto(){
    $id = $this->session->user->id;
    $this->userModel->changePhoto();
    $user = $this->userModel->getByID($id);
    $this->session->set_userdata(['user' => $user]);
    $this->personalData();
  }
}
