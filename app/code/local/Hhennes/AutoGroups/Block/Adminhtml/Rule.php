<?php
class Hhennes_AutoGroups_Block_Adminhtml_Rule  extends Mage_Adminhtml_Block_Widget_Grid_Container {
    
    /**
     * Instanciation du bloc
     */
    public function __construct() {
        
        $this->_controller = 'adminhtml_rule';
        $this->_blockGroup = 'hhennes_autogroups';
        //@see Mage_Adminhtml_Block_Widget_Grid_Container _prepareLayout() pour comprendre l'intéret de ces champs
        $this->_headerText = $this->__('Manage Rules');
        
        parent::__construct();
        
        $this->_updateButton('add', 'label', Mage::helper('hhennes_autogroups')->__('Add New Rule'));
    }
}
