<?php

return [

    'label' => 'Пагинација',

    'overview' => '{1} Прикажано 1 запис|[2,*] Се прикажува :first до :last од :total резултати',

    'fields' => [

        'records_per_page' => [

            'label' => 'По страница',

            'options' => [
                'all' => 'Сите',
            ],

        ],

    ],

    'actions' => [

        'go_to_page' => [
            'label' => 'Оди на страницата :page',
        ],

        'next' => [
            'label' => 'Следно',
        ],

        'previous' => [
            'label' => 'Претходно',
        ],

    ],

];
