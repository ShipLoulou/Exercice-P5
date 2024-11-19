<?php

require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";

    if ($line === 'quit') {
        exit;
    }

    if ($line === 'list') {
        $commandManager = new Command;
        $commandManager->list();
    }

    $detail = preg_match('/(?P<keyDetail>\w+) (?P<id>\d+)/', $line, $matchesDetail, PREG_OFFSET_CAPTURE);

    if ($detail && $matchesDetail !== []) {
        $detailWord = $matchesDetail['keyDetail'][0];
        if ($detailWord === 'detail') {
            $id = (int)$matchesDetail['id']['0'];
            $commandManager = new Command;
            $commandManager->detail($id);
        }
    }

    $create = preg_match('/(?P<keyCreate>\w+) (?P<name>\w+\s*\w*), (?P<email>\w+\W*\w*\W*\w*\W*\w*), (?P<phone_number>\d+)/', $line, $matchesCreate, PREG_OFFSET_CAPTURE);

    if ($create && $matchesCreate !== []) {
        $createWord = $matchesCreate['keyCreate'][0];
        if ($createWord === 'create') {
            $name = $matchesCreate['name'][0];
            $email = $matchesCreate['email'][0];
            $phone_number = $matchesCreate['phone_number'][0];

            $contact = new Contact(
                -1,
                $name,
                $email,
                $phone_number
            );

            $commandManager = new Command;
            $commandManager->create($contact);
        }
    }

    $delete = preg_match('/(?P<keyDelete>\w+) (?P<id>\d+)/', $line, $matchesDelete, PREG_OFFSET_CAPTURE);

    if ($delete && $matchesDelete !== []) {
        $deleteWord = $matchesDelete['keyDelete'][0];
        if ($deleteWord === 'delete') {
            $id = (int)$matchesDetail['id']['0'];

            $commandManager = new Command;
            $commandManager->delete($id);
        }
    }
}
