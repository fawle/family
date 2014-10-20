<?php
namespace Family\Model;

class User implements \ZfcUser\Entity\UserInterface
{
   /** @var int $id **/
    protected $id;
    /** @var string $username **/
    protected $username;
    /** @var int $role **/
    protected $role;
    
    protected $password;
    
    protected $state;
    
    protected $email;
    
    protected $displayName;


    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }

    protected function setId($id) {
        $this->id = $id;
        return $this;
    }

    protected function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    protected function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    protected function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
        return $this;
    }
    public function getState() {
        return $this->state;
    }



}