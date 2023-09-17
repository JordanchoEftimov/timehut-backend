<?php

return [

    'builder' => [

        'actions' => [

            'clone' => [
                'label' => 'Клонирај',
            ],

            'add' => [
                'label' => 'Додади :label',
            ],

            'add_between' => [
                'label' => 'Внеси меѓу блокови',
            ],

            'delete' => [
                'label' => 'Избриши',
            ],

            'reorder' => [
                'label' => 'Премести',
            ],

            'move_down' => [
                'label' => 'Премести надолу',
            ],

            'move_up' => [
                'label' => 'Премести нагоре',
            ],

            'collapse' => [
                'label' => 'Затвори',
            ],

            'expand' => [
                'label' => 'Отвори',
            ],

            'collapse_all' => [
                'label' => 'Затвори се',
            ],

            'expand_all' => [
                'label' => 'Отвори се',
            ],

        ],

    ],

    'checkbox_list' => [

        'actions' => [

            'deselect_all' => [
                'label' => 'Одселектирај ги сите',
            ],

            'select_all' => [
                'label' => 'Селектирај ги сите',
            ],

        ],

    ],

    'file_upload' => [

        'editor' => [

            'actions' => [

                'cancel' => [
                    'label' => 'Откажи',
                ],

                'drag_crop' => [
                    'label' => 'Мод "crop"',
                ],

                'drag_move' => [
                    'label' => 'Мод "move"',
                ],

                'flip_horizontal' => [
                    'label' => 'Заврти ја сликата хоризонтално',
                ],

                'flip_vertical' => [
                    'label' => 'Заврти ја сликата вертикално',
                ],

                'move_down' => [
                    'label' => 'Помести ја сликата на долу',
                ],

                'move_left' => [
                    'label' => 'Помести ја сликата на лево',
                ],

                'move_right' => [
                    'label' => 'Помести ја сликата на десно',
                ],

                'move_up' => [
                    'label' => 'Помести ја сликата на горе',
                ],

                'reset' => [
                    'label' => 'Ресетирај',
                ],

                'rotate_left' => [
                    'label' => 'Ротирај ја сликата на лево',
                ],

                'rotate_right' => [
                    'label' => 'Ротирај ја сликата на десно',
                ],

                'set_aspect_ratio' => [
                    'label' => 'Постави рејтио :ratio',
                ],

                'save' => [
                    'label' => 'Зачувај',
                ],

                'zoom_100' => [
                    'label' => 'Зумирај слика на 100%',
                ],

                'zoom_in' => [
                    'label' => 'Зумирај',
                ],

                'zoom_out' => [
                    'label' => 'Одзумирај',
                ],

            ],

            'fields' => [

                'height' => [
                    'label' => 'Висина',
                    'unit' => 'px',
                ],

                'rotation' => [
                    'label' => 'Ротација',
                    'unit' => 'deg',
                ],

                'width' => [
                    'label' => 'Ширина',
                    'unit' => 'px',
                ],

                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],

                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],

            ],

            'aspect_ratios' => [

                'label' => 'Рејтио',

                'no_fixed' => [
                    'label' => 'Free',
                ],

            ],

        ],

    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'Додади редица',
            ],

            'delete' => [
                'label' => 'Избриши редица',
            ],

            'reorder' => [
                'label' => 'Помести редица',
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'Клуч',
            ],

            'value' => [
                'label' => 'Вредност',
            ],

        ],

    ],

    'markdown_editor' => [

        'toolbar_buttons' => [
            'attach_files' => 'Прикачи датотеки',
            'blockquote' => 'Цитат',
            'bold' => 'Здебелно',
            'bullet_list' => 'Листа со точки',
            'code_block' => 'Код блок',
            'heading' => 'Наслов',
            'italic' => 'Закосено',
            'link' => 'Линк',
            'ordered_list' => 'Нумеричка листа',
            'redo' => 'Редо',
            'strike' => 'Пречкртано',
            'table' => 'Табела',
            'undo' => 'Ундо',
        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'Додади :label',
            ],

            'delete' => [
                'label' => 'Избриши',
            ],

            'clone' => [
                'label' => 'Клонирај',
            ],

            'reorder' => [
                'label' => 'Помеси',
            ],

            'move_down' => [
                'label' => 'Помести надолу',
            ],

            'move_up' => [
                'label' => 'Помести нагоре',
            ],

            'collapse' => [
                'label' => 'Затвори',
            ],

            'expand' => [
                'label' => 'Отвори',
            ],

            'collapse_all' => [
                'label' => 'Затвори се',
            ],

            'expand_all' => [
                'label' => 'Отвори се',
            ],

        ],

    ],

    'rich_editor' => [

        'dialogs' => [

            'link' => [

                'actions' => [
                    'link' => 'Поврзи',
                    'unlink' => 'Одврзи',
                ],

                'label' => 'URL',

                'placeholder' => 'Внеси URL',

            ],

        ],

        'toolbar_buttons' => [
            'attach_files' => 'Прикачи датотеки',
            'blockquote' => 'Цитат',
            'bold' => 'Здевелно',
            'bullet_list' => 'Листа од точки',
            'code_block' => 'Код блок',
            'h1' => 'Наслов',
            'h2' => 'Наслов',
            'h3' => 'Поднаслов',
            'italic' => 'Закосено',
            'link' => 'Линк',
            'ordered_list' => 'Нумеричка листа',
            'redo' => 'Redo',
            'strike' => 'Пречкртано',
            'underline' => 'Потцртано',
            'undo' => 'Undo',
        ],

    ],

    'select' => [

        'actions' => [

            'create_option' => [

                'modal' => [

                    'heading' => 'Креирај',

                    'actions' => [

                        'create' => [
                            'label' => 'Креирај',
                        ],

                        'create_another' => [
                            'label' => 'Креирај и креирај нов',
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'modal' => [

                    'heading' => 'Измени',

                    'actions' => [

                        'save' => [
                            'label' => 'Зачувај',
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'Да',
            'false' => 'Не',
        ],

        'loading_message' => 'Се вчитува...',

        'max_items_message' => 'Само :count можат да бидат селектирани.',

        'no_search_results_message' => 'Нема опции кои што се совпаѓаат со вашето пребарување.',

        'placeholder' => 'Селектирај опција',

        'searching_message' => 'Пребарување...',

        'search_prompt' => 'Почни да пишуваш...',

    ],

    'tags_input' => [
        'placeholder' => 'Нов таг',
    ],

    'wizard' => [

        'actions' => [

            'previous_step' => [
                'label' => 'Назад',
            ],

            'next_step' => [
                'label' => 'Следно',
            ],

        ],

    ],

];
