<?php

return [
    "layouts" => [
        'layout_bottom' => 'ვიზუალი ზემოთ, ტექსტი ქვემოთ',
        'layout_top' => 'ვიზუალი ქვემოთ, ტექსტი ზემოთ',
        'layout_left' => 'ვიზუალი მარჯვნივ, ტექსტი მარცხნივ',
        'layout_right' => 'ვიზუალი მარცხნივ, ტექსტი მარჯვნივ'
    ],
    'types' => [
        'image' => [
            'name' => 'ფოტო / ილუსტრაცია / გიფი',
            'columns' => ['image'],
            'layout' => 'disciplinary.sanction.show',
            'listfunc' => function ($item) {
            return '<img src="'.asset("storage/additional/images/min_".$item->image).'" alt="theme" class="table-img">';
            }
        ],
        'video' => [
            'name' => 'ვიდეო',
            'columns' => ['link'],
            'layout' => 'encouragment.show',
            'listfunc' => function ($item) {
                return '<iframe class="table-img" src="'.$item->video.'"></iframe>';
            }
        ],
    ],
    'pages' => [
        'Intro' => 'პირველი გვერდი',
        'Step' => 'ნაბიჯი',
        'Game' => 'სავარჯიშო',
        'Explanation' => 'განმარტება',
        'Discussion' => 'მსჯელობა',
        'Complex' => 'კომპლექსური დავალება'
    ]
];