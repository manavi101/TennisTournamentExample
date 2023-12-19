<?php
  namespace Core\Actions;

  use Core\Entity\TennisMatch;
  use Core\Repository\PlayerRepositoryInterface;

  /**
   * SolveTennisMatch
   * Accion definida para resolver los partidos de tennis
  */
  Class SolveTennisMatch{

    private $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepositoryInterface){
      $this->playerRepository = $playerRepositoryInterface;
    }
    
    /**
     * Method action
     * Resuelve el partido de tennis
     * @param TennisMatch $tennisMatch Partido a disputar
     *
     * @return TennisMatch TennisMatch con winner resuelto
     */
    public function action(TennisMatch $tennisMatch):TennisMatch{

      $player1 = $this->playerRepository->getById($tennisMatch->getPlayer1()->getId());
      $player2 = $this->playerRepository->getById($tennisMatch->getPlayer2()->getId());

      //El efecto random de suerte es el valor entre 0 y 1 * estadistica fisica, la sumatoria del nivel y los atributos
      // son los puntos para definir el ganador
      if($player1->getPoints()>=$player2->getPoints())
        $tennisMatch->setWinner($tennisMatch->getPlayer1());
      else
        $tennisMatch->setWinner($tennisMatch->getPlayer2());
      return $tennisMatch;
    }
  }
?>