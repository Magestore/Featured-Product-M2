<?php
/**
 * Copyright (c) Magestore
 */
namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;

use Magento\Framework\App\ResponseInterface;

/**
 * Class Save
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class Save extends \Magestore\FeatureProduct\Controller\Adminhtml\FeatureController
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_timezoneInterface;
    /**
     * @var \Magestore\FeatureProduct\Model\FeatureFactory
     */
    protected $_featureFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface
     * @param \Magestore\FeatureProduct\Model\FeatureFactory $featureFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
        \Magestore\FeatureProduct\Model\FeatureFactory $featureFactory
    )
    {
        $this->_timezoneInterface = $timezoneInterface;
        $this->_featureFactory = $featureFactory;
        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $featureId = $this->getRequest()->getParam('feature_id');
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if ($featureId){
                $featureModel = $this->_featureFactory->create()->getFeature($featureId);
            }
            else{
                $featureModel = $this->_featureFactory->create();
            }

            $timeStart = $this->_timezoneInterface
                ->date(new \DateTime($data['time_start']))
                ->format('Y-m-d H:i:s');
            $timeEnd = $this->_timezoneInterface
                ->date(new \DateTime($data['time_end']))
                ->format('Y-m-d H:i:s');
            $data['time_start'] = $timeStart;
            $data['time_end'] = $timeEnd;

            $featureModel->setData($data);
//            \Zend_Debug::dump($featureModel->getData()); die;
            try {
                if (isset($data['store_id'])) {
                    $storeIds = implode(',', $data['store_id']);
                    $featureModel->setData('store_id',$storeIds);
                }

                if (isset($data['category_ids'])) {
                    $categoryIds = implode(',', $data['category_ids']);
                    $featureModel->setData('category_ids',$categoryIds);
                }

                if (isset($data['position'])) {
                    $positions = implode(',', $data['position']);
                    $featureModel->setData('position',$positions);
                }
                if (isset($data['in_products'])) {
                    $productIds = preg_replace("/(&)/", ',', $data['in_products']);
                    $featureModel->setData('product_ids',$productIds);
                }

//                \Zend_Debug::dump($featureModel->getData());die;
                $featureModel->save();

            }catch (\Exception $e){
                $this->messageManager->addError($e->getMessage());
                return  $resultRedirect->setPath('*/*/edit', ['id' => $featureModel->getFeatureId()]);
            }
            if ($this->getRequest()->getParam('back') == 'edit') {
                return  $resultRedirect->setPath('*/*/edit', ['id' =>$featureModel->getFeatureId()]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}