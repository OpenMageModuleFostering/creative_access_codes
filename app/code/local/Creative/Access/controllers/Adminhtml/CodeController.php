<?php
class Creative_Access_Adminhtml_CodeController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {  
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }  
     
    public function newAction()
    {  
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }  
     
    public function editAction()
    {  
        $this->_initAction();
     
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('creative_access/code');
     
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This Access code no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            }  
        }  
     
        $this->_title($model->getId() ? $model->getName() : $this->__('New Access code'));
     
        $data = Mage::getSingleton('adminhtml/session')->getCodeData(true);
        if (!empty($data)) {
            $model->setData($data);
        }  
     
        Mage::register('creative_access', $model);
     
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Access code') : $this->__('New Access code'), $id ? $this->__('Edit Access code') : $this->__('New Access code'))
            ->_addContent($this->getLayout()->createBlock('creative_access/adminhtml_code_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }
     
    public function saveAction()
    {   //print_r($_POST);die();
        if ($postData = $this->getRequest()->getPost()) {
        //print_r($postData ['is_active'] );die();
            
            $model = Mage::getModel('creative_access/code');
            $model->setData($postData);
          
            try {
                 $model->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Access code has been saved.'));
                $this->_redirect('*/*/');
 
                return;
            }  
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this Access code.'));
            }
 
            Mage::getSingleton('adminhtml/session')->setCodeData($postData);
            $this->_redirectReferer();
        }
    }
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $diog_collection = Mage::getModel('creative_access/code')
                ->load($id);
            
            try {
                $diog_collection->delete();
                $this->_getSession()->addSuccess($this->__('The Access code has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
       $this->_redirect('*/*/');
    }
   
     
    public function messageAction()
    {
        $data = Mage::getModel('creative_access/code')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
     
    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('creative_access_code')
            ->_title($this->__('Access code'))->_title($this->__('Access code'))
            ->_addBreadcrumb($this->__('Access code'), $this->__('Access code'))
            ->_addBreadcrumb($this->__('Access code'), $this->__('Access code'));
         
        return $this;
    }
     
    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/creative_access_code');
    }
}
