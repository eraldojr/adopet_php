<?php

class UserModel extends CI_Model
{

  protected $tableName = 'user';

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }
  public function getByEmail($email = null)
  {
    if($email == null){
      $email = $this->input->post('email');
    }
    $query = $this->db->get_where($this->tableName, array('email' => $email));
    return $query->first_row();
  }

  public function getByID($id){
    $query = $this->db->get_where($this->tableName, ['id'=>$id]);
    return $query->first_row();
  }

  public function getByEmailAndPassword($email = null, $pass = null)
  {

      if($email == null){
        $user = $this->getByEmail();

        if(!$user){
          return false;
        }
        $pass = $this->input->post('pass');
      }else{
          $user = $this->getByEmail($email);
      }
      $hash = $user->pass;
      if (!password_verify($pass, $hash)) {
          return false;
      }

      return $user;
  }

  public function create($data = null)
  {
    if($data==null){
      $data = [
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone'),
        'level' => 3,
        'pass' => password_hash($this->input->post('pass'), PASSWORD_BCRYPT),
      ];
      $this->upload();
    }
    return $this->db->insert($this->tableName, $data);

  }

  public function upload()
  {
        if(isset($this->session->user)){
          $email = $this->session->user->email;
        }else{
          $email = $this->input->post('email');
        }

        if(!file_exists(DATAPATH . "users/" . $email)){
          mkdir(DATAPATH . "users/" . $email, 0700);
        }
        $path = DATAPATH . 'users/' . $email;
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size']  = 'none';
        $config['max_width'] = 'none';
        $config['max_height']= 'none';

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')){
          //Tratar erro no carregamento da imagem
        }
  }

  public function update($id)
  {

      $change = $this->input->post('changePass');

      $data = [
          'name' => $this->input->post('name'),
          'email' => $this->input->post('email'),
          'phone' => $this->input->post('phone'),
      ];
      if($change === "true"){
        $data['pass'] = password_hash($this->input->post('pass'), PASSWORD_BCRYPT);
      }
      $this->db->where('id', $id);
      return $this->db->update($this->tableName, $data);
  }

  public function changePhoto(){
    $this->load->helper('url');
    if(isset($this->session->user)){
      $email = $this->session->user->email;
    }
    $directory = DATAPATH . "users/" . $email;

    if(!file_exists($directory)){
      mkdir($directory, 0700);
    }else{
      $data = scandir($directory);
      if(isset($data[2])){
          unlink($directory .  '/' . $data[2]);
      }
    }
    $this->upload();
  }
}
