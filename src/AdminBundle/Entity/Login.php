<?php

namespace AdminBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jdc_users")
 **/

class Login
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length = 255)
     **/
    private $name;

    /**
     * @ORM\Column(name="email", type="string", length = 255)
     **/
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length = 255)
     **/
    private $password;

    /**
     * @ORM\Column(name="active", type="boolean")
     **/
    private $actives;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getActives()
    {
        return $this->actives;
    }

    /**
     * @param mixed $actives
     */
    public function setActives($actives)
    {
        $this->actives = $actives;
    }

    public function isEnabled()
    {
        return $this->getActives();
    }

}
