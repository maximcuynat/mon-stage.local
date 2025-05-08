<?php

require_once('views/View.php');

class ControllerUtilisateurs
{
    private $_utilisateursManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->utilisateurs();
    }

    private function utilisateurs()
    {
        $this->_utilisateursManager = new UtilisateursManager;
        $utilisateurs = $this->_utilisateursManager->getUtilisateurs();

        $this->_view = new View('Utilisateurs');
        $this->_view->generate(array('utilisateurs' => $utilisateurs));
    }
}
