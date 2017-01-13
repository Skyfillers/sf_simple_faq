<?php
namespace Skyfillers\SfSimpleFaq\Controller;

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
use Skyfillers\SfSimpleFaq\Domain\Model\Faq;

/**
 * FaqController
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 * @author Jöran Kurschatke <j.kurschatke@skyfillers.com>
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * The FaqRepository
	 *
	 * @var \Skyfillers\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository
	 */
	protected $faqRepository;

	/**
	 * The categoryRepository
	 *
	 * @var \Skyfillers\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository
	 */
	protected $categoryRepository;

	/**
	 * Inject the FAQ repository
	 *
	 * @param \Skyfillers\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository The repository
	 *
	 * @return void
	 */
	public function injectFaqRepository(\Skyfillers\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository) {
		$this->faqRepository = $faqRepository;
	}

	/**
	 * Inject the category repository
	 *
	 * @param \Skyfillers\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository The repository
	 *
	 * @return void
	 */
	public function injectCategoryRepository(\Skyfillers\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		if (isset($this->settings['detailPageUid']) && $this->settings['detailPageUid'] == '') {
			$this->settings['detailPageUid'] = $GLOBALS['TSFE']->id;
		}
		if (isset($this->settings['listPageUid']) && $this->settings['listPageUid'] == '') {
			$this->settings['listPageUid'] = $GLOBALS['TSFE']->id;
		}
	}

	/**
	 * Create a demand object with the given settings
	 *
	 * @param array $settings The settings
	 * @param string $searchtext The text, which the FAQs are filtered by
	 * @param string $categories The categories, which the FAQs are filtered by
	 *
	 * @return \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	public function createDemandObjectFromSettings(array $settings, $searchtext, $categories = '0') {
		if ($categories === '0') {
			$categories = $settings['category'];
		}

		/**
		 * Object of the type FaqDemand
		 *
		 * @var \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
		 */
		$demand = $this->objectManager->get('Skyfillers\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand');
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
		if (empty($searchtext) === TRUE) {
			$faqs = $this->faqRepository->findAll();
		} else {
			$demand = $this->createDemandObjectFromSettings($this->settings, $searchtext, $selectedCategories);
			$faqs = $this->faqRepository->findByDemand($demand);
		}
		$categories = $this->categoryRepository->findAll();
		$assignArray = array(
			'faqs' => $faqs,
			'categories' => $categories,
			'selectedCategories' => $selectedCategories,
			'searchtext' => $searchtext,
		);
		$this->view->assignMultiple($assignArray);
	}

	/**
	 * Detail action
	 *
	 * @param \Skyfillers\SfSimpleFaq\Domain\Model\Faq $faq The faq model
	 * @param string $selectedCategories The selected repository
	 *
	 * @return void
	 */
	public function detailAction(Faq $faq, $selectedCategories) {
		$this->view->assignMultiple(array(
				'faq' => $faq,
				'selectedCategories' => $selectedCategories
			)
		);
	}
}