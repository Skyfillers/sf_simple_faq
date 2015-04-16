<?php
namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\ViewHelpers;


class AppendCategoryViewHelperTest extends \PHPUnit_Framework_TestCase {
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
	 * @test
	 */
	public function renderWhenNewCategoryIsInSelectedCategoriesAndInt() {
		$selectedCategories = '0,2,4,5,6,8';
		$newCategory = 4;
		$this->assertSame(
			'0,2,5,6,8',
			$this->viewhelper->render($selectedCategories, $newCategory)
		);
	}

	/**
	 * @test
	 */
	public function renderWhenNewCategoryIsInSelectedCategoriesAndString() {
		$selectedCategories = '0,2,4,5,6,8';
		$newCategory = '4';
		$this->assertSame(
			'0,2,5,6,8',
			$this->viewhelper->render($selectedCategories, $newCategory)
		);
	}

	/**
	 * @test
	 */
	public function renderWhenNewCategoryIsNotInSelectedCategoriesAndIsInt() {
		$selectedCategories = '0,2,4,5,6,8';
		$newCategory = 1;
		$this->assertSame(
			'0,1,2,4,5,6,8',
			$this->viewhelper->render($selectedCategories, $newCategory)
		);
	}

	/**
	 * @test
	 */
	public function renderWhenNewCategoryIsNotInSelectedCategoriesAndIsString() {
		$selectedCategories = '0,2,4,5,6,8';
		$newCategory = '1';
		$this->assertSame(
			'0,1,2,4,5,6,8',
			$this->viewhelper->render($selectedCategories, $newCategory)
		);
	}
}
