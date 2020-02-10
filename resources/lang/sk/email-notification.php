<?php

return [
    'column' => [
        'is_can_be_turned_off' => 'Vypínateľná',
        'event_type' => 'Akcia',
        'sender_email' => 'e-mail odosielateľa',
        'sender_name' => 'Meno odosielateľa',
        'recipient_email' => 'e-mail prijímateľa',
        'cc_recipient_email' => 'Kópia (CC)',
        'bcc_recipient_email' => 'Skrytá kópia (BCC)',
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
        'cc_recipient_email' => 'Kópia (CC)',
        'bcc_recipient_email' => 'Skrytá kópia (BCC)',
        'subject' => 'Predmet',
        'content' => 'Obsah',
        'description' => 'Popis - interná poznámka',
    ],
    'model' => [
        'title' => [
            'singular' => 'e-mail notifikácia',
            'plural' => 'e-mail notifikácie',
        ],
    ],
    'button' => [
        'send-test' => 'Poslať testovací e-mail',
        'submit_new' => 'Uložiť a vytvoriť novú',
        'submit_ajax_new' => 'Uložiť a vytvoriť novú',
    ],
    'table-button' => [
        'send-test' => 'Poslať testovací e-mail',
    ],
    'action' => [
        'create' => 'Nová',
        'sendTestNotificationConfirm' => 'Odoslanie testovacieho e-mailu',
    ],
    'placeholder' => [
        'email' => 'Adresa, na ktorú má byť e-mail odoslaný',
        'event_type' => 'Akcia, na základe ktorej sa odošle e-mail',
    ],
    'text' => [
        'tokens' => 'Atribúty',
        'tokens-help' => 'Nasledujúce atribúty je možné použiť v predmete a obsahu e-mailu.<br />Pre použitie atribútu nastavte kurzor na želané miesto v texte a kliknite na modré tlačidlo atribútu pre vloženie.<br />Pre odstránenie atribútu z textu je potrebné vymazať celý reťazec začínajúci \'{{\' a končiaci \'}}\' vrátane týchto značiek.',
        'sending-success' => 'E-mail bol odoslaný',
        'sending-failure' => 'Nastal problém s odosielaním e-mailu, skontrolujte prihlasovacie údaje na SMTP server.',
    ],
    'permissions' => [
        'sendTestNotification' => 'Posielanie testovacích notifikácií',
    ],
];