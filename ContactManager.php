<?php

class ContactManager extends DBConnect
{
    public function findAll(): array
    {
        $sql = "SELECT * FROM contact";
        $result = $this->getPDO()->query($sql);

        $contacts = [];

        foreach ($result as $row) {
            $contacts[] = new Contact(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['phone_number']
            );
        }


        return $contacts;
    }

    public function findById(int $id): ?Contact
    {
        $sql = "SELECT * FROM contact WHERE id = :id";
        $result = $this->getPDO()->prepare($sql);
        $result->execute([
            'id' => $id
        ]);

        $contacts = null;

        foreach ($result as $row) {
            $contacts = new Contact(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['phone_number']
            );
        }

        if (!$contacts) {
            return null;
        }

        return $contacts;
    }

    public function addContact(Contact $contact): bool
    {
        $sql = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $result = $this->getPDO()->prepare($sql);
        $result->execute([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone_number' => $contact->getPhoneNumber()
        ]);

        return true;
    }

    public function deleteContact($id): bool
    {
        $sql = "DELETE FROM contact WHERE id = :id";
        $result = $this->getPDO()->prepare($sql);
        $result->execute([
            'id' => $id
        ]);

        return true;
    }
}
