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
        'postage' => $this->input->post('postage'),
        'breed' => $this->input->post('breed'),
        'gender' => $this->input->post('gender'),
        'description' => $this->input->post('description'),
        'date' => date(DATE_ATOM)
    ];
    $this->db->insert($this->tableName, $data);
    $id = $this->db->insert_id();
    $this->upload($id);
  }

  public function update($id){
    $data = [
        'name' => $this->input->post('name'),
        'ownerID' => $this->session->user->id,
        'age' => $this->input->post('age'),
        'weight' => $this->input->post('weight'),
        'postage' => $this->input->post('postage'),
        'breed' => $this->input->post('breed'),
        'gender' => $this->input->post('gender'),
        'description' => $this->input->post('description')
    ];
    $this->db->where('id', $id);
    return $this->db->update($this->tableName, $data);
  }

  public function delete($id){
    $path = DATAPATH . 'pets/' . $id;
    if(file_exists($path)){
    $data = scandir($path);
    for ($i=2; $i < 5; $i++){
       if(isset($data[$i]))
        unlink($path . '/' . $data[$i]);
      }
    }
    rmdir($path);
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

  public function uploadPhoto($id)
  {
    $config['upload_path']          = DATAPATH . 'pets/' . $id;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name'] = TRUE;
    $config['max_size']  = 'none';
    $config['max_width'] = 1024;
    $config['max_height']= 768;

    if(isset($this->upload)){
      $this->upload->initialize($config);
    }else{
      $this->load->library('upload', $config);
    }
    if(!$this->upload->do_upload('photo')){
      echo "Erro ao carregar foto";
    }
  }

  public function upload($id)
  {

    $path = DATAPATH . "pets/" . $id;
    if(!file_exists($path)){
      mkdir($path, 0700);
    }

    $config['upload_path']          = $path;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['encrypt_name'] = TRUE;
    $config['max_size']  = 'none';
    $config['max_width'] = 1024;
    $config['max_height']= 768;

    $this->load->library('upload', $config);


    $this->upload->do_upload('photo1');
    $this->upload->initialize($config);
    $this->upload->do_upload('photo2');
    $this->upload->initialize($config);
    $this->upload->do_upload('photo3');
  }


}
