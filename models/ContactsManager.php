<?php

class ContactsManager extends Model
{

    // Get

    public function getContacts()
    {
        $this->getBdd();
        return $this->getAll('contacts', 'Contacts');
    }

    public function getContactId($id)
    {
        $this->getBdd();
        return $this->getOne('contacts', 'Contacts', $id);
    }

    // Get by
    public function getContactByEntrepriseId($id)
    {
        $this->getBdd();
        return $this->getAllByColumn('contacts', 'contacts', 'ID_Entreprise', $id);
    }

    // Add

    public function addContact($data)
    {
        $this->getBdd();
        $this->add('contacts', $data);
    }

    // Uptade

    public function updateContact($data, $id)
    {
        $this->getBdd();
        $this->updateByColumn('contacts', $data, $id, 'ID');
    }

    // Delete

    public function delContactId($id)
    {
        $this->getBdd();
        $this->delete('contacts', $id);
    }
}
?>