<?php
namespace Config;
class LoadConfig {
  
  /**
   * Method getConfig
   * Cargo la configuracion, actualmente solo tiene datos de la db
   * @return mixed
   */
  public static function getConfig(): mixed{
    return json_decode(file_get_contents(__DIR__.'\\..\\..\\config.json'));
  }
}

?>