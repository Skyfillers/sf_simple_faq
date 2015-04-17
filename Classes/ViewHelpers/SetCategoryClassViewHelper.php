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
 * Class CategoryActiveViewHelper
 *
 * @author Alexander Schnoor
 *
 * @package SKYFILLERS\SfSimpleFaq\ViewHelpers
 */
class SetCategoryClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


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