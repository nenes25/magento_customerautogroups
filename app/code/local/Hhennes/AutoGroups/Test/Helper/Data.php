<?php

/**
 * Description of Data
 *
 * @author herve
 */
class Hhennes_AutoGroups_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case {

    /**
     * Test des groupes clients
     */
    public function testgetGroupList() {

        $groupList = Mage::helper('hhennes_autogroups')->getGroupList();
        $this->assertNotEmpty($groupList);
    }

    /**
     * Liste des priorités
     */
    public function testgetPrioritiesList() {

        $max = 10;
        $options = array();
        for ($i = 1; $i <= $max; $i++) {
            $options[$i] = $i;
        }

        $this->assertEquals($options, Mage::helper('hhennes_autogroups')->getPrioritiesList());
    }

}
