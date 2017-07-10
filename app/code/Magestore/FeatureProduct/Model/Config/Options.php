<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Model\Config;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class Options
 * @package Magestore\FeatureProduct\Model\Config
 */
class Options implements ArrayInterface{
    /**
     *
     */
    const ENABLED = 1;
    /**
     *
     */
    const DISABLED = 2;
    /**
     *
     */
    const SLIDER = 'slide';
    /**
     *
     */
    const GRID = 'grid';
    /**
     *
     */
    const YES = 1;
    /**
     *
     */
    const NO = 0;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * Options constructor.
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     */
    function __construct(
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    )
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(){
        return [
            self::ENABLED => __("Enabled"),
            self::DISABLED => __("Disabled")
        ];
    }

    /**
     * @return array
     */
    public function toOptionDisplayType(){
        return [
            self::GRID => __('Grid'),
            self::SLIDER => __('Slide')
        ];
    }

    /**
     * @return array
     */
    public function toOptionSelect(){
        return [
            self::YES => __('Yes'),
            self::NO => __('No')
        ];
    }

    /**
     * @return array
     */
    public function toOptionPosition(){
        return [
            [
                'label' => __('------- Please choose position -------'),
                'value' => '',
            ],
            [
                'label' => __('Popular positions'),
                'value' => [
                    ['value' => 'cms-page-content-top', 'label' => __('Homepage-Content-Top')],
                ],
            ],
            [
                'label' => __('Default for using in CMS page template'),
                'value' => [
                    ['value' => 'custom', 'label' => __('Custom')],
                ],
            ],
            [
                'label' => __('General (will be disaplyed on all pages)'),
                'value' => [
                    ['value' => 'sidebar-right-top', 'label' => __('Sidebar-Top-Right')],
                    ['value' => 'sidebar-right-bottom', 'label' => __('Sidebar-Bottom-Right')],
                    ['value' => 'sidebar-left-top', 'label' => __('Sidebar-Top-Left')],
                    ['value' => 'sidebar-left-bottom', 'label' => __('Sidebar-Bottom-Left')],
                    ['value' => 'content-top', 'label' => __('Content-Top')],
                    ['value' => 'menu-top', 'label' => __('Menu-Top')],
                    ['value' => 'menu-bottom', 'label' => __('Menu-Bottom')],
                    ['value' => 'page-bottom', 'label' => __('Page-Bottom')],
                ],
            ],
            [
                'label' => __('Catalog and product'),
                'value' => [
                    ['value' => 'catalog-sidebar-right-top', 'label' => __('Catalog-Sidebar-Top-Right')],
                    ['value' => 'catalog-sidebar-right-bottom', 'label' => __('Catalog-Sidebar-Bottom-Right')],
                    ['value' => 'catalog-sidebar-left-top', 'label' => __('Catalog-Sidebar-Top-Left')],
                    ['value' => 'catalog-sidebar-left-bottom', 'label' => __('Catalog-Sidebar-Bottom-Left')],
                    ['value' => 'catalog-content-top', 'label' => __('Catalog-Content-Top')],
                    ['value' => 'catalog-menu-top', 'label' => __('Catalog-Menu-Top')],
                    ['value' => 'catalog-menu-bottom', 'label' => __('Catalog-Menu-Bottom')],
                    ['value' => 'catalog-page-bottom', 'label' => __('Catalog-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Category only'),
                'value' => [
                    ['value' => 'category-sidebar-right-top', 'label' => __('Category-Sidebar-Top-Right')],
                    ['value' => 'category-sidebar-right-bottom', 'label' => __('Category-Sidebar-Bottom-Right')],
                    ['value' => 'category-sidebar-left-top', 'label' => __('Category-Sidebar-Top-Left')],
                    ['value' => 'category-sidebar-left-bottom', 'label' => __('Category-Sidebar-Bottom-Left')],
                    ['value' => 'category-content-top', 'label' => __('Category-Content-Top')],
                    ['value' => 'category-menu-top', 'label' => __('Category-Menu-Top')],
                    ['value' => 'category-menu-bottom', 'label' => __('Category-Menu-Bottom')],
                    ['value' => 'category-page-bottom', 'label' => __('Category-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Product only'),
                'value' => [
                    ['value' => 'product-sidebar-right-top', 'label' => __('Product-Sidebar-Top-Right')],
                    ['value' => 'product-sidebar-right-bottom', 'label' => __('Product-Sidebar-Bottom-Right')],
                    ['value' => 'product-sidebar-left-top', 'label' => __('Product-Sidebar-Top-Left')],
                    ['value' => 'product-content-top', 'label' => __('Product-Content-Top')],
                    ['value' => 'product-menu-top', 'label' => __('Product-Menu-Top')],
                    ['value' => 'product-menu-bottom', 'label' => __('Product-Menu-Bottom')],
                    ['value' => 'product-page-bottom', 'label' => __('Product-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Customer'),
                'value' => [
                    ['value' => 'customer-content-top', 'label' => __('Customer-Content-Top')],
                    ['value' => 'customer-sidebar-main-top', 'label' => __('Customer-Siderbar-Main-Top')],
                    ['value' => 'customer-sidebar-main-bottom', 'label' => __('Customer-Siderbar-Main-Bottom')],
                ],
            ],
            [
                'label' => __('Cart & Checkout'),
                'value' => [
                    ['value' => 'cart-content-top', 'label' => __('Cart-Content-Top')],
                    ['value' => 'checkout-content-top', 'label' => __('Checkout-Content-Top')],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getCategoriesArray()
    {
        $categoriesArray = $this->_categoryCollectionFactory->create()
            ->addAttributeToSelect('name')
            ->addAttributeToSort('path', 'asc')
            ->load()
            ->toArray();

        $categories = array();
        foreach ($categoriesArray as $categoryId => $category) {
            if (isset($category['name']) && isset($category['level'])) {
                $categories[] = array(
                    'label' => $category['name'],
                    'level' => $category['level'],
                    'value' => $categoryId,
                );
            }
        }

        return $categories;
    }
}