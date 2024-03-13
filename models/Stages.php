<?php

class Stages
{
    private $_id;
    private $_lienOffre;
    private $_description;
    private $_datePostulation;
    private $_idEntreprise;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    // SETTERS
    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
            $this->_id = $id;
    }

    public function setLien_offre($lienOffre)
    {
        if(is_string($lienOffre))
            $this->_lienOffre = $lienOffre;
    }

    public function setDescription($description)
    {
        if(is_string($description))
            $this->_description = $description;
    }

    public function setId_entreprise($idEntreprise)
    {
        $idEntreprise = (int) $idEntreprise;
        if($idEntreprise > 0)
            $this->_idEntreprise = $idEntreprise;
    }

    public function setDate_postulation($datePostulation)
    {
        $this->_datePostulation = $datePostulation;
    }
    // GETTERS

    public function id()
    {
        return $this->_id;
    }

    public function lienOffre()
    {
        return $this->_lienOffre;
    }

    public function description()
    {
        return $this->_description;
    }

    public function datePostulation()
    {
        return $this->_datePostulation;
    }

    public function idEntreprise()
    {
        return $this->_idEntreprise;
    }
}
