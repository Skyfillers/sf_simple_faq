<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Model\Dto;

/**
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
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Category
	 *
	 * @var int
	 */
	protected $category = 0;

	/**
	 * Search text
	 *
	 * @var string
	 */
	protected $searchtext;

	/**
	 * Returns the category
	 *
	 * @return int
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param int $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Returns the search text
	 *
	 * @return string
	 */
	public function getSearchtext() {
		return $this->searchtext;
	}

	/**
	 * Sets the search text
	 *
	 * @param string $searchtext
	 * @return void
	 */
	public function setSearchtext($searchtext) {
		$this->searchtext = $searchtext;
	}

}
