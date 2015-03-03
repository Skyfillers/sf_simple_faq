<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Daniel Meyer <d.meyer@skyfillers.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Frequently asked questions
 */
class Faq extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Question
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $question = '';

	/**
	 * Answer
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $answer = '';

	/**
	 * Additional search keywords
	 *
	 * @var string
	 */
	protected $keywords = '';

	/**
	 * Category
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Category
	 */
	protected $category = NULL;

	/**
	 * Returns the question
	 *
	 * @return string $question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Sets the question
	 *
	 * @param string $question
	 * @return void
	 */
	public function setQuestion($question) {
		$this->question = $question;
	}

	/**
	 * Returns the answer
	 *
	 * @return string $answer
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * Sets the answer
	 *
	 * @param string $answer
	 * @return void
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
	}

	/**
	 * Returns the keywords
	 *
	 * @return string $keywords
	 */
	public function getKeywords() {
		return $this->keywords;
	}

	/**
	 * Sets the keywords
	 *
	 * @param string $keywords
	 * @return void
	 */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	/**
	 * Returns the category
	 *
	 * @return \SKYFILLERS\SfSimpleFaq\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\SKYFILLERS\SfSimpleFaq\Domain\Model\Category $category) {
		$this->category = $category;
	}

}