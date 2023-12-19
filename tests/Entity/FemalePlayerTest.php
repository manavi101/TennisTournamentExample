<?php
  use Core\Entity\FemalePlayer;
  use PHPUnit\Framework\TestCase;

final class FemalePlayerTest extends TestCase{
  /** @test */
  public function ExpectedInputsTest(): void
  {
      $player = new FemalePlayer(1);
      $this->assertEquals(1, $player->getId());
      $player->setName('Juana');
      $this->assertEquals('Juana', $player->getName());
      $player->setLevel(5);
      $this->assertEquals(5, $player->getLevel());
      $player->setSex(1);
      $this->assertEquals(2, $player->getSex());
      $player->setReactionTime(100);
      $this->assertEquals(100, $player->getReactionTime());
  }
  /** @test */
  public function ExceptionWrongLevel(): void
  {
      $this->expectException(\Exception::class);
      $player = new FemalePlayer();
      $player->setLevel(101);
      $player->setLevel(0);
  }
  /** @test */
  public function ExceptionWrongReactionTime(): void
  {
      $this->expectException(\Exception::class);
      $player = new FemalePlayer();
      $player->setReactionTime(101);
      $player->setReactionTime(0);
  }
  /** @test */
  public function ExceptionWrongSex(): void
  {
      $this->expectException(\Exception::class);
      $player = new FemalePlayer();
      $player->setSex(3);
      $player->setSex(0);
  }
}
?>