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
		$categoryConstraints = array();

		$rawCategories = $demand->getCategories();
		if (strlen($rawCategories) > 1) {
			$categories = explode(',', $rawCategories);
		} else {
			$categories[] = $rawCategories;
		}

		$categoriesLength = count($categories);
		if ($categoriesLength != 0) {
			for ($i = 0; $i < $categoriesLength; $i++) {
				$categoryConstraints[] = $query->contains('category', (string)$categories[$i]);
			}
		}

		$searchConstraints = array();
		if ($demand->getSearchtext()) {
			$searchtextConstraints = array();
			$searchWords = GeneralUtility::trimExplode(' ', $demand->getSearchtext(), TRUE);
			foreach ($searchWords as $searchWord) {
				$searchtextConstraints[] = $query->logicalOr(
					$query->like('question', '%' . $searchWord . '%'),
					$query->like('answer', '%' . $searchWord . '%'),
					$query->like('keywords', '%' . $searchWord . '%')
				);
			}
			if (count($searchtextConstraints) > 0) {
				$searchConstraints[] = $query->logicalOr($searchtextConstraints);
			}
		}

		$categoryConstraintsLength = count($categoryConstraints);
		$searchConstraintsLength = count($searchConstraints);


		$categoryIsAll = FALSE;
		if ($categories[0] == 0 && $categoryConstraintsLength < 2) {
			$categoryIsAll = TRUE;
		}

		if ($categoryConstraintsLength > 0 && $categoryIsAll == FALSE && $searchConstraintsLength > 0) {
			$query->matching(
				$query->logicalAnd(
					$query->logicalOr($categoryConstraints),
					$query->logicalAnd($searchConstraints)
				)
			);
		} elseif ($categoryConstraintsLength > 0 && $categoryIsAll == FALSE) {
			$query->matching(
				$query->logicalOr($categoryConstraints)
			);
		} elseif ($searchConstraintsLength > 0) {
			$query->matching(
				$query->logicalAnd($searchConstraints)
			);
		}

		return $query->execute();
	}
}
