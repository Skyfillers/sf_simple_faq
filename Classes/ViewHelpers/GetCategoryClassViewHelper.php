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
 * Class GetCategoryClassViewHelper
 *
 * @author Alexander Schnoor
 */
class GetCategoryClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * Returns The class "faq-active-link"
	 * if $selectedCategories contains $currentCategory
	 *
	 * @param int $currentCategory The Category to check if it's selected
	 * @param string $selectedCategories The selected categories
	 *
	 * @return string
	 */
	public function render($currentCategory, $selectedCategories) {
		$return = '';
		if ($selectedCategories === '0' && (int)$currentCategory === 0) {
			$return = 'faq-active-link';
		} elseif ($selectedCategories !== '0' && (int)$currentCategory !== 0) {
			$selected = explode(',', $selectedCategories);
			if (in_array($currentCategory, $selected) === TRUE) {
				$return = 'faq-active-link';
			}
		}
		return $return;
	}

}