<?php
$ll = 'LLL:EXT:sf_simple_faq/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title'     => $ll . 'tx_sfsimplefaq_domain_model_faq',
        'label' => 'question',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'question,answer,keywords,category,',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('sf_simple_faq') . 'Resources/Public/Icons/tx_sfsimplefaq_domain_model_faq.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, question, answer, keywords, files, category',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, question, answer;;;richtext:rte_transform[mode=ts_links], keywords, files, category, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_sfsimplefaq_domain_model_faq',
                'foreign_table_where' => 'AND tx_sfsimplefaq_domain_model_faq.pid=###CURRENT_PID### AND tx_sfsimplefaq_domain_model_faq.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'question' => [
            'exclude' => 0,
            'label' => $ll . 'tx_sfsimplefaq_domain_model_faq.question',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim,required'
            ]
        ],
        'answer' => [
            'exclude' => 0,
            'label' => $ll . 'tx_sfsimplefaq_domain_model_faq.answer',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'script' => 'wizard_rte.php',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script'
                    ]
                ]
            ],
        ],
        'keywords' => [
            'exclude' => 0,
            'label' => $ll . 'tx_sfsimplefaq_domain_model_faq.keywords',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'category' => [
            'exclude' => 0,
            'label' => $ll . 'tx_sfsimplefaq_domain_model_faq.category',
            'config' => [
                'type' => 'select',
                'renderMode' => 'tree',
                'treeConfig' => [
                    'parentField' => 'parent',
                    'appearance' => [
                        'expandAll' => true,
                        'allowRecursiveMode' => true,
                        'showHeader' => true,
                        'maxLevels' => 5,
                    ],
                ],
                'MM' => 'tx_sfsimplefaq_faq_category_mm',
                'foreign_table' => 'tx_sfsimplefaq_domain_model_category',
                'foreign_table_where' => ' AND (tx_sfsimplefaq_domain_model_category.sys_language_uid = 0 OR tx_sfsimplefaq_domain_model_category.l10n_parent = 0) ORDER BY tx_sfsimplefaq_domain_model_category.sorting ASC',
                'size' => 10,
                'minitems' => 0,
                'maxitems' => 99,
            ],
        ],
        'files' => [
            'exclude' => 0,
            'label' => $ll . 'tx_sfsimplefaq_domain_model_faq.files',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:media.addFileReference'
                ],
            ], $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ],
    ],
];
