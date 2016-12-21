<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Simple FAQ',
	'description' => 'A simple extension for frequently asked questions',
	'category' => 'plugin',
	'author' => 'Skyfillers TYPO3 Team',
	'author_email' => 'typo3@skyfillers.com',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.3.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-6.2.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'autoload' =>
		array(
			'psr-4' =>
				array(
					'SKYFILLERS\\SfSimpleFaq\\' => 'Classes',
				),
		),
	'autoload-dev' =>
		array(
			'psr-4' =>
				array(
					'SKYFILLERS\\SfSimpleFaq\\Tests\\' => 'Tests',
				),
		),
);
