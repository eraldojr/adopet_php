<?php
namespace App\Model;
class User
{
  private $name;
  private $email;
  private $pass;
  private $phone;

  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
    return $this;
  }
  public function getEmail(){
    return $this->email;
  }
  public function setEmail($email){
    $this->email = $email;
    return $this;
  }
  public function getPass(){
    return $this->pass;
  }
  public function setPass($pass){
    $this->pass = $pass;
    return $this;
  }
  public function getPhone(){
    return $this->phone;
  }
  public function setPhone($phone){
    $this->phone = $phone;
    return $this;
  }

}
 ?>
