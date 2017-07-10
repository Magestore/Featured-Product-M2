<?php
namespace Magestore\FeatureProduct\Helper;
/**
 * Class Config
 * @package Magestore\FeatureProduct\Helper
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param $path
     * @return mixed
     */
    public function getStoreConfig($path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
