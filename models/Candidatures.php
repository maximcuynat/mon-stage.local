<?php

class Candidatures
{
    private $_ID_;
    private $_ID_Stage;
    private $_ID_Statut;
    private $_Date_Candidature;
    private $_Commentaires;

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

    // GETTERS
    public function ID()
    {
        return $this->_ID_;
    }

    public function ID_Stage()
    {
        return $this->_ID_Stage;
    }

    public function ID_Statut()
    {
        return $this->_ID_Statut;
    }

    public function Date_Candidature()
    {
        return $this->_DateCandidature;
    }

    public function Commentaires()
    {
        return $this->_Commentaires;
    }

    // SETTERS

    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
            $this->_ID = $id;
    }

    public function setID_Stage($idStage)
    {
        $idStage = (int) $idStage;
        if($idStage > 0)
            $this->_ID_Stage = $idStage;
    }

    public function setID_Statut($idStatut)
    {
        $idStatut = (int) $idStatut;
        if($idStatut > 0)
            $this->_ID_Statut = $idStatut;
    }

    public function setDate_Candidature($dateCandidature)
    {
        $this->_DateCandidature = $dateCandidature;
    }

    public function setCommentaires($commentaires)
    {
        if(is_string($commentaires))
            $this->_Commentaires = $commentaires;
    }
}

?>