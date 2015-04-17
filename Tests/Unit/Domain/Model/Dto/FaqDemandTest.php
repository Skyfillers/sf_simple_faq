<?php

namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\Domain\Model\Dto;

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
	public function setCategoriesForStringSetsCategories() {
		$this->subject->setCategories('0,3,4,10');
		$this->assertSame(
			'0,3,4,10',
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setCategoriesForEmptyStringSetsCategories() {
		$this->subject->setCategories('');
		$this->assertSame(
			'',
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
