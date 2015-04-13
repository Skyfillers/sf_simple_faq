<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Repository;

/*                                                                        *
 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The repository for Faqs
 *
 * @author Daniel Meyer, Alexander Schnoor
 */
class FaqRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Returns the objects of this repository matching the given demand
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findDemanded(\SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand) {
		$query = $this->createQuery();
		$constraints = array();

		$rawCategories = $demand->getCategories();
		if (strlen($rawCategories) > 1) {
			$categories = explode(',', $rawCategories);
		} else {
			$categories[] = $rawCategories;
		}

		if (count($categories) > 1) {
			foreach ($categories AS $category) {
				$constraints[] = $query->contains('category', $category);
			}
		} else {
			if ($demand->getCategories() > 0) {
				$constraints[] = $query->contains('category', $demand->getCategories());
			}
		}

		if ($demand->getSearchText()) {
			$searchTextConstraints = array();
			$searchWords = GeneralUtility::trimExplode(' ', $demand->getSearchText(), TRUE);
			foreach ($searchWords as $searchWord) {
				$searchTextConstraints[] =
					$query->logicalOr(
						$query->like('question', '%' . $searchWord . '%'),
						$query->like('answer', '%' . $searchWord . '%'),
						$query->like('keywords', '%' . $searchWord . '%')
					);
			}
			if (count($searchTextConstraints) > 0) {
				$constraints[] = $query->logicalAnd($searchTextConstraints);
			}
		}

		if (count($constraints) > 0) {
			$query->matching($query->logicalOr($constraints));
		}

		return $query->execute();
	}
}
