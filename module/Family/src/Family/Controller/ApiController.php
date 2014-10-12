<?php

namespace Family\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Family\Model\JsonModelUnicode;
use Family\Service\PersonTable;

/**
 * controller for api actions
 */
class ApiController extends AbstractActionController {

    /** @var PersonTable $personTable * */
    protected $personTable;

    /**
     * 
     * @return JsonModel
     */
    public function indexAction() {

        return new JsonModel(array("this" => "api"));
    }

    /**
     * 
     * @return JsonModel
     */
    public function searchAction() {
        $search = filter_var($this->params()->fromQuery("search"), FILTER_SANITIZE_STRING);
   
            $people = $this->getPeopleService()->fetchAll();
            /** @var Family\Model\Person $person * */
   
            foreach ($people as $person) {
                $datum[] = array("name"=>$person->getFirstName() . " " . $person->getPatronymic() . " " . $person->getLastName(), "id"=>$person->getID());
            }
     
        
    
        return new JsonModelUnicode
        
                (
                    $datum
                );
 
    }

    /**
     *
     * @return PersonTable
     * todo swap this or service to separate db calls and object handling
     */
    private function getPeopleService() {
        if (!$this->personTable) {
            $sm = $this->getServiceLocator();
            $this->personTable = $sm->get('Family\Service\PersonTable');
        }
        return $this->personTable;
    }

}
