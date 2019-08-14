<?php
class Creative_Access_Block_Adminhtml_Code_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('creative_access_code_form');
        $this->setTitle($this->__('Access Code Information'));
    }  
     
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {  
        $model = Mage::registry('creative_access');
     
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));
     
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('Access code Information'),
            'class'     => 'fieldset-wide',
        ));
     
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }  
     
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('checkout')->__('Access code'),
            'title'     => Mage::helper('checkout')->__('Access code'),
            'required'  => true,
        ));
         $fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('checkout')->__('is_active'),
            'name'      => 'is_active',
            'values'    => array(
            array(
                'value'     => 'Enabled',
                'label'     => Mage::helper('checkout')->__('Enabled'),
                ),
  
            array(
                'value'     => 'Disabled',
                'label'     => Mage::helper('checkout')->__('Disabled'),
                ),    
            ),
        ));
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
}