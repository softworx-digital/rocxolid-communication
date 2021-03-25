<?php

return [
    'column' => [
        'is_can_be_turned_off' => 'Vypínateľná',
        'event_type' => 'Akcia',
        'sender_email' => 'e-mail odosielateľa',
        'sender_name' => 'Meno odosielateľa',
        'recipient_email' => 'e-mail prijímateľa',
        'subject' => 'Predmet',
        'content' => 'Obsah',
        'description' => 'Popis',
    ],
    'field' => [
        'is_can_be_turned_off' => 'Môže byť vypnutá používateľom',
        'event_type' => 'Akcia',
        'sender_email' => 'e-mail odosielateľa',
        'sender_name' => 'Meno odosielateľa',
        'recipient_email' => 'e-mail prijímateľa',
        'subject' => 'Predmet',
        'content' => 'Obsah',
        'description' => 'Popis - interná poznámka',
    ],
    'model' => [
        'title' => [
            'singular' => 'Push notifikácia',
            'plural' => 'Push notifikácie',
        ],
    ],
    'button' => [
        'send-test' => 'Poslať testovaciu pushku',
        'submit-new' => 'Uložiť a vytvoriť novú',
        'submit-new' => 'Uložiť a vytvoriť novú',
    ],
    'table-button' => [
        'send-test' => 'Poslať testovaciu pushku',
    ],
    'action' => [
        'create' => 'Nová',
        'sendTestNotificationConfirm' => 'Odoslanie testovacej pushky',
    ],
    'placeholder' => [
        'email' => 'Adresa, na ktorú má byť e-mail odoslaný',
        'event_type' => 'Akcia, na základe ktorej sa odošle e-mail',
        'user_id' => 'ID testovacieho používateľa',
    ],
    'text' => [
        'tokens' => 'Atribúty',
        'tokens-help' => 'Nasledujúce atribúty je možné použiť v predmete a obsahu pushky.<br />Pre použitie atribútu nastavte kurzor na želané miesto v texte a kliknite na modré tlačidlo atribútu pre vloženie.<br />Pre odstránenie atribútu z textu je potrebné vymazať celý reťazec začínajúci \'{{\' a končiaci \'}}\' vrátane týchto značiek.',
        'sending-success' => 'Pushka bola odoslaná',
        'sending-failure' => 'Nastal problém s odosielaním pushky, skontrolujte API údaje.',
    ],
    'permissions' => [
        'sendTestNotification' => 'Posielanie testovacích notifikácií',
    ],
];