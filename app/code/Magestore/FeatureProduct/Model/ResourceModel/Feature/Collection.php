<?php
namespace Magestore\FeatureProduct\Model\ResourceModel\Feature;

/**
 * Class Collection
 * @package Magestore\FeatureProduct\Model\ResourceModel\Feature
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    /**
     *
     */
    const STATUS_ENABLED = 1;

    /**
     * @var string
     */
    protected $_idFieldName = 'feature_id';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_dateTime;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Report\Bestsellers\Collection
     */
    protected $_salesCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Sales\Model\ResourceModel\Report\Bestsellers\Collection $salesCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Sales\Model\ResourceModel\Report\Bestsellers\Collection $salesCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        $this->_dateTime = $dateTime;
        $this->_storeManager = $storeManager;
        $this->_salesCollectionFactory = $salesCollectionFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager);
    }

    /**
     *
     */
    public function _construct(){
        parent::_construct();
        $this->_init('Magestore\FeatureProduct\Model\Feature', 'Magestore\FeatureProduct\Model\ResourceModel\Feature');
    }

    /**
     * @return $this
     */
    public function getFeatureCollection(){
        $date = $this->_dateTime->gmtDate();
        $storeId = $this->_storeManager->getStore()->getId();
        $featureCollection = $this->addFieldToFilter('status',self::STATUS_ENABLED)
            ->addFieldToFilter('store_id',array('finset'=>array($storeId)))
            ->addFieldToFilter('time_start', ['lteq' => $date])
            ->addFieldToFilter('time_end', ['gteq' => $date]);

        return $featureCollection;
    }

    /**
     * @param integer $qtyProduct
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getBestSellerProductCollection($qtyProduct)
    {
        $bestSellerCollection = $this->_salesCollectionFactory->load();
        $bestSellerCollection->getSelect()->limit($qtyProduct);
        $proIds = [];
        $i = 0;
        foreach ($bestSellerCollection as $bestSeller){
            $proIds[$i] = $bestSeller->getData('product_id');
            $i++;
        }
        $productCollection = $this->_productCollectionFactory->create();
        $productCollection->getSelect()->where('entity_id in (?)',$proIds)->limit($qtyProduct);
        $productCollection->addAttributeToSelect('*');

        return $productCollection;
    }

    /**
     * @param integer $qtyProduct
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getNewestProductCollection($qtyProduct){
        $productCollection = $this->_productCollectionFactory->create();
        $todayDate  = date('Y-m-d', time());
        $productCollection->addAttributeToFilter('news_from_date', array('date' => true, 'to' => $todayDate));
        $productCollection->getSelect()->limit($qtyProduct);
        $productCollection->addAttributeToSelect('*');

        return $productCollection;
    }
}
