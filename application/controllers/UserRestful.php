<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*//_____________________
|
|
|------------------------
| USER REST CONTROLLER
|------------------------
|
|
*///_____________________

require (APPPATH.'libraries/REST_Controller.php');

class UserRestful extends REST_Controller
{

	public function __construct()
	{
		parent::__construct('restful');
		$this->load->helper('url');
		$this->load->model('userModel');
	}

	public function index_get($id=null)
	{

		$action = $this->uri->segment(1);

	}

	public function responseJson($data=null)
	{
		if($data!==null){
			$_json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
		}else{
			$data = false;
		}
		$this->response($_json, 200);
	}


	public function doLogin_post()
	{

		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		$pass = $data->pass;

		if( $email == null){
			redirect(base_url('404'));
		}

		$user = $this->userModel->getByEmailAndPassword($email, $pass);
		if($user ==null)
		{
			$user = false;
		}

		$this->responseJson($user);

	}

	public function verifyEmail_post()
	{
		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		if($this->userModel->getByEmail($email)){
			$return = true;
		}else{
			$return = false;
		}
		$this->responseJson($return);
	}

	public function createUser_post()
	{

		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		$pass = $data->pass;

		if( $email == null){
			redirect(base_url('404'));
		}
		$user = [
				'name' => $data->name,
				'email' => $data->email,
				'phone' => $data->phone,
				'level' => 3,
				'pass' => password_hash($data->pass, PASSWORD_BCRYPT)
		];

		$return = $this->userModel->create($user);

		if($return)
		{
			$return = $this->userModel->getByEmail($email);
		}
		$this->responseJson($return);

	}

	public function editUser_post()
	{

		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		$pass = $data->pass;

		if( $email == null){
			redirect(base_url('404'));
		}
		$user = [
				'name' => $data->name,
				'email' => $data->email,
				'phone' => $data->phone,
				'level' => 3,
				'pass' => password_hash($data->pass, PASSWORD_BCRYPT)
		];

		$return = $this->userModel->create($user);

		if($return)
		{
			$return = $this->userModel->getByEmail($email);
		}
		$this->responseJson($return);

	}

}
