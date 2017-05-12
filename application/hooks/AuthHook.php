<?php

class AuthHook
{

  private $controller = [
    '',
    'sobre',
    'contato',
    'registro',
    'login',
    'logout',
    'nao-logado'

  ];

  public function check()
  {
    $CI =& get_instance();

    if(!isset($CI->session)){
      $CI->load->library('session');

    }
    $CI->load->helper('url');

    $user = $CI->session->user ?? null;
    $route = $CI->uri->segment(1);




    if(!$user and !in_array($route, $this->controller))
    {
      redirect(base_url('/nao-logado'));
    }
  }
}
