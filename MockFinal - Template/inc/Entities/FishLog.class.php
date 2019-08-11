<?php

class FishLog  {
    //Attributes
   private $id;
   private $weight;
   private $length;
   private $species;
   private $logstamp;
    //Getters
    function getId()
    {
        return $this->id;
    }
    function getWeight()
    {
        return $this->weight;
    }
    function getLength()
    {
        return $this->length;
    }
    function getSpecies()
    {
        return $this->species;
    }
    function getLogstamp()
    {
        return $this->logstamp;
    }

    
    //Setters
    function setId($new)
    {
        $this->id = $new;
    }
    function setWeight($new)
    {
        $this->weight = $new;
    }
    function setLength($new)
    {
        $this->length = $new;
    }
    function setSpecies($new)
    {
        $this->species = $new;
    }
    function setLogstamp($new)
    {
        $this->logstamp = $new;
    }


    function jsonSerialize()
    {
        $obj = new stdClass;
        $obj->id = $this->getId();
        $obj->weight = $this->getWeight();
        $obj->length = $this->getLength();
        $obj->species = $this->getSpecies();
        $obj->logstamp = $this->getLogstamp();
        return $obj;
    }

}