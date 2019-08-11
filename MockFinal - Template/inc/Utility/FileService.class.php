<?php

class FileService   {
    public static $contents = "";

    static function readFile($fileName) : string {
      try{
          $fh = fopen($fileName,'r');

          if(!$fh)
          {
            throw new Exception("We couldnt open the file $fileName.");
          }
          self::$contents = fread($fh,filesize($fileName));
          fclose($fh);
          return self::$contents;
      }catch(Exception $ex)
      {
          system.out.println($ex->getMessage());
      }
    }
}