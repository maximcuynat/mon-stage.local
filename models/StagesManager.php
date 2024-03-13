<?php

class StagesManager extends Model
{

    // Get 
    public function getStages()
    {
        $this->getBdd();
        return $this->getAll('stages', 'Stages');
    }

    public function getStageId($id)
    {
        $this->getBdd();
        return $this->getOne('stages', 'Stages', $id);
    }

    // Add

    public function addStage($data)
    {
        $this->getBdd();
        return $this->add('stages', $data);
    }

    // Uptade

    public function updateStage($data, $id)
    {
        $this->getBdd();
        $this->update('stages', $data, $id);
    }

    // Delete

    public function delStageId($id)
    {
        $this->getBdd();
        return $this->delete('stages', $id);
    }    
}