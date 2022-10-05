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
        '
    ]
);

### IMAGES ###
// Assign allowed image file types
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['uid_local']['config']['appearance']['elementBrowserAllowed'] = 'jpg,jpeg,png';

// Max one image.
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['image']['config'] = [
    'maxitems' => 1
];

// Remove all fields in image.sys_file_reference (title, description)
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['image']['config']['overrideChildTca']['types'][\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE]['showitem'] = '--palette--;;filePalette';

### VIDEO ###
// Assign allowed media file types
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['uid_local']['config']['appearance']['elementBrowserAllowed'] = 'mp4,ogg,webm';

// Remove all fields in assets.sys_file_reference (title, description)
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['assets']['config']['overrideChildTca']['types'][\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO]['showitem'] = '--palette--;;filePalette';

// Make video upload mandatory - and just one.
$GLOBALS['TCA']['tt_content']['types']['ku_internal_media_player']['columnsOverrides']['assets']['config'] = [
    'minitems' => 1,
    'maxitems' => 1
];