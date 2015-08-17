<?php

namespace SKYFILLERS\SfSimpleFaq\Tests\Functional\Repository;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class CategoryRepositoryTest
 * 
 * @package Skyfillers\SfSimpleFaq\Tests\Functional\Repository
 * @author  Stefano Kowalke <s.kowalke@skyfillers.com>
 */
class CategoryRepositoryTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager
	 */
	protected $objectManager;

	/** @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository */
	protected $categoryRepository;


	/** @var array  */
	protected $testExtensionsToLoad = array('typo3conf/ext/sf_simple_faq');
	/**
	 * Injects the ObjectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager
	 * @return void
	 */
	public function injectObjectManager(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * @throws \TYPO3\CMS\Core\Tests\Exception
	 */
	public function setUp() {
		parent::setUp();
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->categoryRepository = $this->objectManager->get('SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository');
		$this->importDataSet(__DIR__ . '/../Fixtures/tx_sfsimplefaq_domain_model_category.xml');
	}

	/**
	 * @test
	 */
	public function findAll() {
		$categories = $this->categoryRepository->findAll();
		$this->assertEquals(3, $categories->count());
	}

}

