<?php 

//Rwquire files


//Get the log for today


//Generate the XML


header("Content-Type: text/xml");
echo $xml->asXML();
?>