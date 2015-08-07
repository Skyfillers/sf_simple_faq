<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:tx_sfsimplefaq_domain_model_faq',
		'label' => 'question',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'question,answer,keywords,category,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sf_simple_faq') . 'Resources/Public/Icons/tx_sfsimplefaq_domain_model_faq.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, question, answer, keywords, files, category',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, question, answer;;;richtext:rte_transform[mode=ts_links], keywords, files, category, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_sfsimplefaq_domain_model_faq',
				'foreign_table_where' => 'AND tx_sfsimplefaq_domain_model_faq.pid=###CURRENT_PID### AND tx_sfsimplefaq_domain_model_faq.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'question' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:tx_sfsimplefaq_domain_model_faq.question',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim,required'
			)
		),
		'answer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:tx_sfsimplefaq_domain_model_faq.answer',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
		),
		'keywords' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:tx_sfsimplefaq_domain_model_faq.keywords',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:tx_sfsimplefaq_domain_model_faq.category',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'tree',
				'treeConfig' => array(
					'parentField' => 'parent',
					'appearance' => array(
						'expandAll' => TRUE,
						'allowRecursiveMode' => TRUE,
						'showHeader' => TRUE,
						'maxLevels' => 5,
					),
				),
				'MM' => 'tx_sfsimplefaq_faq_category_mm',
				'foreign_table' => 'tx_sfsimplefaq_domain_model_category',
				'foreign_table_where' => ' AND (tx_sfsimplefaq_domain_model_category.sys_language_uid = 0 OR tx_sfsimplefaq_domain_model_category.l10n_parent = 0) ORDER BY tx_sfsimplefaq_domain_model_category.sorting ASC',
				'size' => 10,
				'minitems' => 0,
				'maxitems' => 99,
			),
		),
		'files' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_simple_faq/Resources/Private/Language/Backend.xlf:file',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference'
				),
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
		),
	),
);