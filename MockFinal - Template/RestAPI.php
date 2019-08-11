<?php


//Require configuration
require_once('inc/config.inc.php');

//Require Entities
require_once('inc/Entities/FishLog.class.php');

//Require Utillity Classes
require_once('inc/Utility/PDOAgent.class.php');
require_once('inc/Utility/FishLogDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/

//Instantiate a new Customer Mapper
FishLogDAO::initialize();

parse_str(file_get_contents('php://input'), $requestData);

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
    //Get all the things
    $fishlogs = FishLogDAO::getLogs();

    //This is to store our std Objects for conversion to json
    $jsonlogs = array();

    foreach ($fishlogs as $f)  {
        $jsonlogs[] = $f->jsonSerialize();
    }

    //Set the header to json
    header('Content-Type: application/json');
    //Return a serialized version of the stdObjects
    echo json_encode($jsonlogs);


    break;

    case "POST":
    //Insert all the things
        $nc = new FishLog();
        $nc->setWeight($requestData['weight']);
        $nc->setLength($requestData['length']);
        $nc->setSpecies($requestData['commonname']);

    //Add the new customer
        FishLogDAO::createLogEntry($nc);

    break;

    case "PUT":
    //Update all the things
        $nc = new FishLog();
        $nc->setId($requestData['id']);
        $nc->setWeight($requestData['weight']);
        $nc->setLength($requestData['length']);
        $nc->setSpecies($requestData['commonname']);
        FishLogDAO::updateFishLog($nc);
    break;

    case "DELETE":
    //Delete all the things.
    FishLogDAO::deleteLogEntry($requestData["id"]);
    break;

    default:
        echo json_encode(array("message" => "Voce fala HTTP?"));
}

?>