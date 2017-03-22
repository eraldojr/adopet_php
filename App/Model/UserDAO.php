<?php
namespace Model;
class UserDAO{

  private $db;
  private $conn;
  private $table = "user";
  public function __construct()
  {
    $this->db = new DB();
    $this->conn = $this->db->getConn();
  }

  public function login($email, $passLogin){
    $stmt = $this->conn->stmt_init();
    $query = "SELECT * FROM {$this->table} WHERE email=?";
    $stmt->prepare($query);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($id,$name,$email,$pass,$phone);
    $stmt->fetch();
    if (password_verify($passLogin,$pass)) {
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
  $stmt->prepare($query);
  $name = $user->getName();
  $email = $user->getEmail();
  $pass = $user->getPass();
  $phone = $user->getPhone();
  $pass = $this->hashPass($user->getPass());
  $stmt->bind_param("ssss",$name,$email,$pass,$phone);
  $stmt->execute();
  return $stmt->insert_id;
}
private function hashPass($pass){
  $timeTarget = 0.05;
  $cost = 8;
  do {
      $cost++;
      $start = microtime(true);
      password_hash($pass, PASSWORD_BCRYPT, ["cost" => $cost]);
      $end = microtime(true);
  } while (($end - $start) < $timeTarget);
  $options = [
    'cost' => $cost,
  ];
  $pass = password_hash($pass, PASSWORD_BCRYPT, $options);
  return $pass;
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
?>
