<?php
use Core\Entity\TennisMatch;
use Core\Entity\Tournament;
use Core\Entity\Player;
use PHPUnit\Framework\TestCase;
final class TennisMatchTest  extends TestCase{
  /** @test */
  public function ExpectedInputsTest(): void
  {
      $tennisMatch = new TennisMatch();
      $tennisMatch->setTournament(new Tournament);
      $this->assertEquals(new Tournament, $tennisMatch->getTournament());
      $tennisMatch->setPlayer1(new Player);
      $this->assertEquals(new Player, $tennisMatch->getPlayer1());
      $tennisMatch->setPlayer2(new Player);
      $this->assertEquals(new Player, $tennisMatch->getPlayer2());
      $tennisMatch->setLevel(1);
      $this->assertEquals(1, $tennisMatch->getLevel());
      $tennisMatch->setWinner(new Player);
      $this->assertEquals(new Player, $tennisMatch->getWinner());
  }
}
?>