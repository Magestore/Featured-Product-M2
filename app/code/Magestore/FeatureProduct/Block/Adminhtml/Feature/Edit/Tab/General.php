<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magestore\FeatureProduct\Model\Config\Options;

/**
 * Class General
 * @package Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab
 */
class General extends Generic implements TabInterface {
    /**
     * @var Options
     */
    protected $_option;
    /**
     * @var \Magento\Framework\Stdlib\DateTime\Timezone
     */
    protected $dateTime;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @var \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory
     */
    protected $_fieldFactory;

    /**
     * General constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Options $options
     * @param \Magento\Framework\Stdlib\DateTime\Timezone $dateTime
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Options $options,
        \Magento\Framework\Stdlib\DateTime\Timezone $dateTime,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory,
        array $data = []
    )
    {
        $this->dateTime = $dateTime;
        $this -> _option = $options;
        $this->_systemStore = $systemStore;
        $this->_fieldFactory = $fieldFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

//    protected function _prepareLayout() {
//        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
//    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_feature');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this -> _formFactory -> create();

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Feature Information')]);

        $elements = [];
        if ($model->getId()){
            $fieldset->addField('feature_id', 'hidden', ["name"=>"feature_id"]);
        }

        $elements['name'] = $fieldset->addField(
            "name",
            "text",
            [
                "name" => "name",
                "label" => __("Name"),
                "required" => true,
            ]
        );

        $elements['store_id'] = $fieldset->addField(
            "store_id",
            "multiselect",
            [
                "name" => "store_id[]",
                "label" => __("Store View"),
                "required" => true,
                "values" => $this->_systemStore->getStoreValuesForForm(false, true),
            ]
        );

        $elements['position'] = $fieldset->addField(
            "position",
            "multiselect",
            [
                "name" => "position[]",
                "label" => __("Layout Position"),
                "required" => true,
                "values" => $this ->_option -> toOptionPosition(),
            ]
        );

        $elements['category_ids'] = $fieldset->addField(
            "category_ids",
            "multiselect",
            [
                "name" => "category_ids[]",
                "label" => __("Category Position"),
                "required"=>true,
                "values" => $this->_option->getCategoriesArray(),
            ]
        );

        $dateFormat = 'M/d/yyyy';
        $timeFormat = 'h:mm a';
        $style = 'color: #000;background-color: #fff; font-weight: bold; font-size: 13px;';
        $elements['time_start'] = $fieldset->addField(
            'time_start',
            'date',
            [
                'name' => 'time_start',
                'label' => __('Starting time'),
                'title' => __('Starting time'),
                'required' => true,
                'readonly' => true,
                'style' => $style,
                'class' => 'required-entry',
                'date_format' => $dateFormat,
                'time_format' => $timeFormat,
                'note' => implode(' ', [$dateFormat, $timeFormat])
            ]
        );

        $elements['time_end'] = $fieldset->addField(
            'time_end',
            'date',
            [
                'name' => 'time_end',
                'label' => __('Ending time'),
                'title' => __('Ending time'),
                'required' => true,
                'readonly' => true,
                'style' => $style,
                'class' => 'required-entry',
                'date_format' => $dateFormat,
                'time_format' => $timeFormat,
                'note' => implode(' ', [$dateFormat, $timeFormat])
            ]
        );

        $elements['visible_title'] = $fieldset->addField(
            "visible_title",
            "select",
            [
                "name" => "visible_title",
                "label" => __("Visible Title"),
                "required" => true,
                "value"=>1,
                "selected" => true,
                "values" => $this ->_option ->toOptionSelect(true),
            ]
        );

        $elements['visible_product_name'] = $fieldset->addField(
            "visible_product_name",
            "select",
            [
                "name" => "visible_product_name",
                "label" => __("Visible Product Name"),
                "required" => true,
                "options" => $this ->_option ->toOptionSelect(),
            ]
        );

        $elements['visible_product_price'] = $fieldset->addField(
            "visible_product_price",
            "select",
            [
                "name" => "visible_product_price",
                "label" => __("Visible Product Price"),
                "required" => true,
                "options" => $this ->_option ->toOptionSelect(),
            ]
        );

        $elements['visible_product_review'] = $fieldset->addField(
            "visible_product_review",
            "select",
            [
                "name" => "visible_product_review",
                "label" => __("Visible Product Review"),
                "required" => true,
                "options" => $this ->_option ->toOptionSelect(),
            ]
        );

        $elements['visible_add_to_cart'] = $fieldset->addField(
            "visible_add_to_cart",
            "select",
            [
                "name" => "visible_add_to_cart",
                "label" => __("Visible Add To Cart"),
                "required" => true,
                "options" => $this ->_option ->toOptionSelect(),
            ]
        );

        $elements['qty_product_in_row'] = $fieldset->addField(
            "qty_product_in_row",
            "text",
            [
                "name" => "qty_product_in_row",
                "label" => __("Number of products per row/slide "),
                "required" => true,
            ]
        );

        $elements['status'] = $fieldset->addField(
            "status",
            "select",
            [
                "name" => "status",
                "label" => __("Status"),
                "required" => true,
                "options" => $this ->_option ->toOptionArray(),
            ]
        );

        $elements['type'] = $fieldset->addField(
            "type",
            "select",
            [
                "name" => "type",
                "label" => __("Display Type"),
                "required" => true,
                "options" => $this ->_option -> toOptionDisplayType(),
            ]
        );

        $elements['slide_auto_play'] = $fieldset->addField(
            "slide_auto_play",
            "select",
            [
                "name" => "slide_auto_play",
                "label" => __("Auto play Slide"),
                "options" => $this -> _option -> toOptionSelect(),
            ]
        );

        $elements['time_slide'] = $fieldset->addField(
            "time_slide",
            "text",
            [
                "name" => "time_slide",
                "label" => __("Slide Time"),
                "values"=> '5',
                "note"=>"(seconds)",
            ]
        );

        $elements['slide_visible_nav'] = $fieldset->addField(
            "slide_visible_nav",
            "select",
            [
                "name" => "slide_visible_nav",
                "label" => __("Visible Navigation"),
                "options" => $this -> _option -> toOptionSelect(),
            ]
        );

        $elements['slide_visible_dots'] = $fieldset->addField(
            "slide_visible_dots",
            "select",
            [
                "name" => "slide_visible_dots",
                "label" => __("Visible Dots"),
                "options" => $this -> _option -> toOptionSelect(),
            ]
        );

        $elements['slide_hover_pause'] = $fieldset->addField(
            "slide_hover_pause",
            "select",
            [
                "name" => "slide_hover_pause",
                "label" => __("Stop/On Hover"),
                "options" => $this ->_option ->toOptionSelect(),
            ]
        );

        $dependenceBlock = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Form\Element\Dependence'
        );

        $refField = implode(',',[
            'category-sidebar-right-top',
            'category-sidebar-right-bottom',
            'category-sidebar-left-top',
            'category-sidebar-left-bottom',
            'category-content-top',
            'category-menu-top',
            'category-menu-bottom',
            'category-page-bottom']);

        $this->setChild(
            'form_after',
            $dependenceBlock->addFieldMap(
                $elements['type']->getHtmlId(),
                $elements['type']->getName()
            )->addFieldMap(
                $elements['time_slide']->getHtmlId(),
                $elements['time_slide']->getName()
            )->addFieldMap(
                $elements['slide_auto_play']->getHtmlId(),
                $elements['slide_auto_play']->getName()
            )->addFieldMap(
                $elements['slide_hover_pause']->getHtmlId(),
                $elements['slide_hover_pause']->getName()
            )->addFieldMap(
                $elements['slide_visible_dots']->getHtmlId(),
                $elements['slide_visible_dots']->getName()
            )->addFieldMap(
                $elements['slide_visible_nav']->getHtmlId(),
                $elements['slide_visible_nav']->getName()
            )->addFieldDependence(
                $elements['time_slide']->getName(),
                $elements['type']->getName(),
                'slide'
            )->addFieldDependence(
                $elements['slide_auto_play']->getName(),
                $elements['type']->getName(),
                'slide'
            )->addFieldDependence(
                $elements['slide_hover_pause']->getName(),
                $elements['type']->getName(),
                'slide'
            )->addFieldDependence(
                $elements['slide_visible_dots']->getName(),
                $elements['type']->getName(),
                'slide'
            )->addFieldDependence(
                $elements['slide_visible_nav']->getName(),
                $elements['type']->getName(),
                'slide'
            )->addFieldMap(
                $elements['position']->getHtmlId(),
                $elements['position']->getName()
            )->addFieldMap(
                $elements['category_ids']->getHtmlId(),
                $elements['category_ids']->getName()
            )->addFieldDependence(
                $elements['category_ids']->getName(),
                $elements['position']->getName(),
                $this->getDependencyField($refField)
            )
        );

        $defaultData = [
            'visible_title'=>1,
            'visible_product_name'=>1,
            'visible_product_price'=>1,
            'visible_product_review'=>1,
            'visible_add_to_cart'=>1,
            'qty_product_in_row'=>5,
            'time_slide' => 5,
            'slide_auto_play'=>1,
            'slide_visible_dots'=>1,
        ];

        if (!$model->getId()) {
            $model->addData($defaultData);
        }

        $form->setValues($model->getData());
        $this -> setForm($form);
        return parent::_prepareForm();
    }

    /**
     * get dependency field.
     *
     * @return \Magento\Config\Model\Config\Structure\Element\Dependency\Field [description]
     */
    public function getDependencyField($refField)
    {
        return $this->_fieldFactory->create(
            ['fieldData' => ['value' => $refField, 'separator' => ','], 'fieldPrefix' => '']
        );
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General Infomation');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General Infomation');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }


    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}