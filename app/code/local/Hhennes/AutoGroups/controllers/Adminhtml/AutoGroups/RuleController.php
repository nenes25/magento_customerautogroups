<?php

/**
 * Description of RulesController
 *
 * @author herve
 */
class Hhennes_AutoGroups_Adminhtml_AutoGroups_RuleController extends Mage_Adminhtml_Controller_Action {

    /** Modèle géré dans le controller */
    protected $_model = 'hhennes_autogroups/rule';

    /**
     * Intialisation des paramètres communs des actions
     * ( Fil d'ariane )
     */
    protected function _init() {
        $this->_setActiveMenu('customer/hhennes_autogroups/');
        $this->_addBreadcrumb($this->__('Customer AutoGroup Rules'), $this->__('Customer AutoGroup Rules'));
    }

    /**
     * Par défaut : Affichage de la grid
     */
    public function indexAction() {
        $this->loadLayout();
        $this->_init();
        $this->renderLayout();
    }

    /**
     * Création d'une nouvelle règle
     */
    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {

        $modelId = $this->getRequest()->getParam('id');
        $model = Mage::getModel($this->_model)->load($modelId);
        Mage::register('autogroup_rule', $model);

        if ($model->getId() || $modelId == 0) {

            //Chargement du layout et initialisation
            $this->loadLayout();
            $this->getLayout()->getBlock('head')
                    ->setCanLoadExtJs(true)
                    ->setCanLoadRulesJs(true);
            $this->_init();

            //$model->getConditions()->setJsFormObject('rule_conditions_fieldset');
            //Contenu de la page ( Formulaire 
            $this->_addContent($this->getLayout()->createBlock('hhennes_autogroups/adminhtml_rule_edit'));

            //Fil d'ariane
            if ($model->getId() > 0) {
                $this->_addBreadcrumb($this->__('Edition of Autogroup rule %s', $model->getName()), $this->__('Edition of Autogroup  %s', $model->getName()));
                //$model->getConditions()->setJsFormObject('conditions_fieldset');
            } else {
                $this->_addBreadcrumb($this->__('New Autogroup rule'), $this->__('New Autogroup rule'));
            }

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Error no id provide'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * Sauvegarde d'une règle
     */
    public function saveAction() {

        if ($this->getRequest()->getPost()) {

            $data = $this->getRequest()->getPost();
            $model = Mage::getModel($this->_model);

            //On sauvegarde les données
            $model->setData($data);
            
            //Gestion des conditions de la règle
            if (isset($data['rule']['conditions'])) {
                $data['conditions'] = $data['rule']['conditions'];
            }
            unset($data['rule']);
            $model->loadPost($data);
            
            //Mise à jour d'une règle existante
            if ($idRule = $this->getRequest()->getParam('id')) {
                $model->setId($idRule);
            }

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Rule saved successfully'));
            } catch (Exception $ex) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to save Rule'));
                die($ex->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }

    /**
     * Suppression d'une règle
     */
    public function deleteAction() {
        
        $id = $this->getRequest()->getParam('id');
        try {
            $model = Mage::getModel($this->_model)->load($id);
            $model->delete();
        } catch (Exception $ex) {
            Mage::getSingleton('adminhtml/session')->addError($ex->getMessage());
            $this->_redirect('*/*/');
        }
        
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Rule deleted successfully'));
        $this->_redirect('*/*/');
    }

}
