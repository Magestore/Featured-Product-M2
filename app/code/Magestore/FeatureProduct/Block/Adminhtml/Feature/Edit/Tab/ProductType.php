<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab;

/**
 * Class ProductType
 * @package Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit\Tab
 */
class ProductType extends \Magento\Backend\Block\Widget\Form\Generic
    implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;
    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $_product;

    /**
     * @var \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory
     */
    protected $_fieldFactory;
    /**
     * ProductType constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Catalog\Model\Product $product
     * @param \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\Product $product,
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory,
        array $data = array()
    )
    {
        $this->_objectManager = $objectManager;
        $this->_systemStore = $systemStore;
        $this->_productFactory = $productFactory;
        $this->_product = $product;
        $this->_fieldFactory = $fieldFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_objectManager->create('Magestore\FeatureProduct\Model\Feature')
        ->load($this->getRequest()->getParam('id'));

        $fieldMaps = [];
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Feature Information')));

        $fieldMaps['type_product'] = $fieldset->addField(
        'type_product',
        'select',
        [
            'label' => __('Product List Type'),
            'name' => 'type_product',
            'values' => [
                [
                    'value' => \Magestore\FeatureProduct\Model\Feature::CHOOSE_MANUAL,
                    'label' => __('Choose Manual'),
                ],
                [
                    'value' => \Magestore\FeatureProduct\Model\Feature::BESTVALUE_PRODUCT,
                    'label' => __('Best Value Products'),
                ],
                [
                    'value' => \Magestore\FeatureProduct\Model\Feature::NEWEST_PRODUCT,
                    'label' => __('Newest Products'),
                ],
            ],
        ]
    );

//        $fieldMaps['product_ids'] = $fieldset->addField('product_ids', 'text', array(
//            'label' => __('Product Id'),
//            'name' => 'product_ids',
//            'class' => 'disabled',
//            'disabled' => true,
//            'attribute'=>[
//                'disabled'=>'disabled',
//            ],
//
//        ));

        $fieldMaps['qty_product'] = $fieldset->addField('qty_product', 'text', array(
            'label'     => __('Quatity Product Limit'),
            'required'  => true,
            'value' => '',
            'name'      => 'qty_product',
            'disabled' => false,
        ));

        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Form\Element\Dependence'
            )->addFieldMap(
                $fieldMaps['type_product']->getHtmlId(),
                $fieldMaps['type_product']->getName()
            )->addFieldMap(
                $fieldMaps['qty_product']->getHtmlId(),
                $fieldMaps['qty_product']->getName()
            )->addFieldDependence(
                $fieldMaps['qty_product']->getName(),
                $fieldMaps['type_product']->getName(),
                $this->_fieldFactory->create(
                    ['fieldData' => ['value' => '2,3', 'separator' => ','], 'fieldPrefix' => '']
                )
            )
        );

        $data = [
            'product_ids'=>$model->getProductIds(),
            'qty_product'=>'10'
        ];

        if (!$model->getId()) {
            $model->addData($data);
        }

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return mixed
     */
    public function getFeature() {
        return $this->_coreRegistry->registry('current_feature');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Feature Information');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Feature Information');
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
