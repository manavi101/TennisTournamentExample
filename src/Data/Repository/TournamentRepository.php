<?php
  namespace Data\Repository;

  use Core\Entity\Tournament;
  use Core\Repository\TournamentRepositoryInterface;
  use Data\Repository\AbstractRepository;

  class TournamentRepository extends AbstractRepository implements TournamentRepositoryInterface{

    public function getById($id): Tournament{
      $query = $this->db->prepare("SELECT * FROM tournament WHERE id=?");
      $query->execute([$id]);
      return $query->fetchObject('Core\Entity\Tournament');
    }

    public function create($tournament) : int{
      $query = $this->db->prepare("INSERT INTO tournament (name,sex) VALUES(?,?)");
      $query->execute([$tournament->getName(),$tournament->getSex()]);
      return $this->db->lastInsertId();
    }

    public function delete(int $id) : void{
      $query = $this->db->prepare("DELETE FROM tournament WHERE id=?");
      $query->execute([$id]);
    }

  }
?>