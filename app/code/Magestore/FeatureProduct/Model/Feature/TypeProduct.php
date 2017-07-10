<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Model\Feature;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class TypeProduct
 * @package Magestore\FeatureProduct\Model\Feature
 */
class TypeProduct implements OptionSourceInterface
{
    const CUSTOM_MANUAL = 1;
    const NEWEST_PRODUCT = 3;
    const BEST_SELLER_PRODUCT = 2;
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Custom Manual'),'value' => self::CUSTOM_MANUAL],
            ['label' => __('Newest Product'),'value' => self::NEWEST_PRODUCT],
            ['label' => __('Best Seller Product'),'value' => self::BEST_SELLER_PRODUCT],
        ];
    }
}
