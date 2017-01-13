<?php
namespace Skyfillers\SfSimpleFaq\Tests\Unit\ViewHelpers;

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
 * Class CategoryActiveViewHelperTest
 *
 * @author Alexander Schnoor
 */
class GetCategoryClassViewHelperTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * Viewhelper
     *
     * @var \Skyfillers\SfSimpleFaq\ViewHelpers\GetCategoryClassViewHelper
     */
    protected $viewhelper = null;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        $this->viewhelper = new \Skyfillers\SfSimpleFaq\ViewHelpers\GetCategoryClassViewHelper();
    }

    /**
     * Teardown
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->viewhelper);
    }

    /**
     * Data Provider for unit tests
     *
     * @return array
     */
    public function setCategoryClassDataProvider()
    {
        return [
            'emptySettings' => [
                '',
                '',
                ''
            ],
            'intSelectedCategoriesContainsCurrentCategory' => [
                2,
                '0,2,5,7',
                'faq-active-link'
            ],
            'stringSelectedCategoriesContainsCurrentCategory' => [
                '2',
                '0,2,5,7',
                'faq-active-link'
            ],
                'intSelectedCategoriesDoesntContainsCurrentCategory' => [
                3,
                '0,2,5,7',
                ''
            ],
                'stringSelectedCategoriesDoesntContainsCurrentCategory' => [
                '3',
                '0,2,5,7',
                ''
            ],
            'intSelectedCategoriesIsZeroAndCurrentCategoryIsZero' => [
                0,
                '0',
                'faq-active-link'
            ],
            'intSelectedCategoriesIsNotZeroAndCurrentCategoryIsZero' => [
                0,
                '0,2,5,7',
                ''
            ],
            'stringSelectedCategoriesIsZeroAndCurrentCategoryIsZero' => [
                '0',
                '0',
                'faq-active-link'
            ],
            'stringSelectedCategoriesIsNotZeroAndCurrentCategoryIsZero' => [
                '0',
                '0,2,5,7',
                ''
            ]
        ];
    }

    /**
     * Test the rendering
     *
     * @param int $currentCategory The Category to check if it's selected
     * @param string $selectedCategories The selected categories
     * @param string $expected The expected result
     *
     * @test
     *
     * @dataProvider setCategoryClassDataProvider
     *
     * @return void
     */
    public function renderWithResultSelectedWithCurrentCategoryInt($currentCategory, $selectedCategories, $expected)
    {
        $actual = $this->viewhelper->render($currentCategory, $selectedCategories);
        $this->assertSame($expected, $actual);
    }
}
