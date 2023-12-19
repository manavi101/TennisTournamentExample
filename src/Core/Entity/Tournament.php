<?php
namespace Core\Entity;

class Tournament extends AbstractEntity{
  protected string $name;
  protected int $sex;
  protected array $players;

  public function getName() :string{
    return $this->name;
  }

  public function getSex() :int{
    return $this->sex;
  }

  public function setName(string $name) :void{
    $this->name = $name;
  }
  
  /**
   * Method setSex
   *
   * @param int $sex Puede ser solo 1 (femenino) 0 2 (masculino)
   *
   * @return void
   */
  public function setSex(int $sex) :void{
    $this->validateIntAttr($sex,1,2,'Sex');
    $this->sex = $sex;
  }

  public function getPlayers():array{
    return $this->players;
  }

  public function setPlayers(array $players) :void{
    $this->players = $players;
  }

}
?>