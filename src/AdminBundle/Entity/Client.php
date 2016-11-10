<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="jdc_client")
 **/
class Client
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(name="firstname", type="string", length = 255)
     **/
    private $f_name;
    private $l_name;
    private $email;
    private $password;
    private $company;
    private $active;
    private $job;
    private $start_date;
    private $end_date;
    private $address;
    private $phone;
}