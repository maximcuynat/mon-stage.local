<?php

    require_once('views/View.php');

    class ControllerEntreprises
    {
        private $_entreprisesManager;
        private $_view;
        

        public function __construct($url)
        {

            if($url[0] == "entreprises" && count($url) == 1)
                $this->entreprises();
            
            elseif($url[0] == "entreprises" && count($url) >= 2)
            {
                if($url[1] == "add")
                    $this->addEntreprise();
                elseif($url[1] == "edit")
                    $this->editEntreprise($url[2]);
                elseif($url[1] == "delete")
                    $this->deleteEntreprise($url[2]);

                elseif(is_numeric($url[1]))
                    $this->infoEntreprise(intval($url[1]));
                else
                    throw new Exception('Page introuvable');
            }
        }

        private function entreprises()
        {
            $this->_entreprisesManager = new EntreprisesManager;
            $entreprises = $this->_entreprisesManager->getEntreprises();

            $this->_view = new View('Entreprises');
            $this->_view->generate(array('entreprises' => $entreprises), 'Entreprises');
        }

        private function addEntreprise()
        {
            $this->_view = new View('AddEntreprise');
            $this->_view->generate(array(), 'Ajouter une entreprise');
        }

        private function editEntreprise($id)
        {
            $this->_entreprisesManager = new EntreprisesManager;
            $entreprise = $this->_entreprisesManager->getEntrepriseId($id);

            $this->_view = new View('EditEntreprise');
            $this->_view->generate(array('entreprise' => $entreprise), 'Modifier une entreprise');
        }

        private function deleteEntreprise($id)
        {
            $this->_entreprisesManager = new EntreprisesManager;
            $entreprise = $this->_entreprisesManager->delEntrepriseId($id);
            header('Location: /entreprises');
        }

        private function infoEntreprise($id)
        {
            $this->_entreprisesManager = new EntreprisesManager;
            $entreprise = $this->_entreprisesManager->getEntrepriseId($id);

            $contactManager = new ContactsManager();
            $contacts = $contactManager->getContactByEntrepriseId($id);

            $this->_view = new View('InfoEntreprise');
            $this->_view->generate(array('entreprise' => $entreprise, 'allContacts' => $contacts), 'Info Entreprise');
        }
    }
?>