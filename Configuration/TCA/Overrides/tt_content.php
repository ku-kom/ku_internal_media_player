<?php

/*
 * This file is part of the package ku_internal_media_player.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player'] = [];
}

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
    // Autoplay toggle button
    'ku_internal_media_player_autoplay' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:autoplay',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '0',
                    1 => '1',
                ],
            ],
            'default' => '1',
        ],
    ],
    // Loop toggle button
    'ku_internal_media_player_loop' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:loop',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '0',
                    1 => '1',
                ],
            ],
            'default' => '1',
        ],
    ],
    // Controls toggle button
    'ku_internal_media_player_controls' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:controls',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '0',
                    1 => '1',
                ],
            ],
            'default' => '0',
        ],
    ],
    // Mute toggle button
    'ku_internal_media_player_mute' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:ku_internal_media_player/Resources/Private/Language/locallang_be.xlf:mute',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '0',
                    1 => '1',
                ],
            ],
            'default' => '1',
        ],
    ],
]);

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player'],
    [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
            assets,image,
            ku_internal_media_player_autoplay,
            ku_internal_media_player_loop,
            ku_internal_media_player_mute,
            ku_internal_media_player_controls,
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
            'image' => [
                'config' => [
                    'minitems' => 0,
                    'maxitems' => 1,
                    'filter' => [
                        0 => [
                            'parameters' => [
                                'allowedFileExtensions' => 'jpg,jpeg,png',
                            ],
                        ],
                    ],
                    'overrideChildTca' => [
                        'columns' => [
                            'uid_local' => [
                                'config' => [
                                    'appearance' => [
                                        'elementBrowserAllowed' => 'jpg,jpeg,png',
                                    ],
                                ],
                            ],
                        ],
                        'types' => [
                            '0' => [
                                'showitem' => '
                                    --palette--;;basicoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    crop,
                                    --palette--;;filePalette'
                            ],
                        ],
                    ],
                ],
            ],
            'assets' => [
                'config' => [
                    'minitems' => 1,
                    'maxitems' => 1,
                    'filter' => [
                        0 => [
                            'parameters' => [
                                'allowedFileExtensions' => 'mp4,ogg,webm',
                            ],
                        ],
                    ],
                    'overrideChildTca' => [
                        'columns' => [
                            'uid_local' => [
                                'config' => [
                                    'appearance' => [
                                        'elementBrowserAllowed' => 'mp4,ogg,webm',
                                    ],
                                ],
                            ],
                        ],
                        'types' => [
                            '0' => [
                                'showitem' => '
                                    --palette--;;basicoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    title,description,
                                    --palette--;;filePalette'
                            ],
                        ],
                    ],
                ],
            ]
        ],
    ]
);
