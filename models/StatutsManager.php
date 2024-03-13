<?php

    class StatutsManager extends Model
    {
        public function getStatuts()
        {
            $this->getBdd();
            return $this->getAll('statuts', 'Statuts');
        }

        public function getStatutId($id)
        {
            $this->getBdd();
            return $this->getOne('statuts', 'Statuts', $id);
        }

        public function getStatutByStageId($id)
        {
            $this->getBdd();
            return $this->getValueByColumn('statuts', 'ID_Stage', $id);
        }

        public function addStatut($data)
        {
            $this->getBdd();
            $this->add('statuts', $data);
        }

        public function updateStatut($data, $id)
        {
            $this->getBdd();
            $this->updateByColumn('statuts', $data, $id, 'ID_Stage');
        }

        public function delStatutId($id)
        {
            $this->getBdd();
            return $this->delete('statuts', $id);
        }

        public function delStatutByStageId($id)
        {
            $this->getBdd();
            return $this->deleteByColumn('statuts', 'ID_Stage', $id);
        }
    }
?>