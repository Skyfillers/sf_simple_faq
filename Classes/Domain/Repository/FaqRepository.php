<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Repository;

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

use SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * The repository for Faqs
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 * @author Jöran Kurschatke <j.kurschatke@skyfillers.com>
 */
class FaqRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var bool $isAllCategories
	 */
	protected $isAllCategories;

	/**
	 * @return mixed
	 */
	public function isAllCategories() {
		return $this->isAllCategories;
	}

	/**
	 * @param mixed $isAllCategories
	 */
	public function setIsAllCategories($isAllCategories) {
		$this->isAllCategories = $isAllCategories;
	}

	/**
	 * Returns the objects of this repository matching the given demand
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByDemand(FaqDemand $demand) {
		return $this->buildQuery($demand)->execute();
	}

	/**
	 * Builds the query
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface
	 */
	protected function buildQuery($demand) {
		$query = $this->createQuery();

		$categoryConstraints = $this->generateCategoryConstraints($demand, $query);
		$searchConstraints = $this->generateSearchConstraints($demand, $query);

		$categoryConstraintsLength = count($categoryConstraints);
		$searchConstraintsLength = count($searchConstraints);

		if ($categoryConstraintsLength > 0 && $searchConstraintsLength > 0 && $this->isAllCategories() === FALSE) {
			$query->matching(
				$query->logicalAnd(
					$query->logicalOr($categoryConstraints),
					$query->logicalAnd($searchConstraints)
				)
			);
		} elseif ($categoryConstraintsLength > 0 && $this->isAllCategories() === FALSE) {
			$query->matching(
				$query->logicalOr($categoryConstraints)
			);
		} elseif ($searchConstraintsLength > 0) {
			$query->matching(
				$query->logicalAnd($searchConstraints)
			);
		}

		return $query;
	}

	/**
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 *
	 * @return array
	 */
	protected function generateCategoryConstraints($demand, $query) {
		$categories = GeneralUtility::trimExplode(',', $demand->getCategories());
		$categoryConstraints = array();

		foreach ($categories as $category) {
			$categoryConstraints[] = $query->contains('category', $category);
		}

		if ($categories[0] == 0 && count($categoryConstraints) < 2) {
			$this->setIsAllCategories(TRUE);
		} else {
			$this->setIsAllCategories(FALSE);
		}

		return $categoryConstraints;
	}

	/**
	 * Generates the necessary search settings.
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand object
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 *
	 * @return array
	 */
	protected function generateSearchConstraints(FaqDemand $demand, QueryInterface $query) {
		$searchConstraints = array();

		if ($demand->getSearchtext()) {
			$searchTermConstraints = array();
			$searchWords = GeneralUtility::trimExplode(' ', $demand->getSearchtext(), TRUE);

			foreach ($searchWords as $searchWord) {
				$searchTermConstraints[] = $query->logicalOr(
					$query->like('question', '%' . $searchWord . '%'),
					$query->like('answer', '%' . $searchWord . '%'),
					$query->like('keywords', '%' . $searchWord . '%')
				);
			}

			if (count($searchTermConstraints) > 0) {
				$searchConstraints[] = $query->logicalOr($searchTermConstraints);
			}
		}

		return $searchConstraints;
	}
}
