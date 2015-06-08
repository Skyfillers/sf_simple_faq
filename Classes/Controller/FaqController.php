<?php
namespace SKYFILLERS\SfSimpleFaq\Controller;

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
 * FaqController
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * The FaqRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository
	 */
	protected $faqRepository;

	/**
	 * The categoryRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository
	 *
	 * @return void
	 */
	public function injectFaqRepository(\SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository) {
		$this->faqRepository = $faqRepository;
	}

	/**
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository
	 *
	 * @return void
	 */
	public function injectCategoryRepository(\SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

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
	 * List action
	 *
	 * @param string $selectedCategories The categories to filter the FAQs
	 *
	 * @return void
	 */
	public function listAction($selectedCategories = '0') {
		$demand = $this->createDemandObjectFromSettings($this->settings, '', $selectedCategories);
		$faqs = $this->faqRepository->findByDemand($demand);
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
		$faqs = $this->faqRepository->findByDemand($demand);
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