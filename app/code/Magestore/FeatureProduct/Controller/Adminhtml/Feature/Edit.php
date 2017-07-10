<?php
namespace Magestore\FeatureProduct\Controller\Adminhtml\Feature;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magestore\FeatureProduct\Model\FeatureFactory;

/**
 * Class Edit
 * @package Magestore\FeatureProduct\Controller\Adminhtml\Feature
 */
class Edit extends \Magento\Backend\App\Action{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var FeatureFactory
     */
    protected $_featureFactory;
//   / const ADMIN_RESOURCE = 'Magestore_FeatureProduct::feature_save';

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param FeatureFactory $featureFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        FeatureFactory $featureFactory
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory=$pageFactory;
        $this ->_featureFactory = $featureFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute(){
        $featureId = $this -> getRequest() -> getParam('id');
        $model = $this -> _featureFactory -> create();
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        if($featureId) {
            $model -> load($featureId);
            if(!$model -> getId()){
                $this -> messageManager -> addErrorMessage(__('This Feature no logger exists'));
                $this -> _redirect('*/*/');
            }
            $title = "Edit Feature Infomation: ".$model -> getName();
        }else {
            $title = "Add a New Feature Infomation";
        }

        $registryObject->register('current_feature', $model);

        $resultPage = $this -> _resultPageFactory -> create();
        $resultPage -> setActiveMenu('Magestore_FeatureProduct::feature');
        $resultPage -> getConfig() -> getTitle() -> prepend(__($title));

        return $resultPage;
    }
}