<?php

namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\Domain\Model;

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
 * Test case for class \SKYFILLERS\SfSimpleFaq\Domain\Model\Faq.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Faq
	 */
	protected $subject = NULL;

	/**
	 * setup
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->subject = new \SKYFILLERS\SfSimpleFaq\Domain\Model\Faq();
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
	public function getQuestionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getQuestion()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setQuestionForStringSetsQuestion() {
		$this->subject->setQuestion('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'question',
			$this->subject
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getAnswerReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswer()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setAnswerForStringSetsAnswer() {
		$this->subject->setAnswer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answer',
			$this->subject
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getKeywordsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getKeywords()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setKeywordsForStringSetsKeywords() {
		$this->subject->setKeywords('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'keywords',
			$this->subject
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function getCategoryReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 * @return void
	 */
	public function setCategoryForCategorySetsCategory() {
		$categoryFixture = new \SKYFILLERS\SfSimpleFaq\Domain\Model\Category();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}
}
