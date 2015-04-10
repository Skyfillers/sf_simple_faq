<?php
namespace SKYFILLERS\SfSimpleFaq\Helper;

/**
 * Class FilterFaqHelper
 *
 * @package SKYFILLERS\SfSimpleFaq\Helper
 */
class FilterFaqHelper {

    /**
     * Constructor
     */
    public function __construct() {

    }

    /**
     * @param int $selectedCategories
     * @param int $actualCategory
     * @return string
     */
    public function buildFilterArray($selectedCategories, $actualCategory) {
        $selectedCategoriesArray = array();
        if (strlen($selectedCategories) == 1) {
            $selectedCategoriesArray[] = $selectedCategories;
        } else {
            $selectedCategoriesArray = explode(',', $selectedCategories);
        }

        if ($actualCategory != 0) {
            $categorySelected = FALSE;
            for ($i = 0; $i < count($selectedCategoriesArray); $i++) {
                if ($selectedCategoriesArray[$i] == $actualCategory) {
                    $categorySelected = TRUE;
                    unset($selectedCategoriesArray[$i]);
                }
            }

            if ($categorySelected == FALSE) {
                array_push($selectedCategoriesArray, $actualCategory);
            }

            sort($selectedCategoriesArray);
            $selectedCategories = implode(',', $selectedCategoriesArray);
        }

        return $selectedCategories;
    }
}