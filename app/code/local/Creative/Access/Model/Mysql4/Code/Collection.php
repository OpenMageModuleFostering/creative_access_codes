<?php
class Creative_Access_Model_Mysql4_Code_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {  
        $this->_init('creative_access/code');
    }  
}