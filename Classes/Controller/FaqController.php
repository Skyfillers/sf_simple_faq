<?php
namespace SKYFILLERS\SfSimpleFaq\Controller;

/**
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
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * faqRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\FaqRepository $faqRepository
	 */
	protected $faqRepository = NULL;

	/**
	 * categoryRepository
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\Domain\Repository\CategoryRepository $categoryRepository
	 */
	protected $categoryRepository = NULL;

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
	 * @param array $settings
	 * @param int $category
	 * @param string $searchtext
	 * @return \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand
	 */
	public function createDemandObjectFromSettings($settings, $searchtext, $category = 0) {
		if ($category === 0) {
			$category = $settings['category'];
		}
		/** @var \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand */
		$demand = $this->objectManager->get('SKYFILLERS\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand');
		$demand->setSearchtext($searchtext);
		$demand->setCategory($category);

		return $demand;
	}

	/**
	 * action list
	 *
	 * @param int $category
	 * @param string $searchtext
	 * @return void
	 */
	public function listAction($category = 0, $searchtext = '') {
		$demand = $this->createDemandObjectFromSettings($this->settings, $searchtext, $category);
		$faqs = $this->faqRepository->findDemanded($demand);
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('faqs', $faqs);
		$this->view->assign('categories', $categories);
		$this->view->assign('selectedCategory', $category);
		$this->view->assign('searchtext', $searchtext);
	}

}
