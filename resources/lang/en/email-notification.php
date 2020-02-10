<?php

return [
    'column' => [
        'is_can_be_turned_off' => 'Offable',
        'event_type' => 'Event type',
        'sender_email' => 'Sender e-mail address',
        'sender_name' => 'Sender name',
        'recipient_email' => 'Recipient e-mail address',
        'cc_recipient_email' => 'Copy (CC)',
        'bcc_recipient_email' => 'Blind copy (BCC)',
        'subject' => 'Subject',
        'content' => 'Content',
        'description' => 'Description - internal note',
    ],
    'field' => [
        'is_can_be_turned_off' => 'Can be turned off by user',
        'event_type' => 'Event type',
        'sender_email' => 'Sender e-mail address',
        'sender_name' => 'Sender name',
        'recipient_email' => 'Recipient e-mail address',
        'cc_recipient_email' => 'Copy (CC)',
        'bcc_recipient_email' => 'Blind copy (BCC)',
        'subject' => 'Subject',
        'content' => 'Content',
        'description' => 'Description - internal note',
    ],
    'model' => [
        'title' => [
            'singular' => 'e-mail notification',
            'plural' => 'e-mail notifications',
        ],
    ],
    'button' => [
        'send-test' => 'Send testing e-mail',
    ],
    'table-button' => [
        'send-test' => 'Send testing e-mail',
    ],
    'action' => [
        'sendTestNotificationConfirm' => 'Sending testing e-mail',
    ],
    'placeholder' => [
        'email' => 'Address to send e-mail',
        'event_type' => 'Event, upon which the e-mail will be sent',
        'sending-success' => 'E-mail was successfully sent',
        'sending-failure' => 'There was a problem sending e-mail, check SMTP server credentials',
    ],
    'permissions' => [
        'sendTestNotification' => 'Sending test notifiactions',
    ],
];