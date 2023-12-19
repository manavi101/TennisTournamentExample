<?php
  namespace DB;

  use Config\LoadConfig;

  class DatabaseFactory
  {
    protected static $Connection;
    
    public static function Build() : \PDO
    {
        if((self::$Connection instanceof \PDO) === false)
        {
            $config = LoadConfig::getConfig();
            self::$Connection = new \PDO($config->db_controller.':host='.$config->db_host.';dbname='.$config->db_name,$config->db_user,$config->db_password);
        }
        return self::$Connection;
    }

    public static function beginTransaction():void{
      if((self::$Connection instanceof \PDO) === false)
      {
        throw new \Exception("Transaction couldn't be created, PDO couldn't be setted");
      }else{
          self::$Connection->beginTransaction();
      }
    }

    public static function commit():void{
      if((self::$Connection instanceof \PDO) === false)
      {
          throw new \Exception("Transaction couldn't be commited, PDO is not setted");
      }else{
          self::$Connection->commit();
      }
    }      
    
    public static function rollback():void{
      if((self::$Connection instanceof \PDO) === false)
      {
          throw new \Exception("Transaction couldn't make rollback, PDO is not setted");
      }else{
          self::$Connection->rollback();
      }
    }
  }
?>