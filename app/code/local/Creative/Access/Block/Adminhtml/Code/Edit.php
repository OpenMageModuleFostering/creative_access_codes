<?php
class Creative_Access_Block_Adminhtml_Code_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'creative_access';
        $this->_controller = 'adminhtml_code';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Access code'));
        $this->_updateButton('delete', 'label', $this->__('Delete Access code'));
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('creative_access')->getId()) {
            return $this->__('Edit Access code');
        }  
        else {
            return $this->__('New Access code');
        }  
    }  
}