<?php
namespace SKYFILLERS\SfSimpleFaq\Controller;

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
 * FaqController
 *
 * @author Daniel Meyer, Alexander Schnoor
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * The FaqRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository
	 * @inject
	 */
	protected $faqRepository = NULL;

	/**
	 * The categoryRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * Create a demand object with the given settings
	 *
	 * @param array $settings The settings
	 * @param string $searchtext The text, which the FAQs are filtered by
	 * @param string $categories The categories, which the FAQs are filtered by
	 *
	 * @return \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	public function createDemandObjectFromSettings(array $settings, $searchtext, $categories = '0') {
		if ($categories === '0') {
			$categories = $settings['category'];
		}

		/**
		 * Object of the type FaqDemand
		 *
		 * @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
		 */
		$demand = $this->objectManager->get('SKYFILLERS\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand');
		$demand->setSearchtext($searchtext);
		$demand->setCategories($categories);

		return $demand;
	}

	/**
	 * List Action
	 *
	 * @param string $selectedCategories The categories to filter the FAQs
	 *
	 * @return void
	 */
	public function listAction($selectedCategories = '0') {
		$demand = $this->createDemandObjectFromSettings($this->settings, '', $selectedCategories);
		$faqs = $this->faqRepository->findDemanded($demand);
		$categories = $this->categoryRepository->findAll();

		$assignArray = array(
			'faqs' => $faqs,
			'categories' => $categories,
			'selectedCategories' => $selectedCategories,
		);
		$this->view->assignMultiple($assignArray);
	}

	/**
	 * Search Action
	 *
	 * @param string $selectedCategories The categories to filter the FAQs
	 * @param string $searchtext The searchtext to filter the FAQs
	 *
	 * @return void
	 */
	public function searchAction($selectedCategories = '0', $searchtext = '') {
		$demand = $this->createDemandObjectFromSettings($this->settings, $searchtext, $selectedCategories);
		$faqs = $this->faqRepository->findDemanded($demand);
		$categories = $this->categoryRepository->findAll();
		$assignArray = array(
			'faqs' => $faqs,
			'categories' => $categories,
			'selectedCategories' => $selectedCategories,
			'searchtext' => $searchtext,
		);
		$this->view->assignMultiple($assignArray);
	}
}