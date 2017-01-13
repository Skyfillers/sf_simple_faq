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
 * Class AppendCategoryViewHelperTest
 *
 * @author Stefano Kowalke <s.kowalke@skyfillers.com>
 */
class HighlightSearchwordViewHelperTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * Viewhelper
     *
     * @var \Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper
     */
    protected $viewhelper;

    /**
     * Setup
     *
     * @return void
     */
    protected function setUp()
    {
        $this->viewhelper = new \Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper();
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
    public function textForRenderDataProvider()
    {
        return [
            'searchwordExistMultipleTimesInText' => [
                'butt',
                30,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum <span class="faq-search-highlight">butt</span> po kass gelatoo...',
            ],
            'searchwordAtTextStart' => [
                'Flensburg bodaaa',
                16,
                'bodaaa Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                '<span class="faq-search-highlight">bodaaa</span> Minions ipsum b...',
            ],
            'searchwordAtTextEnd' => [
                'bodaaa',
                16,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh bodaaa',
                '...iji jeje uuuhhh <span class="faq-search-highlight">bodaaa</span>',
            ],
            'searchwordWithinTrimAtStartOfText' => [
                'bodaaa',
                16,
                'Minions bodaaa ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions <span class="faq-search-highlight">bodaaa</span> ipsum b...',
            ],
            'searchwordWithinTrimAtStartOfTextSecond' => [
                'bodaaa',
                16,
                'Minions ipsum bodaaa butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum <span class="faq-search-highlight">bodaaa</span> b...',
            ],
            'searchwordMiddleOfText' => [
                'bodaaa',
                16,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                '...oiii la <span class="faq-search-highlight">bodaaa</span> bee do ...',
            ],
            'searchwordNotFound' => [
                'Flensburg',
                16,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum bu...',
            ],
            'trimLongerThanContentSearchWordNotFound' => [
                'Flensburg',
                30,
                'Minions ipsum butt po kass ge',
                'Minions ipsum butt po kass ge',
            ],
            'trimLongerThanContentStart' => [
                'Minions',
                30,
                'Minions ipsum butt po kass',
                '<span class="faq-search-highlight">Minions</span> ipsum butt po kass',
            ],
            'trimLongerThanContentMiddle' => [
                'ipsum',
                30,
                'Minions ipsum butt po kass',
                'Minions <span class="faq-search-highlight">ipsum</span> butt po kass',
            ],
            'trimLongerThanContentEnd' => [
                'kass',
                30,
                'Minions ipsum butt po kass',
                'Minions ipsum butt po <span class="faq-search-highlight">kass</span>',
            ],
            'cropCharIsDecimal' => [
                'bodaaa',
                16.4,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                '...oiii la <span class="faq-search-highlight">bodaaa</span> bee do ...',
            ],
        ];
    }

    /**
     * Data Provider for unit tests
     *
     * @return array
     */
    public function textForRenderWithEmptySearchDataProvider()
    {
        return [
            'emptySearchText' => [
                '',
                16,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
            ],
        ];
    }

    /**
     * Data Provider for unit tests
     *
     * @return array
     */
    public function textForRenderWithoutCroppingDataProvider()
    {
        return [
            'noCroppingSingleHit' => [
                'bodaaa',
                0,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
            ],
            'cropCharIsNegativeSmall' => [
                'bodaaa',
                -1,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
            ],
            'cropCharIsNegativeBig' => [
                'bodaaa',
                -100,
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
            ],
        ];
    }

    /**
     * Data Provider for unit tests
     *
     * @return array
     */
    public function textForRenderWithCropCharIsStringDataProvider()
    {
        return [
            'cropCharIsString' => [
                'bodaaa',
                'Foo',
                'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
                '... oiii la <span class="faq-search-highlight">bodaaa</span> bee do  ...',
            ],
        ];
    }

    /**
     * Test the rendering of this viewhelper
     *
     * @param $searchtext
     * @param $trim
     * @param $text
     * @param string $expected The expected result
     *
     * @test
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @dataProvider textForRenderDataProvider
     * @covers Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
     */
    public function render($searchtext, $trim, $text, $expected)
    {
        $settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', ['getByPath'], [], '', false);

        $settingsServiceMock
            ->expects($this->at(0))
            ->method('getByPath')
            ->with($this->equalTo('trimSign'))
            ->will($this->returnValue('...'));

        $settingsServiceMock
            ->expects($this->at(1))
            ->method('getByPath')
            ->with($this->equalTo('highlightTag'))
            ->will($this->returnValue('<span class="faq-search-highlight">|</span>'));

        $contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', ['stdWrap'], [], '', false);
        $contentObjectRendererMock
            ->expects($this->once())
            ->method('stdWrap')
            ->with($this->equalTo('%s'), $this->equalTo('<span class="faq-search-highlight">|</span>'))
            ->will($this->returnValue('<span class="faq-search-highlight">%s</span>'));

        $this->viewhelper->injectSettingsService($settingsServiceMock);
        $this->viewhelper->injectContentObject($contentObjectRendererMock);

        $actual = $this->viewhelper->render($searchtext, $trim, $text);
        $this->assertSame($expected, $actual);
    }

    /**
     * Test the rendering of this viewhelper
     *
     * @param $searchtext
     * @param $trim
     * @param $text
     * @param string $expected The expected result
     *
     * @test
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @dataProvider textForRenderWithEmptySearchDataProvider
     * @covers Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
     */
    public function renderWithEmptySearch($searchtext, $trim, $text, $expected)
    {
        $settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', ['getByPath'], [], '', false);
        $contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', ['stdWrap'], [], '', false);

        $settingsServiceMock->expects($this->never())->method('getByPath');
        $contentObjectRendererMock->expects($this->never())->method('stdWrap');

        $this->viewhelper->injectSettingsService($settingsServiceMock);
        $this->viewhelper->injectContentObject($contentObjectRendererMock);

        $actual = $this->viewhelper->render($searchtext, $trim, $text);
        $this->assertSame($expected, $actual);
    }

    /**
     * Test the rendering of this viewhelper
     *
     * @param $searchtext
     * @param $trim
     * @param $text
     *
     * @test
     * @expectedException \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @expectedExceptionMessage Setting "cropChars" can not cast to integer. Check your TS or your HighlightViewHelper.
     * @expectedExceptionCode 1439202541
     * @dataProvider textForRenderWithCropCharIsStringDataProvider
     * @covers Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
     */
    public function renderCropCharIsString($searchtext, $trim, $text)
    {
        $this->viewhelper->render($searchtext, $trim, $text);
    }

    /**
     * @param $searchtext
     * @param $trim
     * @param $text
     *
     * @test
     * @expectedException \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @expectedExceptionMessage The TypoScript setting "highlightTag" is not set or empty in your configuration.
     * @expectedExceptionCode 1438950217
     * @dataProvider textForRenderDataProvider
     * @covers Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
     */
    public function renderWithMissingHighlightTagThrowsException($searchtext, $trim, $text)
    {
        $settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', ['getByPath'], [], '', false);
        $settingsServiceMock
            ->expects($this->at(0))
            ->method('getByPath')
            ->with($this->equalTo('trimSign'))
            ->will($this->returnValue('...'));

        $this->viewhelper->injectSettingsService($settingsServiceMock);

        $this->viewhelper->render($searchtext, $trim, $text);
    }

    /**
     * Test the rendering of this viewhelper
     *
     * @param $searchtext
     * @param $trim
     * @param $text
     * @param string $expected The expected result
     *
     * @test
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     * @dataProvider textForRenderWithoutCroppingDataProvider
     * @covers Skyfillers\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
     */
    public function renderWithOutCropping($searchtext, $trim, $text, $expected)
    {
        $settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', ['getByPath'], [], '', false);
        $settingsServiceMock
            ->expects($this->at(0))
            ->method('getByPath')
            ->with($this->equalTo('highlightTag'))
            ->will($this->returnValue('<span class="faq-search-highlight">|</span>'));

        $contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', ['stdWrap'], [], '', false);
        $contentObjectRendererMock
            ->expects($this->once())
            ->method('stdWrap')
            ->with($this->equalTo('%s'), $this->equalTo('<span class="faq-search-highlight">|</span>'))
            ->will($this->returnValue('<span class="faq-search-highlight">%s</span>'));

        $this->viewhelper->injectSettingsService($settingsServiceMock);
        $this->viewhelper->injectContentObject($contentObjectRendererMock);

        $actual = $this->viewhelper->render($searchtext, $trim, $text);
        $this->assertSame($expected, $actual);
    }
}
