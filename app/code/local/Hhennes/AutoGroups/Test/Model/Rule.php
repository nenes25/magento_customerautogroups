<?php

/**
 * Description of Rule
 *
 * @author herve
 */
class Hhennes_AutoGroups_Test_Model_Rule extends EcomDev_PHPUnit_Test_Case {

    /**
     * Test de la bonne application des règles lors de la création du compte
     * @doNotIndexAll
     * @loadFixture
     * @dataProvider dataProvider
     */
    public function testRuleApplicationRegister($datas) {

        $customer = Mage::getModel('customer/customer')->setData($datas);

        $rules = Mage::getModel('hhennes_autogroups/rule')->getCollection()
                ->addFieldToFilter('active', 1)
                ->setOrder('priority', 'ASC');

        foreach ($rules as $rule) {
            if ($rule->validate($customer)) {
                $customer->setGroupId($rule->getGroupId());
                $this->assertEquals($rule->getName(), $datas['expected_group']);
                break;
            }
        }

        //Si ne doit pas valider de règle il doit être dans le groupe par défaut
        if ($datas['expected_group'] == 'none') {
            $this->assertEquals(1, $customer->getGroupId());
        }
        //Sinon on vérifie que le groupe client est différent du groupe par défaut
        else {
            $this->assertNotEquals(1, $customer->getGroupId());
        }
    }
    
    /**
     * Test de la bonne application des règles lors de la création du compte
     * @doNotIndexAll
     * @loadFixture
     * @dataProvider dataProvider
     */
    public function testRuleApplicationCheckout($datas) {

        $customer = Mage::getModel('customer/customer')->setData($datas);

        $rules = Mage::getModel('hhennes_autogroups/rule')->getCollection()
                ->addFieldToFilter('active', 1)
                ->setOrder('priority', 'ASC');

        foreach ($rules as $rule) {
            if ($rule->validate($customer)) {
                $customer->setGroupId($rule->getGroupId());
                $this->assertEquals($rule->getName(), $datas['expected_group']);
                break;
            }
        }

        //Si ne doit pas valider de règle il doit être dans le groupe par défaut
        if ($datas['expected_group'] == 'none') {
            $this->assertEquals(1, $customer->getGroupId());
        }
        //Sinon on vérifie que le groupe client est différent du groupe par défaut
        else {
            $this->assertNotEquals(1, $customer->getGroupId());
        }
    }

}
