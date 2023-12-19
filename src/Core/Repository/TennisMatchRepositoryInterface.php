<?php
namespace Core\Repository;

use Core\Entity\TennisMatch;

interface TennisMatchRepositoryInterface extends AbstractRepositoryInterface{
  public function getAllFromTournamentId(int $id,bool $lastlevel=true);
  public function updateWinner(TennisMatch $tennisMatch);
}
?>