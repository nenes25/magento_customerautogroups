<?php
/**
 * Description of Rule
 *
 * @author herve
 */
class Hhennes_AutoGroups_Model_Rule extends Mage_Rule_Model_Abstract {
    
    
    public function _construct() {
       $this->_init('hhennes_autogroups/rule');
    }
    
    public function getConditionsInstance() {
        return Mage::getModel('hhennes_autogroups/rule_condition_combine');   
    }
    
    public function getActionsInstance() {
        return false;
    }
    
     /**
     * Prepare data before saving
     *
     * @return Mage_Rule_Model_Abstract
     */
    protected function _beforeSave()
    {
       
        // Serialize conditions
        if ($this->getConditions()) {
            $this->setConditionsSerialized(serialize($this->getConditions()->asArray()));
            $this->unsConditions();
        }


        //On ne veut pas lancer la méthode parente
        Mage_Core_Model_Abstract::_beforeSave();
        return $this;
    }
}
