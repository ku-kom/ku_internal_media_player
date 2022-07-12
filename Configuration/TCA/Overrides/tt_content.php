<?php

/*
 * This file is part of the package ku_internal_media_player.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

// KU internal media player CType select
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
            'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:title',
            'ku_internal_media_player',
            'ku-image-with-overlay-icon',
        ],
    'image',
    'after'
);

// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
//     'ku_internal_media_player_autoplay' => [
//         'exclude' => 0,
//         'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:autoplay',
//         'config' => [
//             'type' => 'check',
//             'renderType' => 'checkboxToggle',
//             'items' => [
//                 [
//                     0 => '0',
//                     1 => '1',
//                     'labelChecked' => 'Enabled',
//                     'labelUnchecked' => 'Disabled',
//                 ],
//             ],
//         ],
//     ],
//     'ku_internal_media_player_loop' => [
//         'exclude' => 0,
//         'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:loop',
//         'config' => [
//             'type' => 'check',
//             'renderType' => 'checkboxToggle',
//             'items' => [
//                 [
//                     0 => '0',
//                     1 => '1',
//                     'labelChecked' => 'Enabled',
//                     'labelUnchecked' => 'Disabled',
//                 ],
//             ],
//         ],
//     ],
// ]);

// KU internal media selector
$ku_internal_media_player = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
        assets,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'assets' => [
            'config' => [
                'filter' => [
                    0 => [
                        'parameters' => [
                            'allowedFileExtensions' => 'mp4,ogg,webm,wav,avi'
                        ]
                    ]
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'uid_local' => [
                            'config' => [
                                'appearance' => [
                                    'elementBrowserAllowed' => 'mp4,ogg,webm,wav,avi'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player'] = $ku_internal_media_player;
