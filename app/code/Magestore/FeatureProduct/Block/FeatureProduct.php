<?php
namespace Magestore\FeatureProduct\Block;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Element\Template;

/**
 * Class FeatureProduct
 * @package Magestore\FeatureProduct\Block
 */
class FeatureProduct extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /**
     * @var \Magestore\FeatureProduct\Model\Feature
     */
    protected $_featureModel;
    /**
     * @var \Magestore\FeatureProduct\Model\ResourceModel\Feature\CollectionFactory
     */
    protected $_featureCollectionFactory;

    /**
     * @var string
     */
    protected $_position;

    /**
     * @var string
     */
    protected $_categoryPosition;

    /**
     * value status to enable Feature
     */
    const STATUS_ENABLED = 1;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magestore\FeatureProduct\Helper\Config
     */
    protected $_configHelper;

    /**
     * @var integer
     */
    protected $_feature_id_cms;

    /**
     * FeatureProduct constructor.
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magestore\FeatureProduct\Model\Feature $featureModel
     * @param \Magestore\FeatureProduct\Model\ResourceModel\Feature\CollectionFactory $featureCollectionFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magestore\FeatureProduct\Helper\Config $configHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magestore\FeatureProduct\Model\Feature $featureModel,
        \Magestore\FeatureProduct\Model\ResourceModel\Feature\CollectionFactory $featureCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magestore\FeatureProduct\Helper\Config $configHelper,
        array $data
    )
    {
        $this->_featureModel = $featureModel;
        $this->_featureCollectionFactory = $featureCollectionFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_configHelper = $configHelper;
        parent::__construct($context, $data);
    }

    /**
     * @param int $featureId
     * @return \Magestore\FeatureProduct\Model\ResourceModel\Feature\Collection
     */
    public function getFeatureCmsCustom($featureId){
        $featureCollection = $this->_featureCollectionFactory->create()->getFeatureCollection()
            ->addFieldToFilter('position',array('finset'=>array($this->_position)))
            ->addFieldToFilter('feature_id',$featureId);
        return $featureCollection;
    }

    /**
     * @return \Magestore\FeatureProduct\Model\ResourceModel\Feature\Collection
     */
    public function getFeatureCollection(){
        $this->setPositionAfterCategory();
        $featureCollection = $this->_featureCollectionFactory->create()->getFeatureCollection()
            ->addFieldToFilter('position',array('finset'=>array($this->_position)));

        return $featureCollection;
    }


    /**
     * @param integer $featureId
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getFeatureProduct($featureId){
        $product = $this->_featureModel->getFeatureProduct($featureId);
        return $product;
    }

    /**
     * @param integer $qtyProduct
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getBestSellerProductCollection($qtyProduct)
    {
        $productCollection = $this->_featureCollectionFactory->create()
            ->getBestSellerProductCollection($qtyProduct);

        return $productCollection;
    }

    /**
     * @param integer $qtyProduct
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getNewestProductCollection($qtyProduct)
    {
        $productCollection = $this->_featureCollectionFactory->create()
            ->getNewestProductCollection($qtyProduct);

        return $productCollection;
    }



    /**
     * @param string $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->_position = $position;
        return $this;
    }

    /**
     * @param string $position
     * @return $this
     */
    public function setCategoryPosition($position){
        $this->_categoryPosition = $position;
        return $this;
    }

    /**
     * add categoryPosition to position
     */
    public function setPositionAfterCategory(){
        $featureCollection = $this->_featureCollectionFactory->create()->getFeatureCollection()
            ->addFieldToFilter('position',array('finset'=>array($this->_categoryPosition)));
        $category = $this->_coreRegistry->registry('current_category');
        if (!is_null($category)) {
            $currentCategoryIds = $category->getId();
            foreach ($featureCollection as $feature) {
                $categoryIds = $feature->getCategoryIds();
                $featureCategoryIds = explode(',', $categoryIds);
                if (in_array($currentCategoryIds, $featureCategoryIds)) {
                    $this->_position = $this->_categoryPosition;
                }
            }
        }
    }

    /**
     * @param integer $feature_id_cms
     */
    public function setFeatureIdCms($feature_id_cms){
        $this->_feature_id_cms = $feature_id_cms;
    }

    /**
     * @return int
     */
    public function getFeatureIdCms(){
        return $this->_feature_id_cms;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        $priceRender = $this->getPriceRender();

        $price = '';
        if ($priceRender) {
            $price = $priceRender->render(
                \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE,
                $product,
                [
                    'include_container' => true,
                    'display_minimal_price' => true,
                    'zone' => \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST,
                    'list_category_page' => true
                ]
            );
        }

        return $price;
    }

    /**
     * Specifies that price rendering should be done for the list of products
     * i.e. rendering happens in the scope of product list, but not single product
     *
     * @return \Magento\Framework\Pricing\Render
     */
    protected function getPriceRender()
    {
        return $this->getLayout()->getBlock('product.price.render.default')
            ->setData('is_product_list', true);
    }

    /**
     * @return string
     */
    public function  toHtml()
    {
        if($this->_configHelper->getStoreConfig('featureproduct/general/active') == 0){
            return '';
        }
        else{
            return parent::toHtml();
        }
    }
}