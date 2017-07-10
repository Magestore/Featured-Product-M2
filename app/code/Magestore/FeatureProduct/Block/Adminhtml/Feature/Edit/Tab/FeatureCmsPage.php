<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magestore\FeatureProduct\Model\Config\Options;

class FeatureCmsPage extends Generic implements TabInterface{

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ){
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return string
     */
    public function getFormHtml(){
        $html = parent::getFormHtml();
        $html .= $this->setTemplate('Magestore_FeatureProduct::customcms.phtml')->toHtml();

        return $html;
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('customfield_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('How display feature product in custom cms page !')]
        );

        $this->setForm($form);
        return parent::_prepareForm();

    }

    /**
     * Return Tab label
     *
     * @return string
     * @api
     */
    public function getTabLabel()
    {
        return __('Display in Custom Cms Page');
    }

    /**
     * Return Tab title
     *
     * @return string
     * @api
     */
    public function getTabTitle()
    {
        return __('Display in Custom Cms Page');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     * @api
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     * @api
     */
    public function isHidden()
    {
        return false;
    }
}