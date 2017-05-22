<?php

class MainController extends CI_Controller
{

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper('url');
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
	public function getAllPets()
	{
		$data=null;
		$this->load->model('petsModel');
		$result = $this->petsModel->getAll();
    foreach ($result as $pet) {
      $directory = DATAPATH . 'pets/' . $pet->id;
      $data[$pet->id]['photos']= scandir($directory);
    }
    $this->load->view('header');
    $this->load->view('main/adopt', ['pets' => $result, 'data'=>$data]);
    $this->load->view('footer');
	}
	public function getPetByID($id)
	{
		//Pet
		$this->load->model('petsModel');
		$pet = $this->petsModel->getByID($id);
    $directory = DATAPATH . 'pets/' . $id;
    $data[$pet->id]['photos'] = scandir($directory);
		//Owner
		$this->load->model('userModel');
		$result = $this->userModel->getByID($pet->ownerID);
		$owner =[
			'name' => $result->name,
			'email' => $result->email,
			'phone' => $result->phone
		];
    $this->load->view('header');
    $this->load->view('pets/show-pet', ['pet' => $pet, 'owner' => $owner, 'data'=>$data]);
    $this->load->view('footer');
	}
}
