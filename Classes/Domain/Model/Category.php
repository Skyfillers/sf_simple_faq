<?php
namespace Skyfillers\SfSimpleFaq\Domain\Model;

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
 * Class Category
 *
 * @package Skyfillers\SfSimpleFaq\Domain\Model\Category
 *
 * @author Alexander Schnoor
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * @var \Skyfillers\SfSimpleFaq\Domain\Model\Category $parent The parent category
     */
    protected $parent;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title The title of the category
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the parent category
     *
     * @return \Skyfillers\SfSimpleFaq\Domain\Model\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent category of this category
     *
     * @param \Skyfillers\SfSimpleFaq\Domain\Model\Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}
