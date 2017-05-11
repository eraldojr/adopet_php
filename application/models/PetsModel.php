<?php

class PetsModel extends CI_Model
{
  protected $tableName = 'pets';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function create(){
    $data = [
        'name' => $this->input->post('name'),
        'ownerID' => $this->session->user->id,
        'age' => $this->input->post('age'),
        'weight' => $this->input->post('weight'),
        'breed' => $this->input->post('breed'),
        'date' => date(DATE_ATOM),
        'postage' => $this->input->post('postage'),
        'description' => $this->input->post('description')
    ];
    return $this->db->insert($this->tableName, $data);
  }

  public function update($id){
    $data = [
        'name' => $this->input->post('name'),
        'ownerID' => $this->session->user->id,
        'age' => $this->input->post('age'),
        'weight' => $this->input->post('weight'),
        'breed' => $this->input->post('breed'),
        'date' => date(DATE_ATOM),
        'postage' => $this->input->post('postage'),
        'description' => $this->input->post('description')
    ];
    $this->db->where('id', $id);
    return $this->db->update($this->tableName, $data);
  }

  public function delete($id){
    return $this->db->delete($this->tableName, ['id' => $id]);
  }

  public function getAll(){
    $query = $this->db->get($this->tableName);
    return $query->result();
  }

  public function getByUser(){
    $ownerID = $this->session->user->id;
    $query = $this->db->get_where($this->tableName, ['ownerID'=>$ownerID]);
    return $query->result();
  }

  public function getByID($id){
    $query = $this->db->get_where($this->tableName, ['id'=>$id]);
    return $query->first_row();
  }

}
