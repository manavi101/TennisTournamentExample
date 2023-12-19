<?php
use Core\Entity\Tournament;
use PHPUnit\Framework\TestCase;
  final class TournamentTest  extends TestCase{
    /** @test */
    public function ExpectedInputsTest(): void
    {
        $tournament = new Tournament();
        $tournament->setName('Torneo');
        $this->assertEquals('Torneo', $tournament->getName());
        $tournament->setPlayers([1,2]);
        $this->assertEquals([1,2], $tournament->getPlayers());
        $tournament->setSex(2);
        $this->assertEquals(2, $tournament->getSex());
    }
  }
?>