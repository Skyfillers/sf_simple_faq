<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Skyfillers.' . $_EXTKEY,
    'Pifaq',
    [
        'Faq' => 'list,search,detail',
    ],
    // non-cacheable actions
    [
        'Faq' => 'search',
    ]
);
