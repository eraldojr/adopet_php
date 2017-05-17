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
    'nao-logado',
    'adote',
    'pet/(:num)/mostrar'
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
    $action = $CI->uri->segment(3);
    if(!$user and $this->verify($route, $action))
    {
      redirect(base_url('/nao-logado'));
    }
  }
  private function verify($route){
    if(!in_array($route, $this->controller)
    || $route !== "pet" || $action !== "mostrar"){
      return false;
    }else{
      return true;
    }
  }
}
