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
        'pass' => password_hash($this->input->post('pass'), PASSWORD_BCRYPT),
        'photo' => $this->upload()
    ];

    return $this->db->insert($this->tableName, $data);
  }

  public function upload()
  {
        if(isset($this->session->user)){
          $email = $this->session->user->email;
        }else{
          $email = $this->input->post('email');
        }

        if(!file_exists(__DIR__ . "/../../public/uploads/users/" . $email)){
          mkdir(__DIR__ . "/../../public/uploads/users/" . $email, 0700);
        }
        $path = __DIR__ . '/../../public/uploads/users/' . $email;
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size']  = 'none';
        $config['max_width'] = 'none';
        $config['max_height']= 'none';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo'))
        {
          $data =  array('upload_data' => $this->upload->data());
          $file_name =  $data['upload_data']['file_name'];

          return $file_name;
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

    $email = $this->session->user->email;
    if(isset($this->session->user->photo)){
      $photo = $this->session->user->photo;
      unlink(FCPATH .  'uploads/users/' . $email . '/' . $photo);
    }

    $id = $this->session->user->id;
    $data = [
      'photo' => $this->upload()
    ];
    $this->db->where('id', $id);
    return $this->db->update($this->tableName, $data);

  }
}
