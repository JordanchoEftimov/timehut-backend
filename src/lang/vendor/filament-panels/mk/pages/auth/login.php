<?php

return [

    'title' => 'Најави се',

    'heading' => 'Најави се',

    'actions' => [

        'register' => [
            'before' => 'или',
            'label' => 'регистрирај профил',
        ],

        'request_password_reset' => [
            'label' => 'Заборавена лозинка?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Е-пошта',
        ],

        'password' => [
            'label' => 'Лозинка',
        ],

        'remember' => [
            'label' => 'Запамети ме',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Најави се',
            ],

        ],

    ],

    'messages' => [

        'failed' => 'Не точна лозинка или е-пошта.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Премногу обиди за најава',
            'body' => 'Ве молиме обидете се за :seconds секунди.',
        ],

    ],

];
