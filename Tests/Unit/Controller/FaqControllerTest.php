<?php
namespace Skyfillers\SfSimpleFaq\Tests\Unit\Controller;

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
 * Test case for class Skyfillers\SfSimpleFaq\Controller\FaqController.
 *
 * @author Daniel Meyer <d.meyer@skyfillers.com>
 * @author Jöran Kurschatke <j.kurschatke@skyfillers.com>
 */
class FaqControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * The tested subject
     *
     * @var \Skyfillers\SfSimpleFaq\Controller\FaqController
     */
    protected $subject = null;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        $this->subject = $this->getAccessibleMock(
            'Skyfillers\\SfSimpleFaq\\Controller\\FaqController',
            ['redirect', 'forward', 'addFlashMessage', 'createDemandObjectFromSettings'],
            [],
            '',
            false
        );
    }

    /**
     * Teardown
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * Test: create a demand object from settings without category
     *
     * @test
     */
    public function createDemandObjectFromSettingsWithoutCategory()
    {
        $settings = ['category' => 10];
        $objectManager = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Object\\ObjectManager',
            [],
            [],
            '',
            false
        );
        $mockController = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Controller\\FaqController',
            ['redirect', 'forward', 'addFlashMessage'],
            [],
            '',
            false
        );
        $mockDemand = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand',
            [],
            [],
            '',
            false
        );
        $mockDemand->expects($this->at(0))->method('setSearchtext')->with('test');
        $mockDemand->expects($this->at(1))->method('setCategories')->with(10);
        $objectManager->expects($this->any())->method('get')->will($this->returnValue($mockDemand));
        $this->inject($mockController, 'objectManager', $objectManager);

        $mockController->createDemandObjectFromSettings($settings, 'test');
    }

    /**
     * Test: Create demand object from settings with category
     *
     * @test
     */
    public function createDemandObjectFromSettingsWithCategory()
    {
        $settings = ['category' => 10];
        $objectManager = $this->getMock(
            'TYPO3\\CMS\\Extbase\\Object\\ObjectManager',
            [],
            [],
            '',
            false
        );
        $mockController = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Controller\\FaqController',
            ['redirect', 'forward', 'addFlashMessage'],
            [],
            '',
            false
        );
        $mockDemand = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Model\\Dto\\FaqDemand',
            [],
            [],
            '',
            false
        );
        $mockDemand->expects($this->at(0))->method('setSearchtext')->with('test');
        $mockDemand->expects($this->at(1))->method('setCategories')->with(20);
        $objectManager->expects($this->any())->method('get')->will($this->returnValue($mockDemand));
        $this->inject($mockController, 'objectManager', $objectManager);

        $mockController->createDemandObjectFromSettings($settings, 'test', 20);
    }

    /**
     * Test: List action test with all FAQs
     *
     * @test
     */
    public function listActionFetchesAllFaqsFromRepositoryAndAssignsThemToView()
    {
        $settings = ['settings'];
        $demand = new \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $categoryRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\CategoryRepository',
            ['findAll'],
            [],
            '',
            false
        );
        $faqRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\FaqRepository',
            ['findByDemand', 'findAll'],
            [],
            '',
            false
        );
        $this->subject
            ->expects($this->once())
            ->method('createDemandObjectFromSettings')
            ->with($settings)
            ->will($this->returnValue($demand));

        $faqRepository
            ->expects($this->once())
            ->method('findByDemand')
            ->will($this->returnValue($allFaqs));

        $categoryRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCategories));

        $view
            ->expects($this->once())
            ->method('assignMultiple')
            ->with([
                    'faqs' => $allFaqs,
                    'categories' => $allCategories,
                    'selectedCategories' => 0,
                ]);

        $this->inject($this->subject, 'settings', $settings);
        $this->inject($this->subject, 'faqRepository', $faqRepository);
        $this->inject($this->subject, 'categoryRepository', $categoryRepository);
        $this->inject($this->subject, 'view', $view);
        $this->subject->listAction();
    }

    /**
     * Test: Search action fetches all FAQs
     *
     * @test
     */
    public function searchActionWithSearchtermFetchesAllFaqsFromRepositoryAndAssignsThemToView()
    {
        $searchtext = 'bla';
        $settings = ['settings'];

        $demand = new \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $categoryRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\CategoryRepository',
            ['findAll'],
            [],
            '',
            false
        );
        $faqRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\FaqRepository',
            ['findByDemand', 'findAll'],
            [],
            '',
            false
        );

        $this->subject
            ->expects($this->once())
            ->method('createDemandObjectFromSettings')
            ->with($settings)
            ->will($this->returnValue($demand));

        $categoryRepository
            ->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($allCategories));

        $faqRepository
            ->expects($this->once())
            ->method('findByDemand')
            ->will($this->returnValue($allFaqs));

        $faqRepository
            ->expects($this->never())
            ->method('findAll')
            ->will($this->returnValue($allFaqs));

        $view
            ->expects($this->once())
            ->method('assignMultiple')
            ->with([
                    'faqs' => $allFaqs,
                    'categories' => $allCategories,
                    'selectedCategories' => 0,
                    'searchtext' => $searchtext
                ]);

        $this->inject($this->subject, 'settings', $settings);
        $this->inject($this->subject, 'faqRepository', $faqRepository);
        $this->inject($this->subject, 'categoryRepository', $categoryRepository);
        $this->inject($this->subject, 'view', $view);

        $this->subject->searchAction(0, 'bla');
    }

    /**
     * Test: Search action fetches all FAQs
     *
     * @test
     */
    public function searchActionWithNoSearchtermFetchesAllFaqsFromRepositoryAndAssignsThemToView()
    {
        $searchtext = '';
        $settings = ['settings'];

        $demand = new \Skyfillers\SfSimpleFaq\Domain\Model\Dto\FaqDemand();
        $view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
        $allFaqs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $allCategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', [], [], '', false);
        $categoryRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\CategoryRepository',
            ['findAll'],
            [],
            '',
            false
        );
        $faqRepository = $this->getMock(
            'Skyfillers\\SfSimpleFaq\\Domain\\Repository\\FaqRepository',
            ['findByDemand', 'findAll'],
            [],
            '',
            false
        );

        $this->subject
            ->expects($this->never())
            ->method('createDemandObjectFromSettings')
            ->with($settings)
            ->will($this->returnValue($demand));

        $categoryRepository
            ->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($allCategories));

        $faqRepository
            ->expects($this->never())
            ->method('findByDemand')
            ->will($this->returnValue($allFaqs));

        $faqRepository
            ->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue($allFaqs));

        $view
            ->expects($this->once())
            ->method('assignMultiple')
            ->with([
                    'faqs' => $allFaqs,
                    'categories' => $allCategories,
                    'selectedCategories' => 0,
                    'searchtext' => $searchtext
                ]);

        $this->inject($this->subject, 'settings', $settings);
        $this->inject($this->subject, 'faqRepository', $faqRepository);
        $this->inject($this->subject, 'categoryRepository', $categoryRepository);
        $this->inject($this->subject, 'view', $view);

        $this->subject->searchAction(0, '');
    }
}
