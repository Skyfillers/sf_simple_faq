<?php
namespace SKYFILLERS\SfSimpleFaq\ViewHelpers;

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
 * Class AppendCategoryViewHelper
 *
 * @author Alexander Schnoor
 *
 * @package SKYFILLERS\SfSimpleFaq\ViewHelpers
 */
class AppendCategoryViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param string $selectedCategories
	 * @param string $newCategory
	 *
	 * @return string
	 */
	public function render($selectedCategories, $newCategory) {
		$selected = explode(',', $selectedCategories);


		if (array_search($newCategory, $selected) == FALSE) {
			array_push($selected, (int)$newCategory);
		} else {
			$categoryToDelete = array_search($newCategory, $selected);
			unset($selected[$categoryToDelete]);
		}
		sort($selected);

		return implode(',', $selected);
	}

}