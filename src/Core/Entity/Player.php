<?php
namespace Core\Entity;

/**
 * Player
 * Entidad de jugador
 */
class Player extends AbstractEntity{
  protected string $name ;
  protected int $level;
  protected int $sex;
  
  public function getName(): string{  
    return $this->name; 
  }
  
  public function getLevel(): int{
    return $this->level;
  }
  
  public function getSex(): int{
    return $this->sex;
  }
    
  public function setName(string $name): void{
    $this->name = $name;
  }
  
  public function setLevel(int $level): void{
    $this->validateIntAttr($level,1,100,'Level');
    $this->level = $level;
  }
  
  /**
   * Method setSex
   * 
   * @param int $sex Solo 1 (femenino) o 2 (masculino)
   * 
   * @return void
   */
  public function setSex(int $sex): void{
    $this->validateIntAttr($sex,1,2,'Sex');
    $this->sex = $sex;
  }

}


class MalePlayer extends Player{
  protected int $strength;
  protected int $speed;
    
  public function getStrength(): int{
    return $this->strength;
  }

  public function getSpeed(): int{
    return $this->speed;
  }
  /**
   * Method getPoints
   * El calculo de puntos es: 
   * fuerza * random (suerte) + velocidad * random (suerte) + nivel
   * @return float
   */
  public function getPoints(): float{
    return $this->speed*lcg_value()+$this->strength*lcg_value()+$this->level;
  }

  /**
   * Method setStrength
   * 
   * @param int $strength minimo de 1 y maximo de 100
   *
   * @return void
   */
  public function setStrength(int $strength): void{
    $this->validateIntAttr($strength,1,100,'Strength');
    $this->strength = $strength;
  }
  
  /**
   * Method setSpeed
   * 
   * @param int $speed minimo de 1 y maximo de 100
   *
   * @return void
   */
  public function setSpeed(int $speed): void{
    $this->validateIntAttr($speed,1,100,'Speed');
    $this->speed = $speed;
  }



}

class FemalePlayer extends Player{
  protected int $reactiontime;

  public function getReactionTime() : int{
    return $this->reactiontime;
  }
  
  /**
   * Method getPoints
   * El calculo de puntos es: 
   * reaccion del tiempo * random (suerte) + nivel
   * @return float
   */
  public function getPoints(): float{
    return $this->reactiontime*lcg_value()+$this->level;
  }
    /**
   * Method setReactionTime
   * 
   * @param int $reactiontime minimo de 1 y maximo de 100
   *
   * @return void
   */
  public function setReactionTime(int $reactiontime): void{
    $this->validateIntAttr($reactiontime,1,100,'Reaction Time');
    $this->reactiontime = $reactiontime;
  }


}

?>