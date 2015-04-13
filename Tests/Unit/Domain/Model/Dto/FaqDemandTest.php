<?php

namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\Domain\Model\Dto;

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
 * Test case for class \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqDemandTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	protected $subject = NULL;

	/**
	 * setup
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->subject = new \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
	}

	/**
	 * teardown
	 *
	 * @return void
	 */
	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getCategoryReturnsInitialValueForInteger() {
		$this->assertSame(
			'0',
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setCategoryForIntegerSetsCategory() {
		$this->subject->setCategories(1);
		$this->assertSame(
			1,
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getSearchtextForStringSetsSearchtext() {
		$this->subject->setSearchtext('test');
		$this->assertEquals(
			'test',
			$this->subject->getSearchtext()
		);
	}

}
