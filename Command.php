<?php

class Command extends ContactManager
{
    public function list()
    {
        $contacts = $this->findAll();
        foreach ($contacts as $contact) {
            echo "{$contact->toString()}\n";
        }
    }

    public function detail($id)
    {
        $contact = $this->findById($id);
        if (!$contact) {
            echo "Contact introuvable \n";
            return;
        }
        echo "{$contact->toString()}\n";
    }

    public function create(Contact $contact)
    {
        $response = $this->addContact($contact);

        if ($response === true) {
            echo "Le contact à bien été enregistrer\n";
        }
    }

    public function delete($id)
    {
        $response = $this->deleteContact($id);

        if ($response === true) {
            echo "Le contact à bien été supprimé\n";
        }
    }
}
