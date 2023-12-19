<?php
  namespace Core\Actions;

  use Core\Repository\TennisMatchRepositoryInterface;
  use Core\Repository\PlayerRepositoryInterface;
  use DB\DatabaseFactory;
  use Core\Entity\Tournament;
  use Core\Entity\TennisMatch;
  use Core\Actions\SolveTennisMatch;
  
  /**
   * TournamentNextStage
   * Accion definida para resolver los partidos
   */
  class TournamentNextStage{

    private $tennisMatchRepository;
    private $playerRepository;

    public function __construct(TennisMatchRepositoryInterface $tennisMatchRepository,PlayerRepositoryInterface $playerRepositoryInterface){
      $this->tennisMatchRepository = $tennisMatchRepository;
      $this->playerRepository = $playerRepositoryInterface;
    }
    
    /**
     * Method action
     * Avanza toda una etapa del torneo, yendo partido a partido. 
     * Si queda uno define el ganador del torneo.
     * @param Tournament $tournament Torneo a avanzar
     *
     * @return array devuelve un Array con los matches disputados
     */
    public function action(Tournament $tournament):array{

      $solveTennisMatch = new SolveTennisMatch($this->playerRepository);
      $matches = $this->tennisMatchRepository->getAllFromTournamentId($tournament->getId(),true);
      if(count($matches)==1 && !is_null($matches[0]->getWinner()))
        throw new \Exception("The tournament already has a winner");
      try{
        DatabaseFactory::Build();
        DatabaseFactory::beginTransaction();
        foreach($matches as &$match){
          $match = $solveTennisMatch->action($match);
          $this->tennisMatchRepository->updateWinner($match);
          unset($match);
        }
        if(count($matches)>1){
          for($i=0;$i<count($matches)/2;$i++){
            $match = new TennisMatch();
            $match->setTournament($tournament);
            $match->setPlayer1($matches[$i]->getWinner());
            $match->setPlayer2($matches[count($matches)-$i-1]->getWinner());
            $match->setLevel($matches[$i]->getLevel()+1);
            $this->tennisMatchRepository->create($match);
          }
        }
        DatabaseFactory::commit();
        return $matches;
      }catch(\Exception $e){
        DatabaseFactory::rollback();
        throw $e;
      }
      
    }
  }
?>