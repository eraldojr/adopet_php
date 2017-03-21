<?php

class DB{

  private $server = "localhost";
  private $user = "jrfx";
  private $pass = "";
  private $dbname = "adopet";
  private $db_Conn;


  public function __construct(){
    @$this->db_Conn = new mysqli($this->server,$this->user,$this->pass,$this->dbname);
    if(mysqli_connect_errno()){
      echo "Failed to connect to MySQL (".$this->db_Conn->connect_errno.")".$this->db_Conn->connect_error;
    }
  }
  public function getConn(){
    return $this->db_Conn;
  }

}
