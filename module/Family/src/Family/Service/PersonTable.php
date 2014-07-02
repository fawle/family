<?php

namespace Family\Service;

use Family\Model\Family;
use Family\Model\Marriage;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Family\Model\Person;

class PersonTable {

    protected $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * @return ResultSet
     */
    public function fetchWithMarriage() {
        $select = new Select;
        $select->from('people')
                ->join(array("s1" => 'spouses'), 'people.id = s1.person_id', array(), SELECT::JOIN_LEFT)
                ->join(array("s2" => 'spouses'), 's2.marriage_id =s1.marriage_id and s2.person_id <> s1.person_id ', array("spouse" => "person_id"), SELECT::JOIN_LEFT)
                ->join(array('marriage' => 'marriage'), 's1.marriage_id = marriage.id', array("date_started", "date_ended"), SELECT::JOIN_LEFT);
        $statement = $this->tableGateway->getAdapter()->getDriver()->createStatement();

        $select->prepareStatement($this->tableGateway->getAdapter(), $statement);
        $resultSet = new ResultSet();
        $arraySet = $resultSet->initialize($statement->execute())->toArray();
        $returnSet = array();
        //dereference into nested array
        foreach ($arraySet as $record) {
            //set array node for this person
            if (!isset($returnSet[$record["id"]])) {
                $returnSet[$record["id"]] = new Person($record);
            } else {
                //array node already set up, populate with data
                $returnSet[$record["id"]]->exchangeArray($record);
            }
            //set array node for each spouse
            if ($record["spouse"] && !array_key_exists($record["spouse"], $returnSet[$record["id"]]->getFamilies())) {
                $family = new Family();
                //set marriage data
                if ($record["date_started"] > '0') {
                    $family->setMarriage(new Marriage($record["date_ended"], $record["date_started"]));
                }
                //set spouse
                if (!isset($returnSet[$record["spouse"]])) {
                    $returnSet[$record["spouse"]] = new Person(array("id" => $record["spouse"]));
                }
                $returnSet[$record["id"]]->addFamily($family->setSpouse($returnSet[$record["spouse"]]));
                //children are handled by parent handling routine
            }
            //create array nodes for parents
            if (!isset($returnSet[$record["parent_1"]])) {
                $returnSet[$record["parent_1"]] = new Person(array("id" => $record["parent_1"]));
            }
            if (!isset($returnSet[$record["parent_2"]])) {
                $returnSet[$record["parent_2"]] = new Person(array("id" => $record["parent_2"]));
            }
            //set up spousal relationship with the other parent
            if (!isset($returnSet[$record["parent_1"]]->getFamilies()[$record["parent_2"]])) {
                $family = new Family;
                $returnSet[$record["parent_1"]]->addFamily($family->setSpouse($returnSet[$record["parent_2"]]));
            }
            //add this node as their child
            $returnSet[$record["parent_1"]]->getFamilies()[$record["parent_2"]]->addChild($returnSet[$record["id"]]);
            //same again
            if (!isset($returnSet[$record["parent_2"]]->getFamilies()[$record["parent_1"]])) {
                $family = new Family;
                $returnSet[$record["parent_2"]]->addFamily($family->setSpouse($returnSet[$record["parent_1"]]));
            }
            $returnSet[$record["parent_2"]]->getFamilies()[$record["parent_1"]]->addChild($returnSet[$record["id"]]);
        }
        return $returnSet;
    }


    /**
     * @param $id
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function get($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param Person $person
     * @throws \Exception
     */
    public function save(Person $person) {
        $data = array(
            /** @todo fix */
            'artist' => $album->artist,
            'title' => $album->title,
        );

        $id = (int) $album->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => $id));
    }

}