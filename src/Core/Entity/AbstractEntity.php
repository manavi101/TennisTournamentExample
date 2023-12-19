<?php
  namespace Core\Entity;  
  /**
   * AbstractEntity
   * Clase generica
   */
  abstract class AbstractEntity{
    protected int $id ;

    public function __construct(?int $id = null){
      if(is_null($id))
        return;
      $this->id = $id;
    }
    
    /**
     * Method getId
     * Devuelve el id de la clase
     * @return int
     */
    public function getId(): int{
      return $this->id;
    }
    
    /**
     * Method jsonSerialize
     * Serializa la clase en un json
     * @return void
     */
    public function jsonSerialize():?string
    {
      return json_encode(get_object_vars($this),JSON_PRETTY_PRINT);
    }
        
    /**
     * Method validateIntAttr
     * Para valores enteros define entre que valor minimo y maximo puede estar
     * @param int $value valor a evaluar
     * @param int $minValue valor minimo que puede tomar
     * @param int $maxValue valor maximo que puede tomar
     * @param $attrName $attrName Nombre del atributo
     *
     * @return void
     */
    protected function validateIntAttr(int $value,int $minValue,int $maxValue,$attrName): void{
      if($minValue>$value||$value>$maxValue)
        throw new \Exception ($attrName." needs to be between ".$minValue." and ".$maxValue.". The value sent is: ".$value);
    }
  }
?>