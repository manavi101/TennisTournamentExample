<?php
require_once __DIR__ . "\\..\\vendor\\autoload.php";
use Core\Entity\FemalePlayer;
use Core\Entity\Tournament;
use Core\Actions\CreateTournament;
use Core\Actions\TournamentNextStage;
use Data\Repository\FemalePlayerRepository;
use Data\Repository\TennisMatchRepository;
use Data\Repository\TournamentRepository;

//Seteo repositorios
$playerRepository = new FemalePlayerRepository();
$tournamentRepository = new TournamentRepository();
$tennisMatchRepository = new TennisMatchRepository();

//Creo los jugadores y pusheo los ids que retorna el create para realizar el torneo
//Utilizo jugadores parecidos para generar diferentes ganadores en base a la suerte
//Los de mayores stats siempre tienen mas prob
$tournamentPlayers = Array();

$player = new FemalePlayer();
$player->setName('Juliana');
$player->setLevel(30);
$player->setSex(1);
$player->setReactionTime(30);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Sofia');
$player->setLevel(40);
$player->setSex(1);
$player->setReactionTime(32);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Martina');
$player->setLevel(50);
$player->setSex(1);
$player->setReactionTime(33);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Tais');
$player->setLevel(37);
$player->setSex(1);
$player->setReactionTime(60);
array_push($tournamentPlayers,$playerRepository->create($player));

//creo la entidad de torneo pero para crear el torneo uso la accion asi genero todos los partidos
$tournament = new Tournament();
$tournament->setName('Torneo de prueba');
$tournament->setPlayers($tournamentPlayers);
$tournament->setSex(1);

$createTournament = new CreateTournament($tournamentRepository,$tennisMatchRepository,$playerRepository);
$tournament = $tournamentRepository->getById($createTournament->action($tournament));

echo $tournament->getName()."\n";

//ahora avanzo el torneo hasta que haya un ganador
//al ser cuatro players serian dos fechas y tres partidos
$tournamentNextStage = new TournamentNextStage($tennisMatchRepository,$playerRepository);

$tournamentNextStage->action($tournament);
$match = $tournamentNextStage->action($tournament);

echo "El ganador es: ".$match[0]->getWinner()->getName()."\n";


?>