<?php
namespace Family\Service;

use Family\Model\Family;
use Family\Model\Marriage;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Family\Model\Person;

class PersonTable
{
    protected $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * @return ResultSet
     */
    public function fetchWithMarriage()
    {
        $select = new Select;
        $select->from('people')
            ->join(array("s1" => 'spouses'), 'people.id = s1.person_id', array(), SELECT::JOIN_LEFT)
            ->join(array("s2" => 'spouses'), 's2.marriage_id =s1.marriage_id and s2.person_id <> s1.person_id ', array("person_id" ), SELECT::JOIN_LEFT)
            ->join(array('marriage' => 'marriage'), 's1.marriage_id = marriage.id', array("date_started"), SELECT::JOIN_LEFT);
        $statement = $this->tableGateway->getAdapter()->getDriver()->createStatement();
        $select->prepareStatement($this->tableGateway->getAdapter(), $statement); 
        $resultSet = new ResultSet();
        $arraySet = $resultSet->initialize($statement->execute())->toArray();
        $returnSet = array();
        
        foreach ($arraySet as $record) {
            //set array node for this person
            if (!isset($returnSet[$record["id"]] )) {
                $returnSet[$record["id"]] = new Person($record);
            }
            //set array node for each spouse
            if ($record["person_id"] && !array_key_exists($record["person_id"], $returnSet[$record["id"]]->getFamilies()) ) {
                $returnSet[$record["id"]]->addFamily($record["person_id"])->setMarriage(new Marriage());
            }
        }
        return $returnSet;
    }

    /**
     * @param $id
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function get($id)
    {
        $id  = (int) $id;
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
    public function save(Person $person)
    {
        $data = array(
            /** @todo fix */
            'artist' => $album->artist,
            'title'  => $album->title,
        );

        $id = (int)$album->id;
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

    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}