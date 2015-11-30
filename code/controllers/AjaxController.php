<?php

require 'Mage/CatalogSearch/controllers/AjaxController.php';

/**
 * Catalog Search Controller
 *
 * Rewritten to disable ajax suggestions when algolia is enabled
 */
class Algolia_Algoliasearch_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function suggestAction()
    {
        if ( Mage::helper('algoliasearch')->isPopupEnabled() ) {
            $this->getResponse()->setBody('<div>Disabled.</div>');
            return;
        }

        if (!$this->getRequest()->getParam('q', false)) {
            $this->getResponse()->setRedirect(Mage::getSingleton('core/url')->getBaseUrl());
            return; // Missing in original version from Magento CE 1.6
        }

        $this->getResponse()->setBody($this->getLayout()->createBlock('catalogsearch/autocomplete')->toHtml());
    }
}
