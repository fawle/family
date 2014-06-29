<?php

namespace Family\View;

use Family\Model\Marriage;
use Zend\View\Helper\AbstractHelper;
use Family\Model\Person;
use Family\Model\Family;

class NestedList extends AbstractHelper {

    /**
     *
     * @var array 
     */
    protected $tree;

    public function __invoke($array, $startId = 1) {
        foreach ($array as $person) {

            //make tree branch for this person
            /** @var Person $person */
            if (!isset($this->tree[$person->getId()])) {
                $this->tree[$person->getId()] = $person;
            } else {
                $this->tree[$person->getId()]->exchangeArray($person->getArrayCopy());
            }

            $this->handleParents($person, 1);
            $this->handleParents($person, 2);

            //insert this as spouse
            /** @var Family $family */
            foreach ($person->getFamilies() as $index => $family)
            {
               if ($index && !isset($this->tree[$index])) {
                   $this->tree[$index] = new Person();
               }
               
            }
        }
        $this->renderArray($startId);
    }

    private function handleParents(Person $person, $parentNum = 1) {
        if ($parentNum == 1) {
            $thisParent = $person->getParent1();
            $otherParent = $person->getParent2();
        } else {
            $thisParent = $person->getParent2();
            $otherParent = $person->getParent1();
        }

        if ($thisParent) {
            if (!isset($this->tree[$thisParent])) {
                $this->tree[$thisParent] = new Person();
            }
            if (!isset($this->tree[$otherParent])) {
                $this->tree[$otherParent] = new Person();
            }
            $familyArray = $this->tree[$thisParent]->getFamilies();
            if (!$otherParent) {
                    $otherParent = "None";
                }

            if (!isset($familyArray[$otherParent])) {
                $familyArray[$otherParent] = new Family();
                if ($otherParent != "None") {
                    $familyArray[$otherParent]->setSpouse($this->tree[$otherParent]);
                }
            }
            $familyArray[$otherParent]->addChild($this->tree[$person->getId()]);
            $this->tree[$thisParent]->setFamilies($familyArray);
        }
    }
    
    private function renderArray($startId = 1)
    {
 
        /** @var Person $node */
        $node = $this->tree[$startId];

            echo "<li id='".$node->getId()."'>";
                echo "<div class='family'>";
                echo sprintf (
                    "<div class='heir'>%s<br/>%s<br/>%s<br>%s%s</div>",
                    $node->getFirstName(),
                    $node->getPatronymic(),
                    $node->getLastName(),
                    $node->getDob() ? $node->getDob()->format("d/m/Y"):'',
                    $node->getDod() ? "<br>".$node->getDod()->format("d/m/Y"):'');
            /** @var Family $family */
            foreach ($node->getFamilies() as $family) {
                if ($family->getSpouse() instanceof Person) {
                    echo sprintf("<div class='spouse%s'>%s<br/>%s<br/>%s<br>%s%s</div>",
                        $family->getMarriage() instanceof Marriage ? " married" : '',
                        $family->getSpouse()->getFirstName(),
                        $family->getSpouse()->getPatronymic(),
                        $family->getSpouse()->getLastName(),
                        $family->getSpouse()->getDob() ? $family->getSpouse()->getDob()->format("d/m/Y"):'',
                        $family->getSpouse()->getDod() ? "<br>". $family->getSpouse()->getDod()->format("d/m/Y"):'');
                } else {
                    echo "<div class='spouse'></div>";
                }

                echo "<ul>";
                    /** @var Person $child */
                    foreach ($family->getChildren() as $child) {
                        $this->renderArray($child->getId());
                    }
                    echo "</ul>";
                echo sprintf("</div><div class='family'>");
            }
            echo sprintf("</div></li>");
    }

}

?>
