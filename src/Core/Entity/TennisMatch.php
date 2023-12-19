<?php
namespace Core\Entity;

/**
 * TennisMatch
 * Entidad del partido de tennis
 */
class TennisMatch extends AbstractEntity{
  protected Tournament $tournament;
  protected Player $player1;
  protected Player $player2;
  protected ?Player $winner = NULL;
  protected int $level;
  
  /**
   * Method getLevel
   * Retorna el Nivel del partido (etapa del torneo en la que se encuentra)
   * 1 es el mas bajo
   * @return int
   */
  public function getLevel() :int{
    return $this->level;
  }
  
  public function getTournament() :Tournament{
    return $this->tournament;
  }
  
  public function getPlayer1() :Player{
    return $this->player1;
  }
  
  public function getPlayer2() :Player{
    return $this->player2;
  }

  public function getWinner() :?Player{
    return $this->winner;
  }

  public function setTournament(Tournament $tournament){
    $this->tournament = $tournament;
  }

  public function setPlayer1(Player $player1){
    $this->player1 = $player1;
  }

  public function setPlayer2(Player $player2){
    $this->player2 = $player2;
  }

  public function setLevel(int $level){
    $this->level = $level;
  }

  public function setWinner(Player $winner){
    $this->winner = $winner;
  }
}
?>