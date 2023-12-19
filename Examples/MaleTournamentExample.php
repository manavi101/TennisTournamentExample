<?php
require_once __DIR__ . "\\..\\vendor\\autoload.php";
use Core\Entity\MalePlayer;
use Core\Entity\Tournament;
use Core\Actions\CreateTournament;
use Core\Actions\TournamentNextStage;
use Data\Repository\MalePlayerRepository;
use Data\Repository\TennisMatchRepository;
use Data\Repository\TournamentRepository;

$playerRepository = new MalePlayerRepository();
$tournamentRepository = new TournamentRepository();
$tennisMatchRepository = new TennisMatchRepository();

$tournamentPlayers = Array();
$player = new MalePlayer();
$player->setName('Juan');
$player->setLevel(40);
$player->setSex(2);
$player->setStrength(40);
$player->setSpeed(42);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Jose');
$player->setLevel(40);
$player->setSex(1);
$player->setStrength(39);
$player->setSpeed(52);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Carlos');
$player->setLevel(50);
$player->setSex(1);
$player->setStrength(50);
$player->setSpeed(45);
array_push($tournamentPlayers,$playerRepository->create($player));
$player->setName('Reynaldo');
$player->setLevel(37);
$player->setSex(1);
$player->setStrength(52);
$player->setSpeed(65);
array_push($tournamentPlayers,$playerRepository->create($player));

$tournament = new Tournament();
$tournament->setName('Torneo de prueba');
$tournament->setPlayers($tournamentPlayers);
$tournament->setSex(1);

$createTournament = new CreateTournament($tournamentRepository,$tennisMatchRepository,$playerRepository);
$tournament = $tournamentRepository->getById($createTournament->action($tournament));

echo $tournament->getName()."\n";

$tournamentNextStage = new TournamentNextStage($tennisMatchRepository,$playerRepository);

$tournamentNextStage->action($tournament);
$match = $tournamentNextStage->action($tournament);
echo "El ganador es: ".$match[0]->getWinner()->getName()."\n";

?>