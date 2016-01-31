<?php

/**
 * Description of Main
 *
 * @author herve
 */
class Hhennes_AutoGroups_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{

    /**
     * Paramètres de la classe pour tester automatiquement que le fichier de configuration respecte certaines normes
     * Permets de génériser la création de ce fichier de test pour l'ensemble des modules
     */
    protected $_codePool = 'local';
    protected $_currentVersion = '0.1.0';
    protected $_useResource = true;
    protected $_nodeName = 'hhennes_autogroups'; //Nom utilisé pour les noeud ( models / helpers/ blocks )

    /**
     * Test que le module est actif
     */

    public function testModuleIsActive()
    {
        $this->assertModuleIsActive();
    }

    /**
     * Tests globals sur le module
     */
    public function testModuleGlobal()
    {
        //CodePool
        $this->assertModuleCodePool($this->_codePool);
        //Version du module
        $this->assertModuleVersion($this->_currentVersion);
    }

    /**
     * Vérification des conditions de setup du module
     */
    public function testSetupResources()
    {
        if ($this->_useResource) {
            $this->assertSetupResourceDefined();
            //Ce tests ne fonctionne pas avec la structure "data" au lieu de sql
            //Il faut voir pour écrire un test supplémentaire
            #$this->assertSetupResourceExists();
        }
    }

    /**
     * Vérification des alias de la classe
     * ( Models/ ResourceModel / Helpers / Blocks )
     */
    public function testClassesAlias()
    {
        //Models
        $this->assertModelAlias($this->_nodeName . '/observer', 'Hhennes_AutoGroups_Model_Observer');
        $this->assertModelAlias($this->_nodeName . '/rule', 'Hhennes_AutoGroups_Model_Rule');
        $this->assertModelAlias($this->_nodeName . '/rule_condition_address', 'Hhennes_AutoGroups_Model_Rule_Condition_Address');
        $this->assertModelAlias($this->_nodeName . '/rule_condition_combine', 'Hhennes_AutoGroups_Model_Rule_Condition_Combine');
        $this->assertModelAlias($this->_nodeName . '/rule_condition_customer', 'Hhennes_AutoGroups_Model_Rule_Condition_Customer');

        $this->assertModelAlias($this->_nodeName . '/resource_rule', 'Hhennes_AutoGroups_Model_Resource_Rule');
        $this->assertModelAlias($this->_nodeName . '/resource_rule_collection', 'Hhennes_AutoGroups_Model_Resource_Rule_Collection');

        //Helpers
        $this->assertHelperAlias($this->_nodeName, 'Hhennes_AutoGroups_Helper_Data');

        //Blocks
        $this->assertBlockAlias($this->_nodeName . '/adminhtml_rule', 'Hhennes_AutoGroups_Block_Adminhtml_Rule');
        $this->assertBlockAlias($this->_nodeName . '/adminhtml_rule_grid', 'Hhennes_AutoGroups_Block_Adminhtml_Rule_Grid');
        $this->assertBlockAlias($this->_nodeName . '/adminhtml_rule_edit', 'Hhennes_AutoGroups_Block_Adminhtml_Rule_Edit');
        $this->assertBlockAlias($this->_nodeName . '/adminhtml_rule_edit_form', 'Hhennes_AutoGroups_Block_Adminhtml_Rule_Edit_Form');
    }
    
    /**
     * Test que les événements sont bien définis
     */
    public function testEvents() {
        
        $this->assertEventObserverDefined('frontend', 'customer_register_success', 'hhennes_autogroups/observer', 'applyGroupRulesOnCustomerRegisterSuccess');
        $this->assertEventObserverDefined('frontend', 'checkout_submit_all_after', 'hhennes_autogroups/observer', 'applyGroupRulesOnCheckout');
    }

}
