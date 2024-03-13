<?php

class Contacts
{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_telephone;
    private $_poste;
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

    public function setNom($nom)
    {
        if(is_string($nom))
            $this->_nom = $nom;
    }

    public function setPrenom($prenom)
    {
        if(is_string($prenom))
            $this->_prenom = $prenom;
    }

    public function setEmail($email)
    {
        if(is_string($email))
            $this->_email = $email;
    }

    public function setTelephone($telephone)
    {
        if(is_string($telephone))
            $this->_telephone = $telephone;
    }

    public function setId_entreprise($idEntreprise)
    {
        $idEntreprise = (int) $idEntreprise;
        if($idEntreprise > 0)
            $this->_idEntreprise = $idEntreprise;
    }

    public function setPoste($poste)
    {
        if(is_string($poste))
            $this->_poste = $poste;
    }

    // GETTERS

    public function id()
    {
        return $this->_id;
    }

    public function nom()
    {
        return $this->_nom;
    }

    public function prenom()
    {
        return $this->_prenom;
    }

    public function email()
    {
        return $this->_email;
    }

    public function telephone()
    {
        return $this->_telephone;
    }

    public function idEntreprise()
    {
        return $this->_idEntreprise;
    }

    public function poste()
    {
        return $this->_poste;
    }
}