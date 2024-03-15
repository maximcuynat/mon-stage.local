<?php

    require_once('views/View.php');

    class ControllerAccueil
    {
        private $_view;

        public function __construct($url)
        {
            if($url[0] == "accueil" && count($url) == 1)
                $this->accueil();
            else
                throw new Exception('Page introuvable');
        }

        private function accueil()
        {
            $this->_view = new View('Accueil');
            $this->_view->generate(array(), 'Accueil');
        }
    }
?>