<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'SKYFILLERS.' . $_EXTKEY,
	'Pifaq',
	array(
		'Faq' => 'list,search,detail',
	),
	// non-cacheable actions
	array(
		'Faq' => 'search',
	)
);