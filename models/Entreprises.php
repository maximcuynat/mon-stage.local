<?php

class Entreprises
{
    private $_id;
    private $_nom;
    private $_adresse;
    private $_ville;
    private $_codePostal;
    private $_pays;
    private $_telephone;
    private $_siteWeb;
    private $_email;
    private $_liensOffre;


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

    public function setAdresse($adresse)
    {
        if(is_string($adresse))
            $this->_adresse = $adresse;
    }

    public function setVille($ville)
    {
        if(is_string($ville))
            $this->_ville = $ville;
    }

    public function setCode_postal($codePostal)
    {
        if(is_string($codePostal))
            $this->_codePostal = $codePostal;
    }

    public function setPays($pays)
    {
        if(is_string($pays))
            $this->_pays = $pays;
    }

    public function setTelephone($telephone)
    {
        if(is_string($telephone))
            $this->_telephone = $telephone;
    }

    public function setSite_web($siteWeb)
    {
        if(is_string($siteWeb))
            $this->_siteWeb = $siteWeb;
    }

    public function setEmail($email)
    {
        if(is_string($email))
            $this->_email = $email;
    }

    public function setLiens_offre($liensOffre)
    {
        if(is_string($liensOffre))
            $this->_liensOffre = $liensOffre;
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
    
    public function adresse()
    {
        return $this->_adresse;
    }

    public function ville()
    {
        return $this->_ville;
    }

    public function codePostal()
    {
        return $this->_codePostal;
    }

    public function pays()
    {
        return $this->_pays;
    }

    public function telephone()
    {
        return $this->_telephone;
    }

    public function siteWeb()
    {
        return $this->_siteWeb;
    }

    public function email()
    {
        return $this->_email;
    }

    public function liensOffre()
    {
        return $this->_liensOffre;
    }
}