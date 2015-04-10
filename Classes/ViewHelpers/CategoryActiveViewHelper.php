<?php
namespace SKYFILLERS\SfSimpleFaq\ViewHelpers;


/**
 * Class CategoryActiveViewHelper
 *
 * @package SKYFILLERS\SfSimpleFaq\ViewHelpers
 */
class CategoryActiveViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


    /**
     * @param int $categoryUid
     * @param string $categoryString
     * @return string
     */
    public function render($categoryUid ,$categoryString) {

        if(strpos($categoryString, (string)$categoryUid) !== false) {
            return 'ausgewählt';
        }else {
            return 'nicht ausgewählt';
        }
    }

}