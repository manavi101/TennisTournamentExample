<?php
namespace Data\Repository;
use Core\Entity\TennisMatch;
use Core\Repository\TennisMatchRepositoryInterface;

class TennisMatchRepository extends AbstractRepository implements TennisMatchRepositoryInterface{
    
  /**
   * Method getById
   * Al no utilizar ORM realizo el rellenado del objeto de manera manual
   * @param $id $id Id del match
   *
   * @return TennisMatch
   */
  public function getById($id): TennisMatch{
    $query = $this->db->prepare("SELECT * FROM matches WHERE id=?");
    $query->execute([$id]);
    $data = $query->fetch(\PDO::FETCH_OBJ);
    
    $tennisMatch = new TennisMatch($data->id);
    $tennisMatch->setLevel($data->level);

    $query = $this->db->prepare("SELECT * FROM player WHERE id=?");
    $query->execute([$data->player1]);
    $tennisMatch->setPlayer1($query->fetchObject('Core\Entity\Player'));

    $query = $this->db->prepare("SELECT * FROM player WHERE id=?");
    $query->execute([$data->player2]);
    $tennisMatch->setPlayer2($query->fetchObject('Core\Entity\Player'));

    $query = $this->db->prepare("SELECT * FROM player WHERE id=?");
    $query->execute([$data->winner]);
    if($query->rowCount()==1)
      $tennisMatch->setWinner($query->fetchObject('Core\Entity\Player'));

    $query = $this->db->prepare("SELECT * FROM tournament WHERE id=?");
    $query->execute([$data->tournament_id]);
    $tennisMatch->setTournament($query->fetchObject('Core\Entity\Tournament'));

    return $tennisMatch;
  }

  public function create($tennisMatch): int{
    $query = $this->db->prepare("INSERT INTO matches (tournament_id,player1,player2,level) VALUES(?,?,?,?)");
    $test = $tennisMatch->getPlayer1()->getId();
    $query->execute([$tennisMatch->getTournament()->getId(),
                    $tennisMatch->getPlayer1()->getId(),
                    $tennisMatch->getPlayer2()->getId(),
                    $tennisMatch->getLevel()
                    ]);
    return $this->db->lastInsertId();
  }

  public function updateWinner($tennisMatch): void{
    $query = $this->db->prepare("Update matches set winner=? where id=?");
    $query->execute([$tennisMatch->getWinner()->getId(),
                    $tennisMatch->getId()
                    ]);
  }

  public function delete($id): void{
    $query = $this->db->prepare("DELETE FROM matches WHERE id=?");
    $query->execute([$id]);
  }

  public function getAllFromTournamentId($id,$lastlevel=true): array{
    $matches = array();
    $query = $this->db->prepare("SELECT id FROM matches WHERE tournament_id=? ".($lastlevel?"and level = ( SELECT MAX(level) FROM matches WHERE tournament_id=?)":""));
    $query->execute([$id,$id]);
    $rows = $query->fetchAll(\PDO::FETCH_OBJ);
    foreach($rows as $row){
      array_push($matches,$this->getById($row->id));
    }
    return $matches;
  }
}

?>