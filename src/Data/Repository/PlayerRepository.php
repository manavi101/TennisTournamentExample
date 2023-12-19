<?php
namespace Data\Repository;
use Core\Entity\FemalePlayer;
use Core\Entity\MalePlayer;
use Core\Entity\Player;
use Core\Repository\PlayerRepositoryInterface;

class PlayerRepository extends AbstractRepository implements PlayerRepositoryInterface{

  public function getById($id): Player{
    $query = $this->db->prepare("SELECT id,name,level,sex FROM player WHERE id=?");
    $query->execute([$id]);
    $player = $query->fetchObject('Core\Entity\Player');
    return $player;
  }
  
  public function create($player) : int{
    $query = $this->db->prepare("INSERT INTO PLAYER (name,level,sex) VALUES(?,?,?)");
    $query->execute([$player->getName(),$player->getLevel(),$player->getSex()]);
    return $this->db->lastInsertId();
  }

  public function delete($id) : void{
    $query = $this->db->prepare("DELETE FROM PLAYER WHERE id=?");
    $query->execute([$id]);
  }

}

class FemalePlayerRepository extends PlayerRepository implements PlayerRepositoryInterface {

  public function getById($id): FemalePlayer{
    $query = $this->db->prepare("SELECT id,name,level,sex,reactiontime FROM player WHERE id=?");
    $query->execute([$id]);
    return $query->fetchObject('Core\Entity\FemalePlayer');
  }

  public function create($femalePlayer) : int{
    $query = $this->db->prepare("INSERT INTO PLAYER (name,level,sex,reactiontime) VALUES(?,?,?,?)");
    $query->execute([$femalePlayer->getName(),$femalePlayer->getLevel(),$femalePlayer->getSex(),$femalePlayer->getReactionTime()]);
    return $this->db->lastInsertId();
  }

}

class MalePlayerRepository extends PlayerRepository implements PlayerRepositoryInterface {

  public function getById($id): MalePlayer{
    $query = $this->db->prepare("SELECT id,name,level,sex,strength,speed FROM player WHERE id=?");
    $query->execute([$id]);
    return $query->fetchObject('Core\Entity\MalePlayer');
  }

  public function create($malePlayer) : int{
    $query = $this->db->prepare("INSERT INTO PLAYER (name,level,sex,strength,speed) VALUES(?,?,?,?,?)");
    $query->execute([$malePlayer->getName(),$malePlayer->getLevel(),$malePlayer->getSex(),$malePlayer->getStrength(),$malePlayer->getSpeed()]);
    return $this->db->lastInsertId();
  }  

}
?>