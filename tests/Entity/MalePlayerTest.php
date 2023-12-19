<?php

  use Core\Entity\MalePlayer;
  use PHPUnit\Framework\TestCase;

  final class MalePlayerTest extends TestCase{

      /** @test */
    public function ExpectedInputsTest(): void
    {
        $player = new MalePlayer(1);
        $this->assertEquals(1, $player->getId());
        $player->setName('Juan');
        $this->assertEquals('Juan', $player->getName());
        $player->setLevel(5);
        $this->assertEquals(5, $player->getLevel());
        $player->setSex(2);
        $this->assertEquals(2, $player->getSex());
        $player->setSex(2);
        $this->assertEquals(2, $player->getSex());
        $player->setSpeed(100);
        $this->assertEquals(100, $player->getSpeed());
        $player->setStrength(100);
        $this->assertEquals(100, $player->getStrength());
    }

      /** @test */
    public function ExceptionWrongLevel(): void
    {
        $this->expectException(\Exception::class);
        $player = new MalePlayer();
        $player->setLevel(101);
        $player->setLevel(0);
    }

      /** @test */
    public function ExceptionWrongStrength(): void
    {
        $this->expectException(\Exception::class);
        $player = new MalePlayer();
        $player->setStrength(101);
        $player->setStrength(0);
    }

      /** @test */
    public function ExceptionWrongSpeed(): void
    {
        $this->expectException(\Exception::class);
        $player = new MalePlayer();
        $player->setSpeed(101);
        $player->setSpeed(0);
    }
    
    /** @test */
    public function ExceptionWrongSex(): void
    {
        $this->expectException(\Exception::class);
        $player = new MalePlayer();
        $player->setSex(3);
        $player->setSex(0);
    }
  }
?>