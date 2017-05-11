<?php

class PetsController extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->model('petsModel');
      $this->load->helper('url');
  }

  public function getByID($id)
  {
    $this->petsModel->getByID($id);
  }

  public function getByUser()
  {
    $result = $this->petsModel->getByUser();
    $this->load->view('header');
    $this->load->view('pets/my-pets', ['pets' => $result]);
    $this->load->view('footer');

  }

  public function getAll()
  {
    $this->petsModel->getAll();
  }

  public function create()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('age', 'Idade');
    $this->form_validation->set_rules('weight', 'Peso');
    $this->form_validation->set_rules('breed', 'Raca', 'required');
    $this->form_validation->set_rules('date', 'data');
    $this->form_validation->set_rules('postage', 'Porte', 'required');
    $this->form_validation->set_rules('description', 'Descricao');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('header');
      $this->load->view('pets/create-pet');
      $this->load->view('footer');
    } else {
      $this->petsModel->create();
      redirect('/meus-pets');
      die();
    }

  }

  public function delete($id)
  {
    $this->petsModel->delete($id);
    redirect(base_url("/meus-pets"));
  }

  public function update($id = null)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Nome', 'required');
    $this->form_validation->set_rules('age', 'Idade');
    $this->form_validation->set_rules('weight', 'Peso');
    $this->form_validation->set_rules('breed', 'Raca', 'required');
    $this->form_validation->set_rules('date', 'data');
    $this->form_validation->set_rules('postage', 'Porte', 'required');
    $this->form_validation->set_rules('description', 'Descricao');

    if ($this->form_validation->run() === FALSE) {
      $result = $this->petsModel->getByID($id);
      $this->load->view('header');
      $this->load->view('pets/edit', ['pet' => $result]);
      $this->load->view('footer');
    } else {
      $this->petsModel->update($id);
      redirect(base_url('/meus-pets'));
      die();
    }
  }
}
