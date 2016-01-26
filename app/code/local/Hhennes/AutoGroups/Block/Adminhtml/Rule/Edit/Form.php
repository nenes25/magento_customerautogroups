<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author herve
 */
class Hhennes_AutoGroups_Block_Adminhtml_Rule_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        //Création du formulaire et assignation au block
        $form = new Varien_Data_Form(
                array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
                )
        );

        //On cree un fieldset auquel on va rajouter tous les champs
        $fieldset = $form->addFieldset('edit_rule_id', array('legend' => $this->__('Customer AutoGroups Rule')));

        $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => $this->__('Name'),
            'required' => true,
            'validate' => 'required-entry'
                )
        );

        $fieldset->addField('description', 'textarea', array(
            'name' => 'description',
            'label' => $this->__('Description'),
            'required' => false,
            'validate' => 'required-entry'
                )
        );


        $renderer = Mage::getBlockSingleton('adminhtml/widget_form_renderer_fieldset')
                ->setTemplate('promo/fieldset.phtml')
                ->setNewChildUrl($this->getUrl('*/promo_quote/newConditionHtml/form/rule_conditions_fieldset'));

        $fieldset2 = $form->addFieldset('conditions_fieldset', array(
                    'legend' => $this->__('Select Customer Properties')
                ))->setRenderer($renderer);

        if (Mage::registry('autogroup_rule')) {
            $model = Mage::registry('autogroup_rule');
        } else {
            $model = Mage::getModel('hhennes_autogroups/rule');
        }
        $fieldset2->addField('conditions', 'text', array(
            'name' => 'conditions',
            'label' => $this->__('Conditions'),
            'title' => $this->__('Conditions'),
        ))->setRule($model)->setRenderer(Mage::getBlockSingleton('rule/conditions'));

		
        //Récupération des groupes clients @ToDO voir pour utiliser les fonctions magento
        $groups = Mage::helper('hhennes_autogroups')->getGroupList();

        //Groupe de destination
        $fieldset->addField('group_id', 'select', array(
            'name' => 'group_id',
            'label' => $this->__('Group'),
            'required' => true,
            'validate' => 'required-entry',
            'options' => $groups,
                )
        );

        $fieldset->addField('active', 'select', array(
            'name' => 'active',
            'label' => $this->__('Active'),
            'required' => true,
            'validate' => 'required-entry',
            'options' => array(
                '1' => $this->__('Yes'),
                '0' => $this->__('No'),
            ),
                )
        );

		
		$priority = Mage::helper('hhennes_autogroups')->getPrioritiesList();
		
        $fieldset->addField('priority', 'select', array(
            'name' => 'priority',
            'label' => $this->__('priority'),
            'required' => true,
            'validate' => 'required-entry',
            'options' => $priority,
            )
        );

        $fieldset->addField('stop_processing', 'select', array(
            'name' => 'stop_processing',
            'label' => $this->__('Stop Processing'),
            'required' => true,
            'validate' => 'required-entry',
            'options' => array(
                '1' => $this->__('Yes'),
                '0' => $this->__('No'),
            ),
                )
        );

        if (Mage::registry('autogroup_rule')) {
            $form->setValues(Mage::registry('autogroup_rule')->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
