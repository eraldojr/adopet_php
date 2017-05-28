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
    'adote-rest',
    'rest',
    'adote-api',
    'login-api',
    'pet/(:num)/mostrar'
  ];
  private $routes = [
    'meus-pets-api',
    'pet',
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
    $action = $CI->uri->segment(3);
    if(!$user and !$this->verify($route, $action))
    {
      redirect(base_url('nao-logado'));
    }
  }
  private function verify($route, $action){
    if(!in_array($route, $this->controller)){
      if((in_array($route, $this->routes) && $action == 'mostrar') || $route == $this->routes[0]){
          return true;
      }
      return false;
    }else{
      return true;
    }
  }

}
