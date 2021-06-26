<?php

return [
    'image' => [
        'name' => 'ფოტო',
        'columns' => ['image'],
        'layout' => 'disciplinary.sanction.show',
        'cardlayout' => 'web.frontend.sections.additionalResource.image-card',
        'listfunc' => function ($item) {
           return '<img src="'.asset("storage/additional/images/min_".$item->image).'" alt="theme" class="table-img">';
        }
    ],
    'video' => [
        'name' => 'ვიდეო',
        'columns' => ['link'],
        'layout' => 'encouragment.show',
        'cardlayout' => 'web.frontend.sections.additionalResource.video-card',
        'listfunc' => function ($item) {
            return '<iframe class="table-img" src="'.$item->video.'"></iframe>';
        }
    ],
    'link' => [
        'name' => 'ლინკი',
        'columns' => ['image', 'link'],
        'layout' => 'salary.change.show',
        'cardlayout' => 'web.frontend.sections.additionalResource.link-card',
        'listfunc' => function ($item) {
            return '<a href="'.$item->link.'" target="_blank" rel="noopener noreferrer">'.$item->link.'</a>';
         }
    ],
    'pdf' => [
        'name' => 'pdf ფაილი',
        'columns' => ['image', 'pdf'],
        'layout' => 'position.change.show',
        'cardlayout' => 'web.frontend.sections.additionalResource.pdf-card',
        'listfunc' => function ($item) {
            return '<a href="'.asset("storage/additional/files/".$item->pdf).'" target="_blank" rel="noopener noreferrer">'.$item->pdf.'</a>';
         }
    ]    
];
