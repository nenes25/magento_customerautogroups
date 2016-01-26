<?php
/**
 * Description of Grid
 *
 * @author herve
 */
class Hhennes_AutoGroups_Block_Adminhtml_Rule_Grid extends Mage_Adminhtml_Block_Widget_Grid {
        
    /**
     * Instanciation du block
     */
    public function __construct() {
        
        parent::__construct();
        
        $this->setId('hhennes_autogroupGrid');
        $this->setDefaultSort('rule_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    
    /**
     * Preparation de la collection
     */
    protected function _prepareCollection() {
        
        $collection = Mage::getModel('hhennes_autogroups/rule')->getCollection();
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }
    
    /**
     * Colonnes de la collection
     */
    protected function _prepareColumns() {
        
        $this->addColumn('name', array(
           'header' =>  $this->__('Name'),
           'index' => 'name',
           'sortable' => true,
        ));
        
        $this->addColumn('description', array(
           'header' =>  $this->__('Description'),
           'index' => 'description',
           'sortable' => true,
        ));
        
        $this->addColumn('active', array(
           'header' =>  $this->__('Active'),
           'index' => 'active',
           'sortable' => true,
		   'type'=>'options',
           'options' => array('1' => 'Yes', '0' => 'No')
        ));
		
		$this->addColumn('stop_processing', array(
           'header' =>  $this->__('Stop processing'),
           'index' => 'stop_processing',
           'sortable' => true,
		   'type'=>'options',
           'options' => array('1' => 'Yes', '0' => 'No')
        ));
        
        return parent::_prepareColumns();
    }
    
    
    /**
     * Lien d'édition des urls
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    
}
