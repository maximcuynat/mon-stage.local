<?php

class CandidaturesManager extends Model
{

    // Get

    public function getCandidatures()
    {
        $this->getBdd();
        return $this->getAll('candidatures', 'Candidatures');
    }

    public function getCandidatureId($id)
    {
        $this->getBdd();
        return $this->getOne('candidatures', 'Candidatures', $id);
    }

    public function getCandidatureByStageId($id)
    {
        $this->getBdd();
        return $this->getValueByColumn('candidatures', 'ID_Stage', $id);
    }

    // Add

    public function addCandidature($data)
    {
        $this->getBdd();
        $this->add('candidatures', $data);
    }


    // Uptade

    public function updateCandidature($data, $id)
    {
        $this->getBdd();
        $this->updateByColumn('candidatures', $data, $id, 'ID_Stage');
    }

    // Delete

    public function delCandidatureId($id)
    {
        $this->getBdd();
        return $this->delete('candidatures', $id);
    }

    public function delCandidatureByStageId($id)
    {
        $this->getBdd();
        return $this->deleteByColumn('candidatures', 'ID_Stage', $id);
    }
}

?>