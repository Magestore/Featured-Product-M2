<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Model\Feature;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Position
 * @package Magestore\FeatureProduct\Model\Feature
 */
class Position implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Homepage-Content-Top'),'value' => 'cms-page-content-top'],
            ['label' => __('Sidebar-Top-Right'),'value' => 'sidebar-right-top'],
            ['label' => __('Sidebart-Bottom-Right'),'value' => 'sidebar-right-bottom'],
            ['label' => __('Sidebar-Top-Left'),'value' => 'sidebar-left-top'],
            ['label' => __('Sidebar-Bottom-Left'),'value' => 'sidebar-left-bottom'],
            ['label' => __('Content-Top'),'value' => 'content-top'],
            ['label' => __('Menu-Top'),'value' => 'menu-top'],
            ['label' => __('Menu-Bottom'),'value' => 'menu-bottom'],
            ['label' => __('Page-bottom'),'value' => 'page-bottom'],
            ['label' => __('Catalog-Sidebar-Top-Right'),'value' => 'catalog-sidebar-right-top'],
            ['label' => __('Catalog-Sidebar-Bottom-Right'),'value' => 'catalog-sidebar-right-bottom'],
            ['label' => __('Catalog-Sidebar-Top-Left'),'value' => 'catalog-sidebar-left-top'],
            ['label' => __('Catalog-Sidebar-Bottom-Left'),'value' => 'catalog-sidebar-left-bottom'],
            ['label' => __('Catalog-Content-Top'),'value' => 'catalog-content-top'],
            ['label' => __('Catalog-Menu-Top'),'value' => 'catalog-menu-top'],
            ['label' => __('Catalog-Menu-Bottom'),'value' => 'catalog-menu-bottom'],
            ['label' => __('Catalog-Page-bottom'),'value' => 'catalog-page-bottom'],
            ['label' => __('Category-Sidebar-Top-Right'),'value' => 'category-sidebar-right-top'],
            ['label' => __('Category-Sidebar-Bottom-Right'),'value' => 'category-sidebar-right-bottom'],
            ['label' => __('Category-Sidebar-Top-Left'),'value' => 'category-sidebar-left-top'],
            ['label' => __('Category-Sidebar-Bottom-Left'),'value' => 'category-sidebar-left-bottom'],
            ['label' => __('Category-Content-Top'),'value' => 'category-content-top'],
            ['label' => __('Category-Menu-Top'),'value' => 'category-menu-top'],
            ['label' => __('Category-Menu-Bottom'),'value' => 'category-menu-bottom'],
            ['label' => __('Category-Page-Bottom'),'value' => 'category-page-bottom'],
            ['label' => __('Product-Sidebar-Top-Right'),'value' => 'product-sidebar-right-bottom'],
            ['label' => __('Product-Sidebar-Top-Left'),'value' => 'product-sidebar-left-top'],
            ['label' => __('Product-Content-Top'),'value' => 'product-content-top'],
            ['label' => __('Product-Menu-Top'),'value' => 'product-menu-top'],
            ['label' => __('Product-Menu-Bottom'),'value' => 'product-menu-bottom'],
            ['label' => __('Product-Page-Bottom'),'value' => 'product-page-bottom'],
            ['label' => __('Customer-Content-Top'),'value' => 'customer-content-top'],
            ['label' => __('Customer-Siderbar-Main-Top'),'value' => 'customer-sidebar-main-top'],
            ['label' => __('Customer-Siderbar-Main-Bottom'),'value' => 'customer-sidebar-main-bottom'],
            ['label' => __('Cart-Content-Top'),'value' => 'cart-content-top'],
            ['label' => __('Checkout-Content-Top'),'value' => 'checkout-content-top'],
        ];
    }
}
