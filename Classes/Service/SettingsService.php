<?php

namespace Skyfillers\SfSimpleFaq\Service;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Stefano Kowalke <s.kowalke@skyfillers.com>, Skyfillers GmbH
 *  (c) 2010 Sebastian Schreiber <me@schreibersebastian.de >
 *  (c) 2010 Georg Ringer <typo3@ringerge.org>
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
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

/**
 * Provide a way to get the configuration just everywhere
 *
 * Example
 * $pluginSettingsService =
 * $this->objectManager->get('Tx_News_Service_SettingsService');
 * t3lib_div::print_array($pluginSettingsService->getSettings());
 *
 * If objectManager is not available:
 * http://forge.typo3.org/projects/typo3v4-mvc/wiki/
 * Dependency_Injection_%28DI%29#Creating-Prototype-Objects-through-the-Object-Manager
 *
 * @author Stefano Kowalke <s.kowalke@skyfillers.com>
 */
class SettingsService implements SingletonInterface {

	/**
	 * @var mixed
	 */
	protected $configuration = null;

    /**
     * @var array
     */
	protected $configurationPathCache = array();

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * Returns the TS configuration
	 *
	 * @return array|mixed
	 */
	public function getConfiguration() {
		if ($this->configuration === NULL) {
			$this->configuration = $this->configurationManager->getConfiguration(
				ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
			);
		}

		return $this->configuration;
	}

	/**
	 * Returns the settings at path $path, which is separated by ".",
	 * e.g. "pages.uid".
	 * "pages.uid" would return $this->settings['pages']['uid'].
	 *
	 * If the path is invalid or no entry is found, false is returned.
	 *
	 * @param string $path
	 * @return mixed
	 */
	public function getByPath($path) {

	    if(isset($this->configurationPathCache[$path])) {
	        return $this->configurationPathCache[$path];
        }

		$configuration = $this->getConfiguration();

		$setting = $this->getPropertyPath($configuration, $path);
		if ($setting === NULL) {
			$setting = $this->getPropertyPath($configuration['settings'], $path);
		}

		$this->configurationPathCache[$path] = $setting;

		return $setting;
	}

    /**
     * @param array $configuration
     * @param string $path
     *
     * @return mixed
     */
	protected function getPropertyPath(array $configuration, $path)
    {
        return ObjectAccess::getPropertyPath($configuration, $path);
    }
}
