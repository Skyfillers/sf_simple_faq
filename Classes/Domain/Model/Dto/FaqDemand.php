<?php
namespace Skyfillers\SfSimpleFaq\Domain\Model\Dto;

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
class FaqDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Category
	 *
	 * @var string
	 */
	protected $categories = '0';

	/**
	 * Search text
	 *
	 * @var string
	 */
	protected $searchtext;

	/**
	 * Returns the categories
	 *
	 * @return string
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the category
	 *
	 * @param string $categories The categories to filter the FAQs
	 *
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
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
	 * @param string $searchtext The searchtext to filter the FAQs
	 *
	 * @return void
	 */
	public function setSearchtext($searchtext) {
		$this->searchtext = $searchtext;
	}

}
