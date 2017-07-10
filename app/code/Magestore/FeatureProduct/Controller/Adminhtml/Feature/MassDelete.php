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
class MassDelete extends AbstractMassAction
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
        $feature = 0;
        foreach ($collection as $feature) {
            $feature->delete();
            $feature++;
        }

        if ($feature) {
            $this->messageManager->addSuccessMessage(__('You have deleted %1 Feature.', $feature));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}
