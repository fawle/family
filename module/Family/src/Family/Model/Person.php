<?php
namespace Family\Model;

class Person
{
   /** @var int $id **/
    protected $id;
    /** @var string $firstName **/
    protected $firstName;
    /** @var string $lastName **/
    protected $patronymic;
    /** @var  string */
    protected $lastName;
    /** @var  string */
    protected $marriedName;
    /** @var \Datetime **/
    protected $dob;
    /** @var \Datetime **/
    protected $dod;
    /** @var  string */
    protected $gender;
    /** @var  Person */
    protected $parent1;
    /** @var Person $parent2 **/
    protected $parent2;



    /** @var array $family **/
    protected $families;


    /**
     *
     * @param array $data 
     */    
    public function __construct(Array $data = null)
    {
        $this->families = array();
        if ($data) {
            $this->exchangeArray($data);
        }   
    }
    
    /**
     *
     * @param string $id
     * @return Person
     */
    public function setId($id) 
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     *
     * @return string
     */
    public function getId() 
    {
        return $this->id;
    }
    
    /**
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName) 
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    /**
     *
     * @return string 
     */
    public function getFirstName() 
    {
        return $this->firstName;
    }
    
    /**
     *
     * @param array $families
     * @return Person
     */
    public function setFamilies(Array $families) 
    {
        $this->families = $families;
        return $this;
    }
    
    /**
     *
     * @return array 
     */
    public function getFamilies() 
    {
        return $this->families;
    }

    /**
     * @param int $family
     * @return Family
     */
    public function addFamily(Family $family)
    {
        $this->families[$family->getSpouse()->getId()] = $family;
        return $this;
    }
    
    /**
     *
     * @return string 
     */
     public function getLastName() {
        return $this->lastName;
    }

    /**
     *
     * @param string $lastName
     * @return \Family\Model\Person 
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     *
     * @return int 
     */
    public function getParent1() {
        return $this->parent1;
    }

    /**
     *
     * @param int $parent1
     * @return \Family\Model\Person 
     */
    public function setParent1($parent1) {
        $this->parent1 = $parent1;
        return $this;
    }

    /**
     *
     * @return int 
     */
    public function getParent2() {
        return $this->parent2;
    }

    /**
     *
     * @param int $parent2
     * @return \Family\Model\Person 
     */
    public function setParent2($parent2) {
        $this->parent2 = $parent2;
        return $this;
    }

    /**
     *
     * @return \Datetime 
     */
    public function getDob() {
        return $this->dob;
    }

    /**
     *
     * @param \Datetime $dob
     * @return \Family\Model\Person 
     */
    public function setDob(\Datetime $dob) {
        $this->dob = $dob;
        return $this;
    }

    /**
     * @param \Datetime $dod
     * @return $this;
     */
    public function setDod(\Datetime $dod)
    {
        $this->dod = $dod;
        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getDod()
    {
        return $this->dod;
    }

    /**
     * @param string $patronymic
     * @return $this;
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @param string $marriedName
     * @return $this;
     */
    public function setMarriedName($marriedName)
    {
        $this->marriedName = $marriedName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarriedName()
    {
        return $this->marriedName;
    }

    /**
     * @param string $gender
     * @return $this;
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }


    /**
     *
     * @param array $data
     * @return Person
     */
    public function exchangeArray(Array $data)
    {
        if (isset($data["id"])) {
            $this->setId($data["id"]);
        }
        if (isset($data["first_name"])) {
            $this->setFirstName($data["first_name"]);
        }
        if (isset($data["last_name"])) {
            $this->setLastName($data["last_name"]);
        }
        if (isset($data["married_name"])) {
            $this->setMarriedName($data["married_name"]);
        }
        if (isset($data["patronymic"])) {
            $this->setPatronymic($data["patronymic"]);
        }

        if (isset($data["date_of_birth"]) && $data["date_of_birth"]!='0000-00-00') {
            $dob = new \DateTime;
            $this->setDob($dob->createFromFormat("Y-m-d", $data["date_of_birth"]));
        }
        if (isset($data["date_of_death"]) && $data["date_of_death"]!='0000-00-00') {
            $dod = new \DateTime;
            $this->setDod($dod->createFromFormat("Y-m-d", $data["date_of_death"]));
        }

        if (isset($data["gender"])) {
            $this->setGender($data["gender"]);
        }

        if (isset($data["parent_1"])) {
            $this->setParent1($data["parent_1"]);
        }
       if (isset($data["parent_2"])) {
            $this->setParent2($data["parent_2"]);
       }
        return $this;
    }
    
    public function getArrayCopy()
    {
        return array(
            "id" => $this->getId(),
            "first_name" => $this->getFirstName(),
            "patronymic" => $this->getPatronymic(),
            "last_name" => $this->getLastName(),
            "married_name" => $this->getMarriedName(),
            "date_of_birth" => $this->getDob() ? $this->getDob()->format("Y-m-d") : null,
            "date_of_death" => $this->getDod() ? $this->getDod()->format("Y-m-d") : null,
            "gender" => $this->getGender(),
            "parent_1" => $this->getParent1(),
            "parent_2" => $this->getParent2()
        );
    }
    
    public function copy(Person $person)
    {
        $this->exchangeArray($person->getArrayCopy());
        foreach($person->getFamilies() as $family) {
            if (!isset($this->getFamilies()[$family->getSpouse()->getId()])) {
                $this->addFamily($family);
            }
        }
        return $this;
    }
}
?>
