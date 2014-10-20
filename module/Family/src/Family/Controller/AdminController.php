<?php

namespace Family\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController 
{
    public function indexAction()
    {
        return new \Zend\View\Model\ViewModel();
    }
}
