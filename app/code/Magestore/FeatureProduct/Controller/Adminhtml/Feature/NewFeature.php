<?php

namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewFeature
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class NewFeature extends \Magestore\FeatureProduct\Controller\Adminhtml\FeatureController
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        return $resultForward->forward('edit');
    }
}
