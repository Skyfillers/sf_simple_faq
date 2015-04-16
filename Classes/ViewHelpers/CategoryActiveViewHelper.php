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
 * Class CategoryActiveViewHelper
 *
 * @author Alexander Schnoor
 *
 * @package SKYFILLERS\SfSimpleFaq\ViewHelpers
 */
class CategoryActiveViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * Returns The class "faq-active-link"
	 * if $selectedCategories contains $currentCategory
	 *
	 * @param int $currentCategory The Category to check if it's selected
	 * @param string $selectedCategories The
	 *
	 * @return string
	 */
	public function render($currentCategory, $selectedCategories) {

		if ($selectedCategories == '0' && $currentCategory == 0) {
			return 'class="faq-active-link"';
		} elseif ($selectedCategories != '0' && $currentCategory == 0) {
			return '';
		} else {
			$selected = explode(',', $selectedCategories);
			if (in_array($currentCategory, $selected) == TRUE) {
				return 'class="faq-active-link"';
			} else {
				return '';
			}
		}
	}

}