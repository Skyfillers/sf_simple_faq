<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'sf_simple_faq',
    'Pifaq',
    'Simple FAQ'
);

/* Add Flexform */
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('sf_simple_faq');
$pluginSignature = strtolower($extensionName).'_pifaq';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:sf_simple_faq/Configuration/FlexForms/Flexform_plugin.xml'
);

/* Static TypoScript */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'sf_simple_faq',
    'Configuration/TypoScript',
    'Simple FAQ'
);
