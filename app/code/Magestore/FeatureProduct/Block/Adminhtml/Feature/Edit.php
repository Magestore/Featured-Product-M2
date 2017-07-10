<?php
namespace Magestore\FeatureProduct\Block\Adminhtml\Feature;

use Magento\Backend\Block\Widget\Form\Container;

/**
 * Class Edit
 * @package Magestore\FeatureProduct\Block\Adminhtml\Feature
 */
class Edit extends Container {
    /**
     *
     */
    protected function _construct()
    {
        $this->_blockGroup="Magestore_FeatureProduct";
        $this->_controller="adminhtml_feature";
        $this->_objectId="id";

        parent::_construct();

        $this->buttonList->update("save","label",__("Save"));
        $this->buttonList->add(
            "saveandcontinue",
            [
                "label" =>__("Save and Continue Edit"),
                "class" => "save",
                "data_attribute" => [
                    "mage-init" => [
                        "button" => [
                            "event" => "saveAndContinueEdit",
                            "target" => "#edit_form"
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update("delete","label",__("Delete"));
    }

    /**
     * @return string
     */
    protected function _getSaveAndContinueUrl(){
        return $this->getUrl("*/*/save",["_current"=>true,"back"=>"edit","active_tab"=>""]);
    }

}