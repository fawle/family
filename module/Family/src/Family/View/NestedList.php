<?php

namespace Family\View;

use Family\Model\Marriage;
use Zend\View\Helper\AbstractHelper;
use Family\Model\Person;
use Family\Model\Family;

/**
 * 
 */
class NestedList extends AbstractHelper {

    /**
     *
     * @param type $array
     * @param type $startId 
     */
    public function __invoke($array, $startId = 1) {
        foreach ($array as $person) {
            //make tree branch for this person
            /** @var Person $person */
            if (!isset($this->tree[$person->getId()])) {
                
                $this->tree[$person->getId()] = $person;
            } else {
                $this->tree[$person->getId()]->copy($person);
            }
        }
        $this->renderArray($array, $startId);
    }

   
    /**
     * @todo add ids to markup
     * @param type $array
     * @param type $startId 
     */
    private function renderArray($array, $startId = 1)
    {
 
        /** @var Person $node */
        $node = $array[$startId];

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
                        $this->renderArray($array, $child->getId());
                    }
                    echo "</ul>";
                echo sprintf("</div><div class='family'>");
            }
            echo sprintf("</div></li>");
    }

}

?>
