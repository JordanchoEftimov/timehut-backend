<?php

return [

    'column_toggle' => [

        'heading' => 'Колони',

    ],

    'columns' => [

        'text' => [
            'more_list_items' => 'и :count повеќе',
        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Селектирај/одселектирај ги сите ставки.',
        ],

        'bulk_select_record' => [
            'label' => 'Селектира/деселектирај ја ставката :key.',
        ],

        'search' => [
            'label' => 'Пребарувај',
            'placeholder' => 'Пребарувај',
            'indicator' => 'Пребарувај',
        ],

    ],

    'summary' => [

        'heading' => 'Извештај',

        'subheadings' => [
            'all' => 'Сите :label',
            'group' => ':group',
            'page' => 'Оваа страница',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Просек',
            ],

            'count' => [
                'label' => 'Број на ставки',
            ],

            'sum' => [
                'label' => 'Сума',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Заврши со преместување на записите.',
        ],

        'enable_reordering' => [
            'label' => 'Премести записи',
        ],

        'filter' => [
            'label' => 'Филтер',
        ],

        'group' => [
            'label' => 'Групирај',
        ],

        'open_bulk_actions' => [
            'label' => 'Акции',
        ],

        'toggle_columns' => [
            'label' => 'Вклучи колони',
        ],

    ],

    'empty' => [

        'heading' => 'Нема :model',

        'description' => 'Креирај :model за да започнеш.',

    ],

    'filters' => [

        'actions' => [

            'remove' => [
                'label' => 'Отстрани филтер',
            ],

            'remove_all' => [
                'label' => 'Отстрани ги сите филтри',
                'tooltip' => 'Отстрани ги сите филтри',
            ],

            'reset' => [
                'label' => 'Ресетирај',
            ],

        ],

        'heading' => 'Филтри',

        'indicator' => 'Активни филтри',

        'multi_select' => [
            'placeholder' => 'Сите',
        ],

        'select' => [
            'placeholder' => 'Сите',
        ],

        'trashed' => [

            'label' => 'Избриши записи',

            'only_trashed' => 'Само избришани записи',

            'with_trashed' => 'Со избришани записи',

            'without_trashed' => 'Без избришани записи',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Групирај по',
                'placeholder' => 'Групирај по',
            ],

            'direction' => [

                'label' => 'Насока на групирање',

                'options' => [
                    'asc' => 'Растечки',
                    'desc' => 'Опаѓачки',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Повлечи и пушти ги записите во редослед.',

    'selection_indicator' => [

        'selected_count' => '1 запис селектиран|:count записи селектирани',

        'actions' => [

            'select_all' => [
                'label' => 'Селектирај ги сите :count',
            ],

            'deselect_all' => [
                'label' => 'Отселектирај ги сите',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Сортирај по',
            ],

            'direction' => [

                'label' => 'Насока на сортирање',

                'options' => [
                    'asc' => 'Растечка',
                    'desc' => 'Опаѓачка',
                ],

            ],

        ],

    ],

];
