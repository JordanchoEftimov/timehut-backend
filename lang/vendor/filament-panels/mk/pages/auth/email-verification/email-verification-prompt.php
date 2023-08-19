<?php

return [

    'title' => 'Потврдете ја вашата е-пошта',

    'heading' => 'Потврдете ја вашата е-пошта',

    'actions' => [

        'resend_notification' => [
            'label' => 'Испрати повторно',
        ],

    ],

    'messages' => [
        'notification_not_received' => 'Сеуште немате добиено е-пошта?',
        'notification_sent' => 'Испративме е-пошта на :email содржејќи информации за како да ја потврдите вашата е-пошта.',
    ],

    'notifications' => [

        'notification_resent' => [
            'title' => 'Е-поштата е испратена повторно.',
        ],

        'notification_resend_throttled' => [
            'title' => 'Премногу обиди',
            'body' => 'Ве молиме обидете се за :seconds секунди.',
        ],

    ],

];
