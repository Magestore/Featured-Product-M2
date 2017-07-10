<?php
namespace Magestore\FeatureProduct\Controller\Adminhtml;

/**
 * Class FeatureController
 * @package Magestore\FeatureProduct\Controller\Adminhtml
 */
abstract class FeatureController extends \Magento\Backend\App\Action
{
    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(\Magento\Backend\App\Action\Context $context)
    {
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_FeatureProduct::feature_manage');
    }
}
