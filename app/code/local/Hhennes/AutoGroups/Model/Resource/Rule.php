<?php
/**
 * Description of Rule
 *
 * @author herve
 */
class Hhennes_AutoGroups_Model_Resource_Rule extends Mage_Core_Model_Resource_Db_Abstract {
    
    public function _construct() {
        $this->_init('hhennes_autogroups/rule','rule_id');
    }
}
