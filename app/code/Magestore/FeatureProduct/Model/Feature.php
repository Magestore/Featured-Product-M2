<?php
namespace Magestore\FeatureProduct\Model;

use Magento\Framework\Model\Context;


/**
 * Class Feature
 * @package Magestore\FeatureProduct\Model
 */
class Feature extends \Magento\Framework\Model\AbstractModel
{

    /**
     *
     */
    const CHOOSE_MANUAL = 1;

    /**
     *
     */
    const BESTVALUE_PRODUCT = 2;

    /**
     *
     */
    const NEWEST_PRODUCT = 3;
//    const PRODUCT_DISCOUNTED = 4;
//    const CURRENT_CATEGORY = 5;
//
//    const BEST_VALUE_PRODUCTS = 6;
//    const NEWEST_PRODUCTS = 7;
//    const RANDOM = 8;


    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTimeFactory
     */
    protected $_dateFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * Feature constructor.
     * @param Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Feature $resource
     * @param ResourceModel\Feature\Collection $resourceCollection
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magestore\FeatureProduct\Model\ResourceModel\Feature $resource,
        \Magestore\FeatureProduct\Model\ResourceModel\Feature\Collection $resourceCollection,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_dateFactory = $dateFactory;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }

    /**
     * @param integer $featureId
     * @return $this
     */
    public function getFeature($featureId){
        return $this->load($featureId);
    }

    /**
     * @param integer $featureId
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getFeatureProduct($featureId){
        $featureProduct = $this->load($featureId);
        $productIds = $featureProduct->getProductIds();
        $productIdArray = explode(',', $productIds);
        $product = $this->_productCollectionFactory->create();
        $product->getSelect()->where('entity_id in (?)',$productIdArray);
        $product->addAttributeToSelect('*');

        return $product;
    }

    /**
     * @return $this
     */
    public function beforeSave()
    {
        if (!$this->getId()) {
            $this->setCreatedAt($this->_dateFactory->create()->gmtDate());
        } else {
            $this->setUpdatedAt($this->_dateFactory->create()->gmtDate());
        }

        return parent::beforeSave();
    }
}