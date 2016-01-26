<?php
/**
 * Description of Data
 *
 * @author herve
 */
class Hhennes_AutoGroups_Helper_Data extends Mage_Core_Helper_Abstract {
    
    
    /**
     * Récupération de la liste des groupes clients Magento
     * @return type
     */
    public function getGroupList() {
        
        $groups = Mage::getModel('customer/group')->getCollection();
        $groupsList = array();
        foreach ( $groups as $group) {
            $groupsList[$group->getId()] =  $group->getCustomerGroupCode();
        }
        return $groupsList;
        
    }
	
	/**
	 * Liste des priorités
	 */
	public function getPrioritiesList() {
		
		$max = 10;
		$options = array();
		for( $i=1; $i <= $max ; $i++) {
			$options[$i] = $i;
		}
				
		return $options;
	}
    
}
