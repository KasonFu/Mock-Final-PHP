<?php

class FishLogDAO   {

// +----------+-------------+------+-----+---------+----------------+
// | Field    | Type        | Null | Key | Default | Extra          |
// +----------+-------------+------+-----+---------+----------------+
// | id       | int(11)     | NO   | PRI | NULL    | auto_increment |
// | weight   | int(11)     | NO   |     | NULL    |                |
// | length   | int(11)     | NO   |     | NULL    |                |
// | species  | varchar(50) | NO   |     | NULL    |                |
// | category | varchar(50) | NO   |     | NULL    |                |
// | logstamp | datetime    | YES  |     | NULL    |                |
// +----------+-------------+------+-----+---------+----------------+
// 6 rows in set (0.00 sec)

    private static $db;

    static function initialize()
    {
        self::$db = new PDOAgent("FishLog");
    }

    static function getLogs()   {
        
        $selectAll = "SELECT * FROM FishLog;";
        //Prepare the query
        self::$db->query($selectAll);
        //Execute the query
        self::$db->execute();
        //Get the row
        return self::$db->resultset();
    }

    static function createLogEntry(FishLog $log)    {
     

        //Generate the INSERT STATEMENT for the customer;
        $sqlInsert = "INSERT INTO FishLog (weight, length, species, logstamp) VALUES ( :weight, :length, :species, NOW() );";
        
        //prepare the query
        self::$db->query($sqlInsert);

        //Setup the bind parameters
        
        self::$db->bind(':weight', $log->getWeight());
        self::$db->bind(':length', $log->getLength());
        self::$db->bind(':species', $log->getSpecies());


        //Execute the query
        self::$db->execute();

        //Return the last inserted ID!!
        return  self::$db->lastInsertId();
    }

    static function deleteLogEntry(int $id) {

        try {

            //Create the delete query
            $deleteQuery = "DELETE FROM FishLog WHERE id = :id";
            self::$db->query($deleteQuery);
            //Bind the id
            self::$db->bind(':id', $id);
            //Execute the query
            self::$db->execute();

            } catch (Exception $ex) {

                echo $ex->getMessage();
                self::$db->debugDumpParams();
                return false;
        
        }

        return true;
    }


    static function updateFishLog(FishLog $fishlog): int   {
        try {
            //Create the query
            $updateQuery = "UPDATE Fishlog SET weight = :weight, length = :length, species = :species, logstamp = now() WHERE id = :id;";

            self::$db->query($updateQuery);

            $data = [
                ':weight' => $fishlog->getWeight(),
                ':length' => $fishlog->getLength(),
                ':species' => $fishlog->getSpecies(),
                ':id' => $fishlog->getId()
            ];
            
            //Execute the query
            self::$db->execute($data);

            //Check the appropriate updates
            if (self::$db->rowCount() !=1)    {
                throw new Exception("There was an error updating the database!");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
        }    

        //Get the number of affected rows
        return self::$db->rowCount();
    }


}
?>