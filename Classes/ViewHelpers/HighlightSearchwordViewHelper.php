<?php
namespace Skyfillers\SfSimpleFaq\ViewHelpers;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class HighlightSearchwordViewHelper
 *
 * @author Stefano Kowalke <s.kowalke@skyfillers.com>
 * @package Skyfillers\SfSimpleFaq\ViewHelpers
 */
class HighlightSearchwordViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @var \Skyfillers\SfSimpleFaq\Service\SettingsService $settingsService
     */
    protected $settingsService;

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected $contentObject;

    /**
     * @param \Skyfillers\SfSimpleFaq\Service\SettingsService $settingsService
     *
     * @return void
     */
    public function injectSettingsService(\Skyfillers\SfSimpleFaq\Service\SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * @param \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject
     *
     * @return void
     */
    public function injectContentObject(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject)
    {
        $this->contentObject = $contentObject;
    }

    /**
     * @param string $searchtext
     * @param int $cropChars
     * @param string $content
     *
     * @return string
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     */
    public function render($searchtext, $cropChars = 0, $content = '')
    {
        if ($content === '') {
            $content = $this->renderChildren();
        }

        if (empty($searchtext) === true) {
            return $content;
        }

        $searchWords = GeneralUtility::trimExplode(' ', $searchtext, true);

        if (is_numeric($cropChars) === false) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Setting "cropChars" can not cast to integer. Check your TS or your HighlightViewHelper.', 1439202541);
        }

        if ($cropChars > 0) {
            $content = $this->crop($content, $searchWords, $cropChars);
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
    protected function highlight($content, array $searchWords)
    {
        $rawSearchPattern  = '/%s/i';
        $replacePatternStdWrapConfiguration = $this->settingsService->getByPath('highlightTag');
        if (empty($replacePatternStdWrapConfiguration) === true) {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('The TypoScript setting "highlightTag" is not set or empty in your configuration.', 1438950217);
        }

        $rawReplacePattern = $this->contentObject->stdWrap('%s', $replacePatternStdWrapConfiguration);

        foreach ($searchWords as $searchWord) {
            $found = stripos($content, $searchWord);
            if ($found !== false) {
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
     * @param $cropChars
     *
     * @return bool|string
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     */
    protected function crop($content, array $searchwords, $cropChars)
    {
        $trimSign = $this->settingsService->getByPath('trimSign');
        if ((empty($trimSign) === true) || ($cropChars > strlen($content))) {
            $trimSign = '';
        }

        foreach ($searchwords as $searchword) {
            $found = stripos($content, $searchword);
            $searchwordLength = strlen($searchword);
            $searchword = substr($content, $found, $searchwordLength);
            if ($found !== false) {
                $contentArray = explode($searchword, $content);

                $lengthLeftPart = strlen($contentArray[0]);
                $lengthRightPart = strlen($contentArray[1]);

                if ($lengthLeftPart < $cropChars) {
                    $length = $cropChars - $lengthLeftPart;
                    $contentArray[1] = substr($contentArray[1], 0, $length) . $trimSign;
                } elseif ($lengthRightPart < $cropChars) {
                    $length = $cropChars - $lengthRightPart;
                    $contentArray[0] = $trimSign . substr($contentArray[0], -$length);
                } elseif ($lengthLeftPart > $cropChars && $lengthRightPart > $cropChars) {
                    $length = $cropChars / 2;
                    $contentArray[0] = $trimSign . substr($contentArray[0], -$length);
                    $contentArray[1] = substr($contentArray[1], 0, $length) . $trimSign;
                }

                if (count($contentArray) > 2) {
                    $contentArray = array_slice($contentArray, 0, 2);
                }

                return implode($searchword, $contentArray);
            }
        }

        return substr($content, 0, $cropChars) . $trimSign;
    }
}
