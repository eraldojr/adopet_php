<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*//_____________________
|
|
|------------------------
| PETS REST CONTROLLER
|------------------------
|
|
*///_____________________


require (APPPATH.'libraries/REST_Controller.php');

class PetsRestful extends REST_Controller
{

	public function __construct()
	{
		parent::__construct('restful');
		$this->load->helper('url');
		$this->load->model('petsModel');
	}

	public function index_get($id=null)
	{

		$action = $this->uri->segment(1);

	}

	public function responseJson($data=null)
	{
		if($data!==null){
			$_json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			$this->response($_json, 201);
		}
	}

	public function verifyUser()
	{
		$this->load->model('userModel');
		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
		$email = $data->email;
		$pass = $data->pass;
		if( $email == null){
			redirect(base_url('404'));
		}
		return $this->userModel->getByEmailAndPassword($email, $pass);
	}

	public function getPetData($user)
	{
		$data = $this->input->raw_input_stream;
		$data = json_decode($data);
			$pet = [
				'ownerID' => $user->id,
				'name' => $data->name,
				'age' => $data->age,
				'weight' => $data->weight,
				'gender' => $data->gender,
				'breed' => $data->breed,
				'postage' => $data->postage,
				'description' => $data->description,
				'date' => date(DATE_ATOM)
			];
		return $pet;
	}

	public function createPet_post()
	{
		$user = $this->verifyUser();
		if($user !== null){
			$data = $this->getPetData($user);
			$this->petsModel->create($data);
			$return = true;
		}else{
			$return = false;
		}

		$this->responseJson($return);

	}

	public function deletePet_post($id)
	{

		if($this->verifyUser())
		{
			if($this->petsModel->delete($id)){
				$return = true;
			}else{
				$return = false;
			}
		}else{
			$return = false;
		}

		$this->responseJson($return);
	}

	public function updatePet_post($id)
	{
		if($this->verifyUser())
		{
			$data = $this->getPetData();
			if($this->petsModel->update($id, $data)){
				$return = true;
			}else{
				$return = false;
			}
		}else{
			$return = false;
		}
		$this->responseJson($return);



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
		$data = false;
		$result = $this->petsModel->getByUser($id);
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

}
