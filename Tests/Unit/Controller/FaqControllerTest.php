<?php
namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Daniel Meyer <d.meyer@skyfillers.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class SKYFILLERS\SfSimpleFaq\Controller\FaqController.
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \SKYFILLERS\SfSimpleFaq\Controller\FaqController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getAccessibleMock('SKYFILLERS\\SfSimpleFaq\\Controller\\FaqController',
			array('redirect', 'forward', 'addFlashMessage', 'createDemandObjectFromSettings'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function createDemandObjectFromSettingsWithoutCategory() {
		$mockController = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Controller\\FaqController',
			array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);

		$settings = array(
			'category' => 10
		);

		$mockDemand = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand',
			array(), array(), '', FALSE);

		$mockDemand->expects($this->at(0))->method('setSearchtext')->with('test');
		$mockDemand->expects($this->at(1))->method('setCategories')->with(10);

		$objectManager = $this->getMock('TYPO3\\CMS\\Extbase\\Object\\ObjectManager',
			array(), array(), '', FALSE);
		$objectManager->expects($this->any())->method('get')->will($this->returnValue($mockDemand));
		$this->inject($mockController, 'objectManager', $objectManager);

		$mockController->createDemandObjectFromSettings($settings, 'test');
	}

	/**
	 * @test
	 * @return void
	 */
	public function createDemandObjectFromSettingsWithCategory() {
		$mockController = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Controller\\FaqController',
			array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);

		$settings = array(
			'category' => 10,
		);

		$mockDemand = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand',
			array(), array(), '', FALSE);

		$mockDemand->expects($this->at(0))->method('setSearchtext')->with('test');
		$mockDemand->expects($this->at(1))->method('setCategories')->with(20);

		$objectManager = $this->getMock('TYPO3\\CMS\\Extbase\\Object\\ObjectManager',
			array(), array(), '', FALSE);
		$objectManager->expects($this->any())->method('get')->will($this->returnValue($mockDemand));
		$this->inject($mockController, 'objectManager', $objectManager);

		$mockController->createDemandObjectFromSettings($settings, 'test', 20);
	}

	/**
	 * @test
	 * @return void
	 */
	public function listActionFetchesAllFaqsFromRepositoryAndAssignsThemToView() {
		$demand = new \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
		$allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);
		$allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);
		$category = '0';
        $actualCategory = '0';
		$searchtext = '';

		$settings = array('settings');
		$this->inject($this->subject, 'settings', $settings);


		$this->subject->expects($this->once())->method('createDemandObjectFromSettings')
			->with($settings)->will($this->returnValue($demand));

		$faqRepository = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Repository\\FaqRepository',
			array('findDemanded'), array(), '', FALSE);
		$faqRepository->expects($this->once())->method('findDemanded')->will($this->returnValue($allFaqs));
		$this->inject($this->subject, 'faqRepository', $faqRepository);

		$categoryRepository = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Repository\\CategoryRepository',
			array('findAll'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCategories));
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->at(0))->method('assign')->with('faqs', $allFaqs);
		$view->expects($this->at(1))->method('assign')->with('categories', $allCategories);
		$view->expects($this->at(2))->method('assign')->with('selectedCategory', $category);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 * @return void
	 */
	public function searchActionFetchesAllFaqsFromRepositoryAndAssignsThemToView() {
		$demand = new \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
		$allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);
		$allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);
		$category = 0;
		$searchtext = '';

		$settings = array('settings');
		$this->inject($this->subject, 'settings', $settings);

		$this->subject->expects($this->once())->method('createDemandObjectFromSettings')
			->with($settings)->will($this->returnValue($demand));

		$faqRepository = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Repository\\FaqRepository',
			array('findDemanded'), array(), '', FALSE);
		$faqRepository->expects($this->once())->method('findDemanded')->will($this->returnValue($allFaqs));
		$this->inject($this->subject, 'faqRepository', $faqRepository);

		$categoryRepository = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Repository\\CategoryRepository',
			array('findAll'), array(), '', FALSE);
		$categoryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCategories));
		$this->inject($this->subject, 'categoryRepository', $categoryRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->at(0))->method('assign')->with('faqs', $allFaqs);
		$view->expects($this->at(1))->method('assign')->with('categories', $allCategories);
		$view->expects($this->at(2))->method('assign')->with('selectedCategory', $category);
		$view->expects($this->at(3))->method('assign')->with('searchtext', $searchtext);
		$this->inject($this->subject, 'view', $view);

		$this->subject->searchAction();
	}
}
