<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Model\Dto;

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
 * Frequently asked questions
 *
 * @author Daniel Meyer, Alexander Schnoor
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
