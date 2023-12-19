<?php
require_once __DIR__ . "\\..\\vendor\\autoload.php";
use Core\Entity\FemalePlayer;
use Core\Entity\Tournament;
use Core\Actions\CreateTournament;
use Core\Actions\TournamentNextStage;
use Data\Repository\FemalePlayerRepository;
use Data\Repository\TennisMatchRepository;
use Data\Repository\TournamentRepository;

$playerRepository = new FemalePlayerRepository();
$tournamentRepository = new TournamentRepository();
$tennisMatchRepository = new TennisMatchRepository();

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

$tournament = new Tournament();
$tournament->setName('Torneo de prueba');
$tournament->setPlayers($tournamentPlayers);
$tournament->setSex(1);

$createTournament = new CreateTournament($tournamentRepository,$tennisMatchRepository,$playerRepository);
$tournament = $tournamentRepository->getById($createTournament->action($tournament));

var_dump($tournament);

$tournamentNextStage = new TournamentNextStage($tennisMatchRepository,$playerRepository);

var_dump($tournamentNextStage->action($tournament));
var_dump($tournamentNextStage->action($tournament));


?>