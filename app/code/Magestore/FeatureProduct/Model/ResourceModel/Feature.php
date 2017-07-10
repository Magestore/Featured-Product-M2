<?php
namespace Magestore\FeatureProduct\Model\ResourceModel;

/**
 * Class Feature
 * @package Magestore\FeatureProduct\Model\ResourceModel
 */
class Feature extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    /**
     *
     */
    protected function _construct()	{
        $this->_init('feature_product', 'feature_id');
    }
}
