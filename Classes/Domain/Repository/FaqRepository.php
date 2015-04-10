<?php
namespace SKYFILLERS\SfSimpleFaq\Domain\Repository;


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
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The repository for Faqs
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

        $rawCategories = $demand->getCategory();
        if (strlen($rawCategories) > 1) {
            $categories = explode(',', $rawCategories);
        } else {
            $categories[] = $rawCategories;
        }

        if (count($categories)>1) {
            foreach($categories AS $category) {
                $constraints[] = $query->contains('category', $category);
            }
        } else {
            if ($demand->getCategory() > 0) {
                $constraints[] = $query->contains('category', $demand->getCategory());
            }
        }

		if ($demand->getSearchText()) {
			$searchTextConstraints = array();
			$searchWords = GeneralUtility::trimExplode(' ', $demand->getSearchText(), TRUE);
			foreach ($searchWords as $searchWord) {
				$searchTextConstraints[] = $query->logicalOr(
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
