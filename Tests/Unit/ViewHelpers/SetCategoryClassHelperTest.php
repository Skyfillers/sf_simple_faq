<?php
namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\ViewHelpers;

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
 * Class CategoryActiveViewHelperTest
 * @author Alexander Schnoor
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
