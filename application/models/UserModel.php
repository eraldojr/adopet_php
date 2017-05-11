<?php

class UserModel extends CI_Model
{

  protected $tableName = 'user';

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }
  public function getByEmail()
  {
      $email = $this->input->post('email');
      $query = $this->db->get_where($this->tableName, array('email' => $email));
      return $query->first_row();
  }

  public function getByID($id){
    $query = $this->db->get_where($this->tableName, ['id'=>$id]);
    return $query->first_row();
  }

  public function getByEmailAndPassword()
  {
      $user = $this->getByEmail();
      if(!$user){
        return false;
      }

      $pass = $this->input->post('pass');
      $hash = $user->pass;

      if (!password_verify($pass, $hash)) {
          return false;
      }

      return $user;
  }

  public function new()
  {
      $data = [
          'name' => $this->input->post('name'),
          'email' => $this->input->post('email'),
          'phone' => $this->input->post('phone'),
          'level' => 3,
          'pass' => password_hash($this->input->post('pass'), PASSWORD_BCRYPT)
      ];

      return $this->db->insert($this->tableName, $data);
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
      var_dump($data);
      $this->db->where('id', $id);
      return $this->db->update($this->tableName, $data);
  }

}
