<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Repository;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The repository for Faqs
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class FaqRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Returns the objects of this repository matching the given demand
	 *
	 * @param \SKYFILLERS\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findDemanded($demand) {
		$query = $this->createQuery();
		$constraints = array();

		if ($demand->getCategory() > 0) {
			$constraints[] = $query->equals('category', $demand->getCategory());
		}

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
				$constraints[] = $query->logicalOr($searchtextConstraints);
			}
		}

		if (count($constraints) > 0) {
			$query->matching($query->logicalAnd($constraints));
		}

		return $query->execute();
	}
}
