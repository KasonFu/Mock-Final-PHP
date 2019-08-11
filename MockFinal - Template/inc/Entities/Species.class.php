<?php


Class Species {


    //Common Name,Scientific Name,Category
    private $CommonName;
    private $ScientificName;
    private $Category;
    //Attributes
  

    //Getters
     function getCommonName()
    {
        return $this->CommonName;
    }
     function getScientificName()
    {
        return $this->ScientificName;
    }
     function getCategory()
    {
        return $this->Category;
    }
    //Setters
    function setCommonName($new)
    {
        $this->CommonName = $new;
    }
    function setScientificName($new)
    {
        $this->ScientificName = $new;
    }
    function setCategory($new)
    {
        $this->Category = $new;
    }
}

?>