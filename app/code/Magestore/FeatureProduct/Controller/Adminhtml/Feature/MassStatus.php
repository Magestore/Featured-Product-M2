<?php
namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;

use Magento\Backend\App\Action\Context;
use Magestore\FeatureProduct\Model\ResourceModel\Feature\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Magestore\FeatureProduct\Model\ResourceModel\Feature\Collection;

/**
 * Class MassStatus
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class MassStatus extends AbstractMassAction
{

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $filter, $collectionFactory);
    }


    /**
     * @param Collection $collection
     * @return \Magento\Framework\Controller\ResultInterface
     */
    protected function massAction(Collection $collection)
    {
        $featureChangeStatus = 0;
        foreach ($collection as $feature) {
            $feature->setStatus($this->getRequest()->getParam('status'))->save();
            $featureChangeStatus++;
        }

        if ($featureChangeStatus) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) were updated.', $featureChangeStatus));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}
