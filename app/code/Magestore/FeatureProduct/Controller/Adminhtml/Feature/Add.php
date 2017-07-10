<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Add
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class Add extends \Magento\Backend\App\Action{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
//   / const ADMIN_RESOURCE = 'Magestore_FeatureProduct::feature_save';

    /**
     * Add constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory){
        parent::__construct($context);
        $this->_resultPageFactory=$pageFactory;
    }

    /**
     *
     */
    public function execute(){
        return $this->_forward("edit");
    }
}