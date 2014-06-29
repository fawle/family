<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Family\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Family\Service\PersonTable;

class IndexController extends AbstractActionController
{
    protected $personTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'people' => $this->getPeopleService()->fetchWithMarriage(),
            //'people' => $this->getPeopleService()->fetchAll(),
        ));
    }

    public function personAction()
    {
        return new ViewModel(array(
            'people' => $this->getPeopleService()->fetchWithMarriage(),
            'start' => $this->params()->fromRoute("id")
        ));
    }

    public function verticalAction()
    {

    }
    
    /**
     *
     * @return PersonTable
     */
    public function getPeopleService() 
    {
        if (!$this->personTable) {
            $sm = $this->getServiceLocator();
            $this->personTable = $sm->get('Family\Service\PersonTable');
        }
        return $this->personTable;
    }
}
