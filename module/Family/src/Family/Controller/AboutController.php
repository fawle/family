<?php


namespace Family\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * controller for static about pages
 */
class AboutController extends AbstractActionController {

    /**
     *
     * @var type 
     */
    protected $language = '';

    /**
     * 
     * @return ViewModel
     */
    public function indexAction() {
        return new ViewModel(array(
        ));
    }

    /**
     * 
     * @return ViewModel
     */
    public function nilAction() {
        return new ViewModel(array(
            'language' => $this->language
        ));
    }

    /**
     * 
     */
    public function bookAction() {
        return new ViewModel(array(
            'language' => $this->language
        ));
    }

    /**
     * 
     */
    public function technicalAction() {
        return new ViewModel(array(
            'language' => $this->language
        ));
    }

    /**
     * 
     */
    public function helpAction() {
        return new ViewModel(array(
            'language' => $this->language
        ));
    }

}
