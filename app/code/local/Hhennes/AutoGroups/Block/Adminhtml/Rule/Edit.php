<?php
/**
 * Description of Edit
 *
 * @author herve
 */
class Hhennes_AutoGroups_Block_Adminhtml_Rule_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        
        parent::__construct();
        $this->_controller = 'adminhtml_rule';
        $this->_blockGroup = 'hhennes_autogroups';
        $this->_headerText = $this->__('Manage Rules');
       
        //Pour gérer la traduction des boutons
        $this->_updateButton('save', 'label', $this->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('adminhtml')->__('Delete'));  
    }
}
