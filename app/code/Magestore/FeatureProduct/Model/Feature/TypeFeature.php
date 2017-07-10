<?php
namespace Magestore\FeatureProduct\Model\Feature;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class TypeFeature
 * @package Magestore\FeatureProduct\Model\Feature
 */
class TypeFeature implements OptionSourceInterface
{
    const SLIDE = 'slide';
    const GRID = 'grid';
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Slide'),'value' => self::SLIDE],
            ['label' => __('Grid'),'value' => self::GRID],
        ];
    }
}
