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
        'breed' => $this->input->post('breed'),
        'date' => date(DATE_ATOM),
        'postage' => $this->input->post('postage'),
        'description' => $this->input->post('description')
    ];
    $this->db->where('id', $id);
    return $this->db->update($this->tableName, $data);
  }

  public function delete($id){
    $path= FCPATH . 'uploads/pets/' . $id;
    if(file_exists(__DIR__ . "/../../public/uploads/pets/" . $id)){
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
    $config['upload_path']          = __DIR__ . '/../../public/uploads/pets/' . $id;
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
    $this->upload->do_upload('photo');
  }

  public function upload($id)
  {

    if(!file_exists(__DIR__ . "/../../public/uploads/pets/" . $id)){
      mkdir(__DIR__ . "/../../public/uploads/pets/" . $id, 0700);
    }

    $config['upload_path']          = __DIR__ . '/../../public/uploads/pets/' . $id;
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
