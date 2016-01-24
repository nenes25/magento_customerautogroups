<?php

class Hhennes_AutoGroups_Model_Rule_Condition_Customer extends Mage_Rule_Model_Condition_Abstract {

    /** Champs qu'on ne veut pas afficher dans les conditions */
    protected $_excludedParams = array(
        'rp_token', 
        'rp_token_created_at', 
        'group_id', 
        'default_billing', 
        'default_shipping', 
        'disable_auto_group_change', 
        'password_hash'
        );

    public function loadAttributeOptions() {
        $attributesList = Mage::getModel('customer/entity_attribute_collection');
        $attributes = array();
        
        foreach ($attributesList as $attribute) {
            if (!in_array($attribute->getAttributeCode(), $this->_excludedParams)) {
                $attributes[$attribute->getAttributeCode()] = $attribute->getFrontendLabel();
            }
        }
        $this->setAttributeOption($attributes);
        return $this;
    }

}
