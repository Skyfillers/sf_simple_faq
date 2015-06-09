<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Model;

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
 * Frequently asked questions
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
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
	protected $category;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $files;

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
	 * @param string $question The question asked
	 *
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
	 * @param string $answer The answer to the set question
	 *
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
	 * @param string $keywords The keywords
	 *
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
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Category $category A category
	 *
	 * @return void
	 */
	public function setCategory(\SKYFILLERS\SfSimpleFaq\Domain\Model\Category $category) {
		$this->category = $category;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 */
	public function setFiles($files) {
		$this->files = $files;
	}
}