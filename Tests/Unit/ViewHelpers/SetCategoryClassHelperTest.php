<?php
namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\ViewHelpers;

/*                                                                        *
 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Class CategoryActiveViewHelperTest
 *
 * @author Alexander Schnoor
 *
 * @package SKYFILLERS\SfSimpleFaq\Tests\Unit\ViewHelpers
 */

class SetCategoryClassViewHelperTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Viewhelper
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\ViewHelpers\CategoryActiveViewHelper
	 */
	protected $viewhelper = NULL;
	/**
	 * Setup
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->viewhelper = new \SKYFILLERS\SfSimpleFaq\ViewHelpers\SetCategoryClassViewHelper();
	}
	/**
	 * Teardown
	 *
	 * @return void
	 */
	protected function tearDown() {
		unset($this->viewhelper);
	}

	/**
	 * Data Provider for unit tests
	 *
	 * @return array
	 */
	public function setCategoryClassDataProvider() {
		$this->viewhelper = new \SKYFILLERS\SfSimpleFaq\ViewHelpers\SetCategoryClassViewHelper();
		return array(
			'intSelectedCategoriesContainsCurrentCategory' => array(
				2,
				'0,2,5,7',
				'class="faq-active-link"'
			),
			'stringSelectedCategoriesContainsCurrentCategory' => array(
				'2',
				'0,2,5,7',
				'class="faq-active-link"'
			),
				'intSelectedCategoriesDoesntContainsCurrentCategory' => array(
				3,
				'0,2,5,7',
				''
			),
				'stringSelectedCategoriesDoesntContainsCurrentCategory' => array(
				'3',
				'0,2,5,7',
				''
			),
			'intSelectedCategoriesIsZeroAndCurrentCategoryIsZero' => array(
				0,
				'0',
				'class="faq-active-link"'
			),
			'intSelectedCategoriesIsNotZeroAndCurrentCategoryIsZero' => array(
				0,
				'0,2,5,7',
				''
			),
			'stringSelectedCategoriesIsZeroAndCurrentCategoryIsZero' => array(
				'0',
				'0',
				'class="faq-active-link"'
			),
			'stringSelectedCategoriesIsNotZeroAndCurrentCategoryIsZero' => array(
				'0',
				'0,2,5,7',
				''
			)
		);
	}

	/**
	 * @test
	 *
	 * @dataProvider setCategoryClassDataProvider
	 */
	public function renderWithResultSelectedWithCurrentCategoryInt($currentCategory, $selectedCategories, $expected) {
		$actual = $this->viewhelper->render($currentCategory, $selectedCategories);
		$this->assertSame($expected, $actual);
	}
}
