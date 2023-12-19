<?php
namespace Data\Repository;
use DB\DatabaseFactory;

abstract class AbstractRepository{
  protected $db;

  public function __construct(){
    $this->db = DatabaseFactory::Build();
  }
  
}


?>