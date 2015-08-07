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
 * Class AppendCategoryViewHelperTest
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 * @author Jöran Kurschatke <j.kurschatke@skyfillers.com>
 */
class AppendCategoryViewHelperTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * Viewhelper
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\ViewHelpers\AppendCategoryViewHelper
	 */
	protected $viewhelper = NULL;
	/**
	 * Setup
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->viewhelper = new \SKYFILLERS\SfSimpleFaq\ViewHelpers\AppendCategoryViewHelper();
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
	public function appendCategoryClassDataProvider() {
		return array(
			'intSelectedCategoriesContainsNewCategory' => array(
				'0,2,4,6',
				2,
				'0,4,6'
			),
			'intSelectedCategoriesDoesntContainsNewCategory' => array(
				'0,2,4,6',
				3,
				'0,2,3,4,6'
			),
			'stringSelectedCategoriesContainsNewCategory' => array(
				'0,2,4,6',
				'2',
				'0,4,6'
			),
			'stringSelectedCategoriesDoesntContainsNewCategory' => array(
				'0,2,4,6',
				'3',
				'0,2,3,4,6'
			)
		);
	}

	/**
	 * Test the rendering of this viewhelper
	 *
	 * @param string $selectedCategories The selected categories
	 * @param string $newCategory The new category
	 * @param string $expected The expected result
	 *
	 * @test
	 *
	 * @dataProvider appendCategoryClassDataProvider
	 *
	 * @return void
	 */
	public function renderWhenNewCategoryIsInSelectedCategoriesAndInt($selectedCategories, $newCategory, $expected) {
		$actual = $this->viewhelper->render($selectedCategories, $newCategory);
		$this->assertSame($expected, $actual);
	}
}
