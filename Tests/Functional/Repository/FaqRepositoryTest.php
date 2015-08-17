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
 * Class FaqRepositoryTest
 * 
 * @package Skyfillers\SfSimpleFaq\Tests\Functional\Repository
 * @author  Stefano Kowalke <s.kowalke@skyfillers.com>
 */
class FaqRepositoryTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager
	 */
	protected $objectManager;

	/** @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository */
	protected $faqRepository;

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
		$this->faqRepository = $this->objectManager->get('SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository');
		$this->importDataSet(__DIR__ . '/../Fixtures/tx_sfsimplefaq_domain_model_faq.xml');
	}

	/**
	 * @test
	 */
	public function findAll() {
		$faqs = $this->faqRepository->findAll();
		$this->assertEquals(5, $faqs->count());
	}

	/**
	 * Test if category restiction works
	 *
	 * @test
	 */
	public function findByDemandNoCategory() {
		$demand = $this->createDemandObjectFromSettings(array(), '', '');
		$categories = $this->faqRepository->findByDemand($demand);
		$this->assertEquals(5, $categories->count());
	}

	/**
	 * Test if category restiction works
	 *
	 * @test
	 */
	public function findByDemandOneCategory() {
		$demand = $this->createDemandObjectFromSettings(array(), '', '5');
		$categories = $this->faqRepository->findByDemand($demand);
		$this->assertEquals(2, $categories->count());
	}

	/**
	 * Test if category restiction works
	 *
	 * @test
	 */
	public function findByDemandTwoCategories() {
		$demand = $this->createDemandObjectFromSettings(array(), '', '4,5,6');
		$categories = $this->faqRepository->findByDemand($demand);
		$this->assertEquals(4, $categories->count());
	}


	/**
	 * Create a demand object with the given settings
	 *
	 * @param array $settings The settings
	 * @param string $searchtext The text, which the FAQs are filtered by
	 * @param string $categories The categories, which the FAQs are filtered by
	 *
	 * @return \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	public function createDemandObjectFromSettings(array $settings, $searchtext, $categories = '0') {
		if ($categories === '0') {
			$categories = $settings['category'];
		}

		/**
		 * Object of the type FaqDemand
		 *
		 * @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
		 */
		$demand = GeneralUtility::makeInstance('SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand');
		$demand->setSearchtext($searchtext);
		$demand->setCategories($categories);

		return $demand;
	}

}

