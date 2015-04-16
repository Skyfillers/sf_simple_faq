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
	 * @test
	 */
	public function renderWithResultSelectedWithCurrentCategoryInt() {
		$currentCategory = 4;
		$selectedCategories = '0,2,4,5,6';
		$this->assertSame(
			'class="faq-active-link"',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultSelectedWithCurrentCategoryString() {
		$currentCategory = '4';
		$selectedCategories = '0,2,4,5,6';
		$this->assertSame(
			'class="faq-active-link"',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultNotSelectedWithCurrentCategoryInt() {
		$currentCategory = 3;
		$selectedCategories = '0,2,4,5,6';
		$this->assertSame(
			'',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultNotSelectedWithCurrentCategoryString() {
		$currentCategory = '3';
		$selectedCategories = '0,2,4,5,6';
		$this->assertSame(
			'',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultSelectedWithCurrentCategoryZeroAndInt() {
		$currentCategory = 0;
		$selectedCategories = '0';
		$this->assertSame(
			'class="faq-active-link"',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultSelectedWithCurrentCategoryZeroAndString() {
		$currentCategory = '0';
		$selectedCategories = '0';
		$this->assertSame(
			'class="faq-active-link"',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultNotSelectedWithCurrentCategoryZeroAndIsInt() {
		$currentCategory = 0;
		$selectedCategories = '0,1';
		$this->assertSame(
			'',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}

	/**
	 * @test
	 */
	public function renderWithResultNotSelectedWithCurrentCategoryZeroAndIsString() {
		$currentCategory = '0';
		$selectedCategories = '0,1';
		$this->assertSame(
			'',
			$this->viewhelper->render($currentCategory, $selectedCategories)
		);
	}
}
