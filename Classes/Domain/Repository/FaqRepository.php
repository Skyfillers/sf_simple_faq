<?php
namespace Skyfillers\SfSimpleFaq\Domain\Repository;

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

use Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The repository for Faqs
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 * @author Jöran Kurschatke <j.kurschatke@skyfillers.com>
 */
class FaqRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * The categories
     * @var array
     */
    protected $categories = [];

    /**
     * The category constraints
     * @var array
     */
    protected $categoryConstraints = [];

    /**
     * The category constrains length
     * @var int
     */
    protected $categoryConstraintsLength = 0;

    /**
     * The categories length
     * @var int
     */
    protected $categoriesLength = 0;

    /**
     * The search constraints
     * @var array
     */
    protected $searchConstraints = [];

    /**
     * The search constraints length
     * @var int
     */
    protected $searchConstraintsLength = 0;

    /**
     * If all categories are selected
     * @var boolean $categoryIsAll
     */
    protected $categoryIsAll = false;

    /**
     * The query
     * @var \TYPO3\CMS\Extbase\Persistence\QueryInterface
     */
    protected $query = null;

    /**
     * Generates the necessary category settings.
     *
     * @param \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand
     *
     * @return void
     */
    protected function generateCategories(\Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand)
    {
        $categories = $demand->getCategories();
        if (strlen($categories) > 1) {
            $categories = explode(',', $categories);
        }

        $this->categoriesLength = count($categories);
        if ($this->categoriesLength != 0) {
            for ($i = 0; $i < $this->categoriesLength; $i++) {
                array_push($this->categoryConstraints, $this->query->contains('category', (string)$categories[$i]));
            }
        }

        $this->categoryConstraintsLength = count($this->categoryConstraints);
        if ($categories[0] == 0 && $this->categoryConstraintsLength < 2) {
            $this->categoryIsAll = true;
        }
    }

    /**
     * Generates the necessary search settings.
     *
     * @param \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand object
     *
     * @return void
     */
    protected function generateSearchConstraints(\Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand)
    {
        if ($demand->getSearchtext()) {
            $searchtextConstraints = [];
            $searchWords = GeneralUtility::trimExplode(' ', $demand->getSearchtext(), true);

            foreach ($searchWords as $searchWord) {
                $searchtextConstraints[] = $this->query->logicalOr(
                    $this->query->like('question', '%' . $searchWord . '%'),
                    $this->query->like('answer', '%' . $searchWord . '%'),
                    $this->query->like('keywords', '%' . $searchWord . '%')
                );
            }
            if (count($searchtextConstraints) > 0) {
                $this->searchConstraints[] = $this->query->logicalOr($searchtextConstraints);
            }
        }
        $this->searchConstraintsLength = count($this->searchConstraints);
    }

    /**
     * Builds the query
     * @return void
     */
    protected function buildQuery()
    {
        if ($this->categoryConstraintsLength > 0 && $this->categoryIsAll === false && $this->searchConstraintsLength > 0) {
            $this->query->matching(
                $this->query->logicalAnd(
                    $this->query->logicalOr($this->categoryConstraints),
                    $this->query->logicalAnd($this->searchConstraints)
                )
            );
        } elseif ($this->categoryConstraintsLength > 0 && $this->categoryIsAll === false) {
            $this->query->matching(
                $this->query->logicalOr($this->categoryConstraints)
            );
        } elseif ($this->searchConstraintsLength > 0) {
            $this->query->matching(
                $this->query->logicalAnd($this->searchConstraints)
            );
        }
    }

    /**
     * Returns the objects of this repository matching the given demand
     *
     * @param \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand $demand A demand
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByDemand(FaqDemand $demand)
    {
        $this->query = $this->createQuery();

        $this->generateCategories($demand);
        $this->generateSearchConstraints($demand);

        $this->buildQuery();
        return $this->query->execute();
    }
}
