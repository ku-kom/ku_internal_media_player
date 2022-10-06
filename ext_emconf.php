<?php

/**
 * Extension Manager/Repository config file for ext "ku_internal_media_player".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'KU internal media player',
    'description' => 'Plays (and loops) internal media files such as .mp4, .ogg, etc. including only play/pause button.',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'bootstrap_package' => '12.0.0-12.9.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'UniversityOfCopenhagen\\KuInternalMediaPlayer\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Nanna Ellegaard',
    'author_email' => 'nel@adm.ku.dk',
    'author_company' => 'University of Copenhagen',
    'version' => '1.0.5',
];
