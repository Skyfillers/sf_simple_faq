<?php
namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\ViewHelpers;

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
class HighlightSearchwordViewHelperTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * Viewhelper
	 *
	 * @var \SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper
	 */
	protected $viewhelper;

	/**
	 * Setup
	 *
	 * @return void
	 */
	protected function setUp() {
		$this->viewhelper = new \SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper();
	}

	/**
	 * Teardown
	 *
	 * @return void
	 */
	protected function tearDown() {
		unset($this->viewhelper);
	}

	/**
	 * Data Provider for unit tests
	 *
	 * @return array
	 */
	public function textForRenderDataProvider() {
		return array(
			'searchwordAtTextStart' => array(
				'Flensburg bodaaa',
				16,
				'bodaaa Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'<span class="faq-search-highlight">bodaaa</span> Minions ipsum b ...',
			),
			'searchwordAtTextEnd' => array(
				'bodaaa',
				16,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh bodaaa',
				'... iji jeje uuuhhh <span class="faq-search-highlight">bodaaa</span>',
			),
			'searchwordWithinTrimAtStartOfText' => array(
				'bodaaa',
				16,
				'Minions bodaaa ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions <span class="faq-search-highlight">bodaaa</span> ipsum b ...',
			),
			'searchwordWithinTrimAtStartOfTextSecond' => array(
				'bodaaa',
				16,
				'Minions ipsum bodaaa butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la . Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum <span class="faq-search-highlight">bodaaa</span> b ...',
			),
			'searchwordMiddleOfText' => array(
				'bodaaa',
				16,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'... oiii la <span class="faq-search-highlight">bodaaa</span> bee do  ...',
			),
			'searchwordNotFound' => array(
				'Flensburg',
				16,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum bu ...',
			),
			'trimLongerThanContentSearchWordNotFound' => array(
				'Flensburg',
				30,
				'Minions ipsum butt po kass ge',
				'Minions ipsum butt po kass ge ',
			),
			'trimLongerThanContentStart' => array(
				'Minions',
				30,
				'Minions ipsum butt po kass',
				'<span class="faq-search-highlight">Minions</span> ipsum butt po kass ',
			),
			'trimLongerThanContentMiddle' => array(
				'ipsum',
				30,
				'Minions ipsum butt po kass',
				'Minions <span class="faq-search-highlight">ipsum</span> butt po kass ',
			),
			'trimLongerThanContentEnd' => array(
				'kass',
				30,
				'Minions ipsum butt po kass',
				'Minions ipsum butt po <span class="faq-search-highlight">kass</span> ',
			),
			'cropCharIsDecimal' => array(
				'bodaaa',
				16.4,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'... oiii la <span class="faq-search-highlight">bodaaa</span> bee do  ...',
			),
		);
	}

	/**
	 * Data Provider for unit tests
	 *
	 * @return array
	 */
	public function textForRenderWithEmptySearchDataProvider() {
		return array(
			'emptySearchText' => array(
				'',
				16,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
			),
		);
	}

	/**
	 * Data Provider for unit tests
	 *
	 * @return array
	 */
	public function textForRenderWithoutCroppingDataProvider() {
		return array(
			'noCroppingSingleHit' => array(
				'bodaaa',
				0,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
			),
			'cropCharIsNegativeSmall' => array(
				'bodaaa',
				-1,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
			),
			'cropCharIsNegativeBig' => array(
				'bodaaa',
				-100,
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la <span class="faq-search-highlight">bodaaa</span> bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
			),
		);
	}

	/**
	 * Data Provider for unit tests
	 *
	 * @return array
	 */
	public function textForRenderWithCropCharIsStringDataProvider() {
		return array(
			'cropCharIsString' => array(
				'bodaaa',
				'Foo',
				'Minions ipsum butt po kass gelatooo la belloo! Butt aaaaaah chasy bee do bee do bee do aaaaaah bananaaaa chasy baboiii la. Belloo! bee do bee do bee do para tú chasy tank yuuu! Potatoooo ti aamoo! Po kass butt wiiiii potatoooo poulet tikka masala para tú tatata bala tu hana dul sae. Baboiii la bodaaa bee do bee do bee do tank yuuu! Aaaaaah jiji hahaha. Tank yuuu! bananaaaa aaaaaah po kass bappleees tulaliloo me want bananaaa! Tatata bala tu belloo! Me want bananaaa! bappleees daa uuuhhh belloo! Poopayee gelatooo chasy bananaaaa. Daa hana dul sae po kass butt jiji jeje uuuhhh.',
				'... oiii la <span class="faq-search-highlight">bodaaa</span> bee do  ...',
			),
		);
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
	 * @covers SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
	 */
	public function render($searchtext, $trim, $text, $expected) {
		$settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', array('getByPath'), array(), '', FALSE);

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

		$contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', array('stdWrap'), array(), '', FALSE);
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
	 * @covers SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
	 */
	public function renderWithEmptySearch($searchtext, $trim, $text, $expected) {
		$settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', array('getByPath'), array(), '', FALSE);
		$contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', array('stdWrap'), array(), '', FALSE);

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
	 * @covers SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
	 */
	public function renderCropCharIsString($searchtext, $trim, $text) {
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
	 * @covers SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
	 */
	public function renderWithMissingHighlightTagThrowsException($searchtext, $trim, $text) {
		$settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', array('getByPath'), array(), '', FALSE);
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
	 * @covers SKYFILLERS\SfSimpleFaq\ViewHelpers\HighlightSearchwordViewHelper::render
	 */
	public function renderWithOutCropping($searchtext, $trim, $text, $expected) {
		$settingsServiceMock = $this->getMock('Skyfillers\SfSimpleFaq\Service\SettingsService', array('getByPath'), array(), '', FALSE);
		$settingsServiceMock
			->expects($this->at(0))
			->method('getByPath')
			->with($this->equalTo('highlightTag'))
			->will($this->returnValue('<span class="faq-search-highlight">|</span>'));

		$contentObjectRendererMock = $this->getMock('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', array('stdWrap'), array(), '', FALSE);
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
