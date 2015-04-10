<?php
namespace SKYFILLERS\SfSimpleFaq\Controller;


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
 * FaqController
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * faqRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository
	 * @inject
	 */
	protected $faqRepository = NULL;

	/**
	 * categoryRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

    /**
     * filterFagHelper
     *
     * @var \SKYFILLERS\SfSimpleFaq\Helper\FilterFaqHelper
     * @inject
     */
    protected $filterFagHelper = NULL;

	/**
	 * Create a demand object with the given settings
     *
	 * @param array $settings
	 * @param string $category
	 * @param string $searchText
	 * @return \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	public function createDemandObjectFromSettings($settings, $searchText, $category = '0') {
		if ($category === '0') {
			$category = $settings['category'];
		}

		/** @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand */
		$demand = $this->objectManager->get('SKYFILLERS\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand');
		$demand->setSearchText($searchText);
		$demand->setCategory($category);

		return $demand;
	}

	/**
	 * action list
	 *
	 * @param string $selectedCategories
	 * @param string $actualCategory
     * @param string $searchText
	 * @return void
	 */
	public function listAction($selectedCategories = '0', $actualCategory = '0', $searchText = '') {

        $categories = $this->categoryRepository->findAll();

        /** @var \SKYFILLERS\SfSimpleFaq\Helper\FilterFaqHelper $filterFagHelper */
        $this->filterFagHelper = $this->objectManager->get('SKYFILLERS\\SfSimpleFaq\\Helper\\FilterFaqHelper');
        $selectedCategories = $this->filterFagHelper->buildFilterArray($selectedCategories, $actualCategory);

        $demand = $this->createDemandObjectFromSettings($this->settings, $searchText, $selectedCategories);
		$faqs = $this->faqRepository->findDemanded($demand);

        $assignArray = array(
            'faqs' => $faqs,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
            'searchText' => $searchText,
            'actualCategory' => $actualCategory,
        );
        $this->view->assignMultiple($assignArray);
	}

}
