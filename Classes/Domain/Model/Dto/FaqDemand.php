<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Model\Dto;


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
class FaqDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Category
	 *
	 * @var int
	 */
	protected $category;

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
