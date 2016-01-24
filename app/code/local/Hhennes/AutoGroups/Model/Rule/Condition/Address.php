<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author herve
 */
class Hhennes_AutoGroups_Model_Rule_Condition_Address extends Mage_Rule_Model_Condition_Abstract {

    /** Paramètres qu'on ne veut pas mettre dans la condition */
    protected $_excludedParams = array();

    public function loadAttributeOptions() {
        $attributesList = Mage::getModel('customer/entity_address_attribute_collection');
        $attributes = array();

        foreach ($attributesList as $attribute) {
            if (!in_array($attribute->getAttributeCode(), $this->_excludedParams)) {
                $attributes[$attribute->getAttributeCode()] = Mage::helper('hhennes_autogroups')->__('Address').' '.$attribute->getFrontendLabel();
            }
        }
        $this->setAttributeOption($attributes);

        return $this;
    }

}
