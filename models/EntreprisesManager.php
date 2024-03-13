<?php

class EntreprisesManager extends Model
{

    // Get

    public function getEntreprises()
    {
        $this->getBdd();
        return $this->getAll('entreprises', 'Entreprises');
    }

    public function getEntreprise($nom)
    {
        $this->getBdd();
        return $this->getValueByColumn('entreprises', 'Nom', $nom);
    }

    public function getEntrepriseId($id)
    {
        $this->getBdd();
        return $this->getOne('entreprises', 'Entreprises', $id);
    }

    // Add

    public function addEntreprise($data)
    {
        $this->getBdd();
        return $this->add('entreprises', $data);
    }

    // Uptade

    public function updateEntreprise($data, $id)
    {
        $this->getBdd();
        $this->updateByColumn('entreprises', $data, $id, 'ID');
    }

    // Delete

    public function delEntrepriseId($id)
    {
        $this->getBdd();
        return $this->delete('entreprises', $id);
    }
}

?>