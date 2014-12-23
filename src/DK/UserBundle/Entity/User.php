<?php

namespace DK\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="name_first", nullable=true)
     */
    protected $nameFirst;

    /**
     * @ORM\Column(type="string", name="name_last", nullable=true)
     */
    protected $nameLast;

    public function getNameFirst() {
        return $this->nameFirst;
    }

    public function setNameFirst($name) {
        return $this->nameFirst = $name;
    }

    public function getNameLast() {
        return $this->nameLast;
    }

    public function setNameLast($name) {
        return $this->nameLast = $name;
    }

}
