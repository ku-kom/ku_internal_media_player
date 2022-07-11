<?php

/**
 * Icon Registry
 */

defined('TYPO3_MODE') || die();

   return [
       // icon identifier
       'ku_internal_media_player' => [
           'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
           'source' => 'EXT:ku_internal_media_player/Resources/Public/Icons/Extension.svg',
       ],
   ];