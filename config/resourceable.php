<?php

return [
    'Intro' => [
        'type' => 'პირველი გვერდი',
        'title' => 'sub_title',
        'route-edit' => 'first_page.edit',
        'layout' => 'web.frontend.sections.topic.pages.intro'
    ],
    'Step' => [
        'type' => 'ნაბიჯი',
        'title' => 'title',
        'icon' => '/img/icons/step.png',
        'route-edit' => 'step_page.edit',
        'layout' => 'web.frontend.sections.topic.pages.step'
    ],
    'Other' => [
        'type' => 'გვერდი',
        'title' => 'title',
        'icon' => [
            'complex' => '/img/icons/complex.png',
            'discussion' => '/img/icons/discussion.png'
        ],
        'route-edit' => 'other_page.edit',
        'layout' => 'web.frontend.sections.topic.pages.other.default',
        'layouts' => [
            'layout_bottom' => 'web.frontend.sections.topic.pages.other.layout_bottom',
            'layout_top' => 'web.frontend.sections.topic.pages.other.layout_top',
            'layout_left' => 'web.frontend.sections.topic.pages.other.layout_left',
            'layout_right' => 'web.frontend.sections.topic.pages.other.layout_right'
        ]
    ],
    'Game' => [
        'type' => 'სავარჯიშო',
        'title' => 'title',
        'icon' => '/img/icons/exercise.png',
        'route-edit' => 'game_page.edit',
        'layout' => 'web.frontend.sections.topic.pages.game'
    ],
    'Explanation' => [
        'type' => 'განმარტება',
        'title' => 'title',
        'icon' => '/img/icons/definition.png',
        'layout' => 'web.frontend.sections.topic.pages.explanation',
        'layouts' => [
            'default' => 'web.frontend.sections.topic.pages.explanation.default',
            'layout_bottom' => 'web.frontend.sections.topic.pages.explanation.layout_bottom',
            'layout_top' => 'web.frontend.sections.topic.pages.explanation.layout_top',
            'layout_left' => 'web.frontend.sections.topic.pages.explanation.layout_left',
            'layout_right' => 'web.frontend.sections.topic.pages.explanation.layout_right'
        ]
    ]
];
