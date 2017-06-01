<?php

class AuthHook
{

  private $routes = [
    '',
    'sobre',
    'contato',
    'registro',
    'login',
    'logout',
    'nao-logado',
    'adote',
    'adote-rest',
    'rest',
    'adote-api',
    'registro-api',
    'verifica-email-api',
    'login-api',
    'pet/(:num)/mostrar',
    'meus-pets-api',
    'pet-api'
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

    if(!$user and !$this->verify($route))
    {
      redirect(base_url('nao-logado'));
    }
  }

  function verify($route){
    if(in_array($route, $this->routes)){
      return true;
    }else{
      return true;
    }
  }
}
