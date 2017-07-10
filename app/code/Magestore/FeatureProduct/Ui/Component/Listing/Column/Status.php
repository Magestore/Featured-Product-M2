<?php
namespace Magestore\FeatureProduct\Ui\Component\Listing\Column;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package Magestore\FeatureProduct\Ui\Component\Listing\Column
 */
class Status implements OptionSourceInterface
{
    /**
     *
     */
    const ENABLED = 1;
    /**
     *
     */
    const DISABLED = 2;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Enabled'),'value' => self::ENABLED],
            ['label' => __('Disabled'),'value' => self::DISABLED],
        ];
    }
}
