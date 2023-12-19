<?php
namespace Core\Actions;

use DB\DatabaseFactory;
use Core\Entity\Tournament;
use Core\Entity\TennisMatch;
use Core\Repository\PlayerRepositoryInterface;
use Core\Repository\TennisMatchRepositoryInterface;
use Core\Repository\TournamentRepositoryInterface;

/**
 * CreateTournament
 * Accion definida para crear el torneo.
 */
class CreateTournament{
    

  private TournamentRepositoryInterface $tournamentRepository;  

  private TennisMatchRepositoryInterface $tennisMatchRepository;  

  private PlayerRepositoryInterface $playerRepository;
  
  public function __construct(TournamentRepositoryInterface $tournamentRepositoryInterface,TennisMatchRepositoryInterface $tennisMatchRepositoryInterface, PlayerRepositoryInterface $playerRepositoryInterface){    
    $this->tournamentRepository = $tournamentRepositoryInterface;    
    $this->tennisMatchRepository = $tennisMatchRepositoryInterface;
    $this->playerRepository = $playerRepositoryInterface;
  }
  
  /**
   * Method action
   * Crea el torneo y todos los matches relacionados
   * Dentro de tournament es necesario definir los id de los players y el sexo
   * @param  Tournament $tournament
   * @return int
   */
  public function action(Tournament $tournament):int{
    $players = $tournament->getPlayers();
    if(!(floor(log(count($players),2)) == log(count($players),2)))
      throw new \Exception ("The players quantity has to be base of 2 ");

    DatabaseFactory::beginTransaction();

    try{
      $id = $this->tournamentRepository->create($tournament);
      $tournament = $this->tournamentRepository->getById($id);
      for($i=0;$i<count($players)/2;$i++){
        //creo el match entre el primero y el ultimo player sucesivamente
        $match = new TennisMatch();
        $match->setTournament($tournament);
        $match->setPlayer1($this->playerRepository->getById($players[$i]));
        $match->setPlayer2($this->playerRepository->getById($players[count($players)-$i-1]));
        $match->setLevel(1);
        $this->tennisMatchRepository->create($match);
      }

      DatabaseFactory::commit();

    }catch(\Exception $e){
      //Si hay un error en la creacion la transaccion se cae
      DatabaseFactory::rollback();
      throw $e;
    }
    
    return $id;
  }

}
?>