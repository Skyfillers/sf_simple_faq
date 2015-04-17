<?php
namespace SKYFILLERS\SfSimpleFaq\ViewHelpers;

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