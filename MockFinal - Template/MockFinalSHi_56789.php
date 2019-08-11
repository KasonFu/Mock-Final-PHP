<?php

//Require Files
require_once("inc/config.inc.php");
require_once("inc/Entities/FishLog.class.php");
require_once("inc/Entities/Species.class.php");
require_once("inc/Utility/FileService.class.php");
require_once("inc/Utility/SpeciesParser.class.php");
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/Page.class.php");
/*
//Read the file

//Parse the species


//Get the log for today

//If there was post data, parse it.
if (!empty($_POST)) {

    if ($_POST['action'] == "create")   {
        //Create new Log
    } 
}

if (!empty($_GET))   {

    //If there was get data
}


$logs = FishLogDAO::getLogs();
//var_dump(SpeciesParser::$species);
$messages[] = "Welcome to your CSIS 3275 Mock Final.";
//Set the title!
Page::setTitle("Mock Final - SHi_56789");

Page::header();

Page::showMessages($messages);

//Display the fish specices
Page::speciesForm(SpeciesParser::$species);

Page::showLog($logs);

Page::XMLExport();

Page::footer();
*/

$messages[] = "Welcome to your CSIS 3275 Mock Final.<br>";
$contents = FileService::readFile("data/bcfishspecies.csv");
//var_dump($contents);
SpeciesParser::parseSpeciesCSV($contents);
//var_dump(SpeciesParser::$species);
//FishLogDAO::initialize();

if (!empty($_POST)) {

    if ($_POST['action'] == "create")   {
        if(is_numeric($_POST["weight"])&& is_numeric($_POST["weight"]))
        {
        //Create new Log
        RestClient::call("POST",$_POST);
        }
        else{
            $messages[] = "Weight/Length is not valid number.<br>";
        }
    } 

    if($_POST["action"] == "edit")
    {
        RestClient::call("PUT",$_POST);
    }
}

if (!empty($_GET))   {
    if($_GET["action"]=="delete")
    {RestClient::call("DELETE",$_GET); }
}

//$logs = FishLogDAO::getLogs();
$jsonstring = RestClient::call("GET",array());
$json = json_decode($jsonstring);
$fishlogs = array();
if($json == null)
{}
else{
    foreach($json as $j)
    {
        $log = new FishLog();
        $log->setId($j->id);
        $log->setWeight($j->weight);
        $log->setLength($j->length);
        $log->setSpecies($j->species);
        $log->setLogstamp($j->logstamp);
        $fishlogs[] = $log;
    }
}
Page::setTitle("Mock Final - SHi_56789");

Page::header();
Page::showMessages($messages);

Page::showLog($fishlogs);
Page::speciesForm(SpeciesParser::$species);

if (!empty($_GET))   {
    if($_GET["action"]=="edit")
    {Page::editform(SpeciesParser::$species,$_GET["id"]); }
}

Page::XMLExport();
Page::footer();
?>