<?php

    require_once('views/View.php');

    class ControllerContacts
    {
        private $_contactsManager;
        private $_entreprisesManager;
        private $_view;

        public function __construct($url)
        {

            if($url[0] == "contacts" && count($url) == 1)
                $this->contacts();
            
            elseif($url[0] == "contacts" && count($url) >= 2)
            {
                if($url[1] == "add")
                    $this->addContact();
                elseif($url[1] == "edit")
                    $this->editContact($url[2]);
                elseif($url[1] == "delete")
                    $this->deleteContact($url[2]);

                elseif(is_numeric($url[1]))
                    $this->infoContact(intval($url[1]));
                else
                    throw new Exception('Page introuvable');
            }
        }

        private function contacts()
        {
            $this->_contactsManager = new ContactsManager;
            $contacts = $this->_contactsManager->getContacts();

            $this->_view = new View('Contacts');
            $this->_view->generate(array('contacts' => $contacts), 'Contacts');
        }

        private function addContact()
        {
            $this->_entreprisesManager = new EntreprisesManager;
            $entreprises = $this->_entreprisesManager->getEntreprises();

            $this->_view = new View('AddContact');
            $this->_view->generate(array('entreprises' => $entreprises), 'Ajouter un contact');
        }

        private function editContact($id)
        {
            $this->_contactsManager = new ContactsManager;
            $contact = $this->_contactsManager->getContactId($id);

            $this->_entreprisesManager = new EntreprisesManager;
            $entreprises = $this->_entreprisesManager->getEntreprises();

            $this->_view = new View('EditContact');
            $this->_view->generate(array('contact' => $contact, 'entreprises' => $entreprises[0]), 'Modifier un contact');
        }

        private function deleteContact($id)
        {
            $this->_contactsManager = new ContactsManager;
            $contact = $this->_contactsManager->delContactId($id);
            header('Location: /contacts');
        }

        private function infoContact($id)
        {
            $this->_contactsManager = new ContactsManager;
            $contact = $this->_contactsManager->getContactId($id);

            if($contact == false)
                throw new Exception('Page introuvable');
            else

            $this->_view = new View('InfoContact');
            $this->_view->generate(array('contact' => $contact), 'Contact');
        }
    }
?>