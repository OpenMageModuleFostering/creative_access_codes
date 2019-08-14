<?php
class Creative_Access_Block_Adminhtml_Code extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'creative_access';
        $this->_controller = 'adminhtml_code';
        $this->_headerText = $this->__('Access code');
         
        parent::__construct();
    }
}