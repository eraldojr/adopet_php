<?php

require (APPPATH.'libraries/REST_Controller.php');

class RestController extends REST_Controller
{

	public function getAllPets_get()
	{
		$data = ['msg'=>'OMG. IT WORKS!'];
		$json = json_encode($data);
		$this->response("OK", 201);
	}
	public function index_get()
	{
		$this->config->load('rest');
		$data = ['msg'=>'OMG. IT WORKS!'];
		$json = json_encode($data);
		$this->response($json, 200);
	}


	public function getPetByID($id)
	{
		//Pet
		$this->load->model('petsModel');
		$pet = $this->petsModel->getByID($id);
    $directory = FCPATH . 'uploads/pets/' . $id;
    $data[$pet->id]= scandir($directory);
		//Owner
		$this->load->model('userModel');
		$result = $this->userModel->getByID($pet->ownerID);
		$owner =[
			'name' => $result->name,
			'email' => $result->email,
			'phone' => $result->phone
		];
    $this->load->view('header');
    $this->load->view('main/show', ['pet' => $pet, 'owner' => $owner, 'data'=>$data]);
    $this->load->view('footer');
	}
}
