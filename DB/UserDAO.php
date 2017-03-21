<?php

require_once "DB.php";

class UserDAO{

  private $db;
  private $conn;
  private $table = "user";
  public function __construct()
  {
    $this->db = new DB();
    $this->conn = $this->db->getConn();
  }

  public function login($email, $pass){
    $stmt = $this->conn->stmt_init();
    $query = "SELECT * FROM {$this->table} WHERE email=?";
    $stmt->prepare($query);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($id,$name,$email,$passHash,$phone);
    $stmt->fetch();
    if(password_verify($pass,$passHash)){
      $user= new User();
      $user->setName($name)->setEmail($email)->setPass($email)->setPhone($phone);
      return $user;
    }else{
      return null;
    }
  }

  public function insert($user){
  $stmt = $this->conn->stmt_init();
  $query = "INSERT INTO {$this->table} (name, email, pass, phone) VALUES (?,?,?,?)";
  //$stmt->prepare("INSERT INTO user (name, email) VALUES (?,?)");
  $stmt->prepare($query);
  $name = $user->getName();
  $email = $user->getEmail();
  $pass = $user->getPass();
  $phone = $user->getPhone();
  $stmt->bind_param("ssss",$name,$email,$pass,$phone);
  $stmt->execute();
  return $stmt->insert_id;
}
  public function find($id){
    $query = "SELECT * FROM {$this->table} WHERE id=?";
    $stmt = $this->conn->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email);
    $stmt->fetch();
    return $arrayName = array('id' => $id, 'name'=>$name, 'email'=>$email);

  }

}
