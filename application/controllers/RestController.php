<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH.'libraries/REST_Controller.php');

class RestController extends REST_Controller
{
	private $adopt = "adote-api";
	private $myPets = "meus-pets-api";
	private $petShow = "pet-show-api";
	private $login = "login-api";

	public function __construct()
	{
		parent::__construct('restful');
		$this->load->helper('url');
		$this->load->model('petsModel');
	}

	public function index_get($id=null)
	{

		$action = $this->uri->segment(1);

		// if($action == $this->adopt){
		// 	$this->getAllPets();
		// }else if($action == $this->myPets){
		// 	$this->getPetsByUser($id);
		// }else if($action == $this->petShow){
		// 	$this->getPetByID($id);
		// }else if($action == $this->login){
		// 	$this->doLogin_post();
		// }

	}

	public function responseJson($data=null)
	{
		if($data!==null){
			///$_json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			$_json = json_encode($data);
			$this->response($_json, 201);
		}
	}

	public function getAllPets_get()
	{
		$result = $this->petsModel->getAll();
		foreach ($result as $pet) {
			$data[] = [
				'id' => $pet->id,
				'name' => $pet->name,
				'ownerID' => $pet->ownerID,
				'age' => $pet->age,
				'weight' => $pet->weight,
				'postage' => $pet->postage,
				'breed' => $pet->breed,
				'gender' => $pet->gender,
				'description' => $pet->description
			];
		}
		$this->responseJson($data);

	}

	public function getPetsByUser_get($id)
	{
		$result = $this->petsModel->getPetByUser($id);
		foreach ($result as $pet) {
			$data[] = [
				'id' => $pet->id,
				'name' => $pet->name,
				'ownerID' => $pet->ownerID,
				'age' => $pet->age,
				'weight' => $pet->weight,
				'postage' => $pet->postage,
				'breed' => $pet->breed,
				'gender' => $pet->gender,
				'description' => $pet->description
			];
		}
		$this->responseJson($data);

	}
	public function getPetsByID_get($id)
	{
		$pet = $this->petsModel->getPetByID($id);
			$data[] = [
				'id' => $pet->id,
				'name' => $pet->name,
				'ownerID' => $pet->ownerID,
				'age' => $pet->age,
				'weight' => $pet->weight,
				'postage' => $pet->postage,
				'breed' => $pet->breed,
				'gender' => $pet->gender,
				'description' => $pet->description
			];
			$this->responseJson($data);
	}

	public function doLogin_post()
	{
		$this->load->model('userModel');


		$ver = $this->post('email');
		if( $ver == null){
			redirect(base_url('404'));
		}

		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		$pass = $data->pass;

		if( $email == null){
			redirect(base_url('404'));
		}

		$user = $this->userModel->getByEmailAndPassword($email, $pass);

		$this->responseJson($user);


	}

}
