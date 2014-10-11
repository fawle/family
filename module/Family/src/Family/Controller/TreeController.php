<?php

namespace Family\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Family\Service\PersonTable;

/**
 * controller for tree actions
 */
class TreeController extends AbstractActionController
{
  
    /** @var PersonTable $personTable **/
    protected $personTable;
     
    /**
     * 
     * @return ViewModel
     */
    public function treeAction()
    {
        return new ViewModel(array(
            'people' => $this->getPeopleService()->fetchWithMarriage(),
        ));
    }

    /**
     * 
     * @return ViewModel
     */
    public function personAction()
    {
        return new ViewModel(array(
            'people' => $this->getPeopleService()->fetchWithMarriage(),
            'start' => $this->params()->fromRoute("id"),
 
        ));
    }
    
     /**
     * 
     * @return ViewModel
     */
    public function loginAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
         /**
     * 
     * @return ViewModel
     */
    public function searchAction()
    {
        return new ViewModel(array(
            
        ));
    }
    
        /**
     *
     * @return PersonTable
     * todo swap this or service to separate db calls and object handling
     */
    private function getPeopleService() 
    {
        if (!$this->personTable) {
            $sm = $this->getServiceLocator();
            $this->personTable = $sm->get('Family\Service\PersonTable');
        }
        return $this->personTable;
    }
}