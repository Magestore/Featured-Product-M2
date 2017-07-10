<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;

/**
 * Class ProductGrid
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class ProductGrid extends \Magestore\FeatureProduct\Controller\Adminhtml\FeatureController
{
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        $this->_resultLayoutFactory = $resultLayoutFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        $resultLayout->getLayout()->getBlock('feature.edit.tab.productlist')
            ->setProductsVendor($this->getRequest()->getPost('products_feature', null));
        return $resultLayout;
    }
}
