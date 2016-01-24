<?php

/**
 * Création d'un modèle de combinaisons d'attributs spécifiques
 */
class Hhennes_AutoGroups_Model_Rule_Condition_Combine extends Mage_Rule_Model_Condition_Combine {
    
     public function getNewChildSelectOptions()
    {
        $addressCondition = Mage::getModel('hhennes_autogroups/rule_condition_address');
        $addressAttributes = $addressCondition->loadAttributeOptions()->getAttributeOption();
        $attributes = array();
        foreach ($addressAttributes as $code=>$label) {
            $attributes[] = array('value'=>'hhennes_autogroups/rule_condition_address|'.$code, 'label'=>$label);
        }
        
        $customerCondition = Mage::getModel('hhennes_autogroups/rule_condition_customer');
        $customerAttributes = $customerCondition->loadAttributeOptions()->getAttributeOption();
        $CustomersAttributes = array();
         foreach ($customerAttributes as $code=>$label) {
            $CustomersAttributes[] = array('value'=>'hhennes_autogroups/rule_condition_customer|'.$code, 'label'=>$label);
        }

        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive($conditions, array(
            array('label'=>Mage::helper('hhennes_autogroups')->__('Address Attributes'), 'value'=>$attributes),
            array('label'=>Mage::helper('hhennes_autogroups')->__('Customer Attributes'), 'value'=>$CustomersAttributes),
        ));

        return $conditions;
    }
   
}
