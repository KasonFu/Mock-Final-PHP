<?php

class SpeciesParser {

    public static $species = array();

    //This function parses the specicies, return an integer when you are done.
    static function parseSpeciesCSV(string $csv) : int    {

        //Parse the CSV
        $lines = explode("\n",$csv);

        try {
            //Parse the lines
           foreach($lines as $key=>$value)
           {
               if($key != 0)
               {
                   //Parse each column
                   $columns = explode(",",$value);
                   if(count($columns)!= 3)
                   {
                        //Column count doesnt exist?  throw an error
                       throw new Exception("There is a problem with the file on $key");
                   }else {
                    //Create a new species
                    $n = new Species();
                    $n->setCommonName($columns[0]);
                    $n->setScientificName($columns[1]);
                    $n->setCategory($columns[2]);
                    //Add the species to local storage
                    self::$species[] = $n;
                }
               }
           }} catch (Exception $ex) {
            echo $ex->getMessagE();
           }
        return count(self::$species);
}
}


?>