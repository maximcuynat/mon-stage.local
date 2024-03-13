<?php

    class Statuts
    {
        private $_id;
        private $_status;

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

        public function setStatut($nomEntreprise)
        {
            if(is_string($nomEntreprise))
                $this->_nomEntreprise = $nomEntreprise;
        }
        // GETTERS

        public function id()
        {
            return $this->_id;
        }

        public function nomEntreprise()
        {
            return $this->_nomEntreprise;
        }
    }
