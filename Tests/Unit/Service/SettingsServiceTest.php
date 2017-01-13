<?php


namespace SKYFILLERS\SfSimpleFaq\Tests\Unit\Service;

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
 * Test case for class \Skyfillers\SfSimpleFaq\Service\SettingsService
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Schreiber <breakpoint@schreibersebastian.de>
 */
class SettingsServiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	
	/**
	 * @var \SKYFILLERS\SfSimpleFaq\Service\SettingsService
	 */
	protected $subject;
	
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface|\PHPUnit_Framework_MockObject_MockObject
	 */
	protected $configurationManager;
	
	/**
	 * @return void
	 */
	protected function setUp()
	{
		$this->subject = new \SKYFILLERS\SfSimpleFaq\Service\SettingsService();
		$this->configurationManager = $this->getMockBuilder('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface')->getMock();
		$this->inject($this->subject, 'configurationManager', $this->configurationManager);
	}
	
	/**
	 * @test
	 */
	public function getConfigurationInConfigurationManagerOnlyCalledOnce()
	{
		$configuration = ['settings' => ['key' => 'value']];
		$this->configurationManager->expects($this->once())->method('getConfiguration')->willReturn($configuration);
		
		$this->subject->getByPath('key');
		$this->subject->getByPath('key');
		$this->subject->getByPath('key');
		$this->subject->getByPath('key');
	}
	
	/**
	 * @test
	 */
	public function getSettingFromSettingsSimple()
	{
		$configuration = ['settings' => ['key' => 'value']];
		$this->configurationManager->expects($this->once())->method('getConfiguration')->willReturn($configuration);
		
		$this->assertEquals('value', $this->subject->getByPath('key'));
	}
	
	/**
	 * @test
	 */
	public function getSettingSimple()
	{
		$configuration = ['key' => 'value'];
		$this->configurationManager->expects($this->once())->method('getConfiguration')->willReturn($configuration);
		
		$this->assertEquals('value', $this->subject->getByPath('key'));
	}
	
	/**
	 * @test
	 */
	public function getSettingWithDots()
	{
		$configuration = ['key' => ['path' => 'value']];
		$this->configurationManager->expects($this->once())->method('getConfiguration')->willReturn($configuration);
		
		$this->assertEquals('value', $this->subject->getByPath('key.path'));
	}
	
	/**
	 * @test
	 */
	public function getSettingFromCache()
	{
		/** @var \SKYFILLERS\SfSimpleFaq\Service\SettingsService|\PHPUnit_Framework_MockObject_MockObject $settingsService */
		$settingsService = $this->getMockBuilder('SKYFILLERS\\SfSimpleFaq\\Service\\SettingsService')->setMethods(['getPropertyPath'])->getMock();
		$settingsService->expects($this->once())->method('getPropertyPath')->willReturn('value');
		
		$configuration = ['settings' => ['key' => 'value']];
		$this->configurationManager->expects($this->once())->method('getConfiguration')->willReturn($configuration);
		$this->inject($settingsService, 'configurationManager', $this->configurationManager);
		
		$settingsService->getByPath('key');
		$settingsService->getByPath('key');
	}
	
}
