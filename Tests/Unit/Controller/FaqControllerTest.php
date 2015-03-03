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
		$this->subject = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Controller\\FaqController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFaqsFromRepositoryAndAssignsThemToView() {

		$allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$faqRepository = $this->getMock('SKYFILLERS\\SfSimpleFaq\\Domain\\Repository\\FaqRepository', array('findAll'), array(), '', FALSE);
		$faqRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFaqs));
		$this->inject($this->subject, 'faqRepository', $faqRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('faqs', $allFaqs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
