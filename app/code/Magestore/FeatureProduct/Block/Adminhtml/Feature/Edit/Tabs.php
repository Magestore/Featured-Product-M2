<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit;

/**
 * Class Tabs
 * @package Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('feature_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Feature Manager'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_tab',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab\General')
                    ->toHtml(),
                'active' => true
            ]
        );

        $this->addTab(
            'product_section',
            [
                'label' => __('Product Information'),
                'title' => __('Product Information'),
                'class' => 'ajax',
                'url' => $this->getUrl('*/*/productlist', array('_current' => true, 'id' => $this->getRequest()->getParam('id')))
            ]
        );

        $this->addTab(
            'feature_in_cms_page',
            [
                'label' => __('Display in Custom Cms Page'),
                'title' => __('Display in Custom Cms Page'),
                'class' => 'ajax',
                'content' => $this->getLayout()->createBlock('Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab\FeatureCmsPage')
                    ->toHtml()
            ]
        );

        return parent::_beforeToHtml();
    }

}
