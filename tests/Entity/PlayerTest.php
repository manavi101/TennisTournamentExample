<?php

    use Core\Entity\Player;
    use PHPUnit\Framework\TestCase;

    final class PlayerTest extends TestCase{
        /** @test */
        public function ExpectedInputsTest(): void
        {
            $player = new Player(1);
            $this->assertEquals(1, $player->getId());
            $player->setName('Juan');
            $this->assertEquals('Juan', $player->getName());
            $player->setLevel(5);
            $this->assertEquals(5, $player->getLevel());
            $player->setSex(2);
            $this->assertEquals(2, $player->getSex());
        }
        /** @test */
        public function ExceptionWrongLevel(): void
        {
            $this->expectException(\Exception::class);
            $player = new Player();
            $player->setLevel(101);
            $player->setLevel(0);
        }
        /** @test */
        public function ExceptionWrongSex(): void
        {
            $this->expectException(\Exception::class);
            $player = new Player();
            $player->setSex(3);
            $player->setSex(0);
        }

    }
?>