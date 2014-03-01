<?php

/**
 * @Entity
 */
class AppUser extends BaseEntity{

    /**
     * @var string
     * @Column(type="string", nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }



}