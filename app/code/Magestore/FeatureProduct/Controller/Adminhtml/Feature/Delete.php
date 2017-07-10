<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_FeatureProduct
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;

/**
 * Class Delete
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class Delete extends \Magestore\FeatureProduct\Controller\Adminhtml\FeatureController
{
    /**
     * @return $this
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $featureId = $this->getRequest()->getParam('id');
        if ($featureId > 0) {
            $feature = $this->_objectManager->create('Magestore\FeatureProduct\Model\Feature')
                ->load($featureId);
            try {
                $feature->delete();
                $this->messageManager->addSuccess(__('Feature was successfully deleted'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
