<?php
/**
 * Copyright (c) Magestore
 */

namespace Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

/**
 * Class Form
 * @package Magestore\FeatureProduct\Block\Adminhtml\Feature\Edit
 */
class Form extends Generic {

    /**
     *
     */
    protected function _construct(){
        $this->setId("feature_form");
        $this->setTitle(__("Feature Information"));
        parent::_construct();
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $form = $this -> _formFactory -> create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', ['store' => $this->getRequest()->getParam('store')]),
                    'method' => 'post',
                ]
            ]
        );
        $form-> setHtmlIdPrefix('feature_main');
        $form -> setUseContainer (true);
        $this -> setForm($form);

        return parent::_prepareForm();
    }
}