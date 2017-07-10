<?php
namespace Magestore\FeatureProduct\Helper;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 * @package Magestore\FeatureProduct\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var Data
     */
    private $helper;

    /**
     * Data constructor.
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }
}