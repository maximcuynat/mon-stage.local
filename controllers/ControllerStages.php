<?php

require_once('views/View.php');

class ControllerStages
{
    private $_stagesManager;
    private $_view;

    public function __construct($url)
    {

        if($url[0] == "stages" && count($url) == 1)
            $this->stages();
        
        elseif($url[0] == "stages" && count($url) >= 2)
        {
            if($url[1] == "add")
                $this->addStage();
            elseif($url[1] == "edit")
                $this->editStage($url[2]);
            elseif($url[1] == "delete")
                $this->deleteStage($url[2]);

            elseif(is_numeric($url[1]))
                $this->infoStage(intval($url[1]));
            else
                throw new Exception('Page introuvable');
        }
    }

    private function stages()
    {
        $this->_stagesManager = new StagesManager;
        $stages = $this->_stagesManager->getStages();

        $this->_view = new View('Stages');
        $this->_view->generate(array('stages' => $stages), 'Candidatures');
    }

    private function addStage()
    {
        $this->_view = new View('AddStage');
        $this->_view->generate(array(), 'Ajouter une candidature');
    }

    private function editStage($id)
    {
        $this->_stagesManager = new StagesManager;
        $stage = $this->_stagesManager->getStageId($id);

        $this->_candidaturesManager = new CandidaturesManager;
        $candidature = $this->_candidaturesManager->getCandidatureByStageId($id);

        $this->_entreprisesManager = new EntreprisesManager;
        $entreprise = $this->_entreprisesManager->getEntrepriseId($stage->idEntreprise());

        $this->_view = new View('EditStage');
        $this->_view->generate(array('stage' => $stage, 'candidature' => $candidature, 'entreprise' => $entreprise ), 'Editer un stage');
    }

    private function deleteStage($id)
    {
        $this->_candidaturesManager = new CandidaturesManager;
        $candidature = $this->_candidaturesManager->delCandidatureByStageId($id);
        
        $this->_stagesManager = new StagesManager;
        $stage = $this->_stagesManager->delStageId($id);
        
        header('Location: /stages');
    }

    private function infoStage($id)
    {
        $this->_stagesManager = new StagesManager;
        $stage = $this->_stagesManager->getStageId($id);

        $this->_candidaturesManager = new CandidaturesManager;
        $candidature = $this->_candidaturesManager->getCandidatureByStageId($id);

        $this->_entreprisesManager = new EntreprisesManager;
        $entreprise = $this->_entreprisesManager->getEntrepriseId($stage->idEntreprise());

        $this->_view = new View('InfoStage');
        $this->_view->generate(array('stage' => $stage, 'candidature' => $candidature, 'entreprise' => $entreprise), 'Stage infos');
    }

    private function delete()
    {
        $this->_view = new View('AddStage');
        $this->_view->generate(array(), 'Ajouter un stage');
    }
}