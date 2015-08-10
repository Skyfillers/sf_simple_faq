<?php
namespace SKYFILLERS\SfSimpleFaq\ViewHelpers;

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
use Psr\Log\InvalidArgumentException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidActionNameException;

/**
 * Class HighlightSearchwordViewHelper
 *
 * @author Stefano Kowalke <s.kowalke@skyfillers.com>
 * @package SKYFILLERS\SfSimpleFaq\ViewHelpers
 */
class HighlightSearchwordViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \SKYFILLERS\SfSimpleFaq\Service\SettingsService $settingsService
	 */
	protected $settingsService;

	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * @param \SKYFILLERS\SfSimpleFaq\Service\SettingsService $settingsService
	 *
	 * @return void
	 */
	public function injectSettingsService(\SKYFILLERS\SfSimpleFaq\Service\SettingsService $settingsService) {
		$this->settingsService = $settingsService;
	}

	/**
	 * @param \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject
	 *
	 * @return void
	 */
	public function injectContentObject(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject) {
		$this->contentObject = $contentObject;
	}


	/**
	 * @param string $searchtext
	 * @param int $crop The amount of chars after we crop the text. 0 by default which means no cropping.
	 * @param string $content
	 *
	 * @return string
	 */
	public function render($searchtext, $crop = 0, $content = '') {
		if (is_numeric($crop) === FALSE) {
			$crop = 0;
		}

		if ($content === '') {
			$content = $this->renderChildren();
		}

		$searchWords = GeneralUtility::trimExplode(' ', $searchtext, TRUE);

		if ($crop > 0) {
			$content = $this->crop($content, $searchWords, $crop);
		}
		$content = $this->highlight($content, $searchWords);

		return $content;
	}

	/**
	 * Highlights the searchword
	 *
	 * @param $content
	 * @param array $searchWords
	 *
	 * @return mixed
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 */
	protected function highlight($content, array $searchWords) {
		$rawSearchPattern  = '/%s/i';
		$replacePatternStdWrapConfiguration = $this->settingsService->getByPath('highlightTag');
		if (empty($replacePatternStdWrapConfiguration) === TRUE) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('The TypoScript setting "highlightTag" is not set or empty in your configuration.', 1438950217);
		}

		$rawReplacePattern = $this->contentObject->stdWrap('%s', $replacePatternStdWrapConfiguration);

		foreach ($searchWords as $searchWord) {
			$found = stripos($content, $searchWord);
			if ($found !== FALSE) {
				$searchWord = substr($content, $found, strlen($searchWord));
				$searchPattern = sprintf($rawSearchPattern, $searchWord);
				$content = preg_replace($searchPattern, sprintf($rawReplacePattern, $searchWord), $content);
			}
		}

		return $content;
	}

	/**
	 * @param $content
	 * @param array $searchwords
	 * @param $trim
	 * @return bool|string
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 */
	protected function crop($content, array $searchwords, $trim) {
		$trimSign = $this->settingsService->getByPath('trimSign');
		if (empty($trimSign) === TRUE) {
			$trimSign = '';
		}

		foreach ($searchwords as $searchword) {
			$found = stripos($content, $searchword);
			$searchwordLength = strlen($searchword);
			$searchword = substr($content, $found, $searchwordLength);
			if ($found !== FALSE) {
				$contentArray = explode($searchword, $content);

				$lengthLeftPart = strlen($contentArray[0]);
				$lengthRightPart = strlen($contentArray[1]);

				if ($lengthLeftPart < $trim) {
					$length = $trim - $lengthLeftPart;
					$contentArray[1] = substr($contentArray[1], 0, $length) . ' ' . $trimSign;
				} else if ($lengthRightPart < $trim) {
					$length = $trim - $lengthRightPart;
					$contentArray[0] = $trimSign . ' ' . substr($contentArray[0], -$length);
				} else if ($lengthLeftPart > $trim && $lengthRightPart > $trim) {
					$length = $trim / 2;
					$contentArray[0] = $trimSign . ' ' . substr($contentArray[0], -$length);
					$contentArray[1] = substr($contentArray[1], 0, $length) . ' ' . $trimSign;
				}

				return implode($searchword, $contentArray);
			}
		}

		return '';
	}

}