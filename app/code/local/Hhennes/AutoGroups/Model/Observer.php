<?php
/**
 * Description of Observer
 *
 * @author herve
 */
class Hhennes_AutoGroups_Model_Observer {
    
    /**
     * Methode appellée lors de la création d'un client via le formulaire standard
     * Event customer_register_success
     * @param type $observer
     */
    public function applyGroupRulesOnCustomerRegisterSuccess($observer){
        
        $customer = $observer->getCustomer();
        $this->_applyRules($customer);
    }
    
    /**
     * Methode appellée lors de la création d'un client via le formulaire standard
     * Event checkout_submit_all_after
     * @param type $observer
     */
    public function applyGroupRulesOnCheckout($observer) {

        //Uniquement dans le cas ou un client s'est enregistré sur le modele Onepage
        if ($observer->getQuote()->getData('checkout_method') == Mage_Checkout_Model_Type_Onepage::METHOD_REGISTER) {
            $customer = $observer->getQuote()->getCustomer();
            $this->_applyRules($customer);
        }
    }

    /**
     *  Application des règles de groupe au client
     * @param Mage_Customer_Model_Customer $customer
     */
    protected function _applyRules(Mage_Customer_Model_Customer $customer ) {      
        //Test en dur
        if ( $customer->getDefaultBillingAddress()){
            Mage::log($customer->getDefaultBillingAddress(),Zend_Log::DEBUG,'hhennes_autogroups',true);
        }
        
        try {
            $customer->setGroupId(4);
            $customer->save();
        } catch (Exception $e) {
            Mage::log($e->getMessage(),Zend_Log::DEBUG,'hhennes_autogroups_exeption',true);
        }
    }
}
