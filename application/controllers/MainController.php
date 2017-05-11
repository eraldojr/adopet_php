<?php

class MainController extends CI_Controller
{

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('main/main');
		$this->load->view('footer');
	}
	public function about()
	{
		$this->load->view('header');
		$this->load->view('main/about');
		$this->load->view('footer');
	}
	public function contact()
	{
		$this->load->view('header');
		$this->load->view('main/contact');
		$this->load->view('footer');
	}
}
