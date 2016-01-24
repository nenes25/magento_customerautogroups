<?php

/* @var $this Mage_Core_Model_Resource_Setup */
$installer = $this;//new Mage_Core_Model_Resource_Setup(); //Mettre $this, mais plus pratique pour autocomplétion

$connection = $installer->getConnection();
$ruleTable = $installer->getTable('hhennes_autogroups/rule');

$installer->startSetup();

//On va créer la table
if ( !$connection->isTableExists($ruleTable)) {
    
    $table = $connection->newTable($ruleTable)
            ->addColumn('rule_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            'auto_increment' => true,    
            'primary'   => true
            ),
            'Rule Id'
        )
        ->addColumn('group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            ),
            'Group Id'
        )
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(),'Rule Name')    
        ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(),'Rule description')
        ->addColumn('active', Varien_Db_Ddl_Table::TYPE_TINYINT, 1, array(),'Active')
        ->addColumn('stop_processing', Varien_Db_Ddl_Table::TYPE_TINYINT, 1, array(
            'unsigned'  => true,
            'nullable'  => false,
            ),'Stop processing')
        ->addColumn('priority', Varien_Db_Ddl_Table::TYPE_TINYINT, 2, array(
            'unsigned'  => true,
            'nullable'  => false,
            ),'Priority')
        ->addColumn('conditions_serialized', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'unsigned'  => true,
            'nullable'  => false,
            ),'Active')
        /*Remettre en place la foreign key mais elle ne fonctionne pas pour le moment
         * ->addForeignKey($connection->getForeignKeyName('hhennes_autogroups/rule', 'group_id', 'customer/group', 'customer_group_id'), 
                'group_id', $connection->getTableName('customer/group'), 'customer_group_id',
                Varien_Db_Ddl_Table::ACTION_CASCADE,  Varien_Db_Ddl_Table::ACTION_CASCADE
                )*/
        ->setComment('AutoGroups Rules');
    
    //Ligne qui va créé la table
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();