<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author herve
 */
class Hhennes_AutoGroups_Model_Resource_Rule_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    
    public function _construct() {
        parent::_construct();
        $this->_init('hhennes_autogroups/rule');
    }
}
