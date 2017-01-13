<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sfsimplefaq_domain_model_category', 'EXT:sf_simple_faq/Resources/Private/Language/locallang_csh_tx_sfsimplefaq_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sfsimplefaq_domain_model_category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_sfsimplefaq_domain_model_faq', 'EXT:sf_simple_faq/Resources/Private/Language/locallang_csh_tx_sfsimplefaq_domain_model_faq.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sfsimplefaq_domain_model_faq');
