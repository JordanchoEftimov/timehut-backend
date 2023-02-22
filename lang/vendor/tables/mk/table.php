<?php

return [

    'columns' => [

        'tags' => [
            'more' => 'додади :count',
        ],

        'messages' => [
            'copied' => 'Копирано',
        ],

    ],

    'fields' => [

        'search_query' => [
            'label' => 'Пребарувај',
            'placeholder' => 'Пребарувај',
        ],

    ],

    'pagination' => [

        'label' => 'Пагинација',

        'overview' => 'Прикажани од :first до :last од :total резултати',

        'fields' => [

            'records_per_page' => [

                'label' => 'по страница',

                'options' => [
                    'all' => 'Сите',
                ],

            ],

        ],

        'buttons' => [

            'go_to_page' => [
                'label' => 'Оди наe :page',
            ],

            'next' => [
                'label' => 'Следно',
            ],

            'previous' => [
                'label' => 'Претходно',
            ],

        ],

    ],

    'buttons' => [

        'disable_reordering' => [
            'label' => 'Заврши со менување на редоследот',
        ],

        'enable_reordering' => [
            'label' => 'Смени го редоследот на записите',
        ],

        'filter' => [
            'label' => 'Филтер',
        ],

        'open_actions' => [
            'label' => 'Отвори акции',
        ],

        'toggle_columns' => [
            'label' => 'Отвори колони',
        ],

    ],

    'empty' => [
        'heading' => 'Не се пронајдени резултати',
    ],

    'filters' => [

        'buttons' => [

            'remove' => [
                'label' => 'Отстрани филтер',
            ],

            'remove_all' => [
                'label' => 'Отстрани ги сите филтри',
                'tooltip' => 'Отстрани ги сите филтри',
            ],

            'reset' => [
                'label' => 'Ресетирај филтри',
            ],

        ],

        'indicator' => 'Активни филтри',

        'multi_select' => [
            'placeholder' => 'Сите',
        ],

        'select' => [
            'placeholder' => 'Сите',
        ],

        'trashed' => [

            'label' => 'Избришани записи',

            'only_trashed' => 'Само избришани записи',

            'with_trashed' => 'Со избришани записи',

            'without_trashed' => 'Без избришани записи',

        ],

    ],

    'reorder_indicator' => 'Повлечи и отпушти за да го смениш редоследот.',

    'selection_indicator' => [

        'selected_count' => '1 запис селектиран.|:count записи селектирани.',

        'buttons' => [

            'select_all' => [
                'label' => 'Селектирај ги сите :count',
            ],

            'deselect_all' => [
                'label' => 'Оделектирај ги сите',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Подреди по',
            ],

            'direction' => [

                'label' => 'Насока на подредување',

                'options' => [
                    'asc' => 'Растечки',
                    'desc' => 'Опаѓачки',
                ],

            ],

        ],

    ],

];
