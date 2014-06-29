<?php

namespace Family\Model;

class Family {

    /**
     *
     * @var Person 
     */
    protected $spouse;

    /**
     *
     * @var array 
     */
    protected $children;

    /**
     * @var Marriage
     */
    protected $marriage;

    /**
     * constructor
     */
    public function __construct() {
        $this->children = array();
    }

    /**
     * @param Marriage $marriage
     * @return $this
     */
    public function setMarriage(Marriage $marriage)
    {
        $this->marriage = $marriage;
        return $this;
    }

    /**
     * @return \Family\Model\Marriage
     */
    public function getMarriage()
    {
        return $this->marriage;
    }

    /**
     *
     * @return Person 
     */
    public function getSpouse() {
        return $this->spouse;
    }

    /**
     *
     * @param Person $spouse
     * @return \Family\Model\Family 
     */
    public function setSpouse(Person $spouse) {
        $this->spouse = $spouse;
        return $this;
    }

    /**
     *
     * @return array 
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     *
     * @param array $children
     * @return \Family\Model\Family 
     */
    public function setChildren(Array $children) {
        $this->children = $children;
        return $this;
    }


    
    public function addChild(Person $person) 
    {
        if (!isset($this->children[$person->getId()])) {
            $this->children[$person->getId()] = $person;
        }
        return $this;
    }

}

?>
