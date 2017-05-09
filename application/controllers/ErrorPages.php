<?php

class ErrorPages extends CI_Controller
{
  public function __construct()
  {
      parent:: __construct();
  }

  public function index()
  {
    $this->output->set_status_header('404');
    $this->load->view('header');
    $this->load->view('errors/cli/nao-encontrado');
    $this->load->view('footer');
  }
}
